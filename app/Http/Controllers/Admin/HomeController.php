<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\SendNotificationEmail;
use App\Mail\Subscribersmail;
use App\Models\Admin\Admin;
use App\Models\Admin\DigitalProduct;
use App\Models\Admin\Message;
use App\Models\Admin\Mlmuser;
use App\Models\Admin\Order;
use App\Models\Admin\Product;
use App\Models\Admin\Review;
use App\Models\Admin\Transection;
use App\Models\User;
use App\Models\User\OrderedItem;
use App\Models\User\SubmittedMail;
use App\Models\User\Subscribe;
use Coderflex\LaravelTicket\Models\Ticket;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;
use Carbon\Carbon;


class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:manage customers', ['only' => ['create','status','show','destroy']]);
        $this->middleware('permission:manage subscribers', ['only' => ['subscribers','subscriber_mail','subscribers_mail_send','subscribers_delete']]);
        $this->middleware('permission:manage site mail', ['only' => ['all_mail','all_admin_sent_mail','mail_show','compose','send','mail_destroy','deleteAll']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        
        $users = User::all();
        $products = Product::all();
        $activeUsers = User::where('status',1)->get();
        $mlmUsers = Mlmuser::all();
        $activemlmUsers = Mlmuser::where('admin_activation',1)->where('parent_activation',1)->get();
        $transactions = Transection::where('formable_type','!=','admin')->get();
        $reviews = Review::all();
        $tickets = Ticket::all();
        $openticket = Ticket::where('status','open')->get();
        $closeticket = Ticket::where('status','close')->get();
        $digitalproducts = DigitalProduct::where('status',1)->orderBy('id','ASC')->take(4)->get();
        $orders = Order::orderBy('id','DESC')->get();

        $recent_orders = Order::orderBy('id','DESC')->limit(10)->get();
        $ordered_items = OrderedItem::orderBy('id','DESC')->get();

        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year; // Get the current year

        $charts_orders = Order::whereYear('created_at', $currentYear)
                   ->select(DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(id) as id')) // Assuming 'amount' for order value
                   ->groupBy('month')
                   ->orderBy('id', 'DESC')
                   ->get();

        $labels = [];
        $data = [];

        foreach ($charts_orders as $order) {
            $labels[] = Carbon::createFromDate($currentYear, $order->month)->format('M'); // Format month labels
            $data[] = $order->id;
        }
        
        $existingData = [ // Your existing data
          'labels' => ['January', 'February', 'March', 'April'],
          'data' => [0, 0, 0, 0],
        ];

        // Approach 1: Merging with separate arrays
        $data = [
          'labels' => array_merge($existingData['labels'], $labels),
          'data' => array_merge($existingData['data'], $data),
        ];

        // Get the start and end dates of the last month
        $startOfLastMonth = Carbon::now()->subMonth()->startOfMonth();
        $endOfLastMonth = Carbon::now()->subMonth()->endOfMonth();

        // Prepare an array to hold the two-day intervals
        $dateRanges = [];
        for ($date = $startOfLastMonth; $date->lessThanOrEqualTo($endOfLastMonth); $date->addDays(2)) {
            $dateRanges[] = [
                'start' => $date->copy(),
                'end' => $date->copy()->addDays(1)
            ];
        }
        // Query the database to get the order counts for each interval
        $orderLabels = [];
        $orderCounts = [];
        $totalEarning = [];
        foreach ($dateRanges as $range) {
            $startDate = $range['start']->format('Y-m-d');
            $endDate = $range['end']->format('Y-m-d');

            $count = Order::whereBetween('created_at', [$startDate, $endDate])
                ->count();

            if(empty($count)){
                $count = Order::whereDate('created_at', $endDate)->count();
            }
            $amount = Order::where('payment_status', 'Paid')
                  ->whereBetween('created_at', [$startDate, $endDate])
                  ->sum('total');
            if(empty($amount)){
                $amount = Order::where('payment_status', 'Paid')
                  ->whereDate('created_at', $endDate)
                  ->sum('total');
            }
            $orderLabels[] =  $range['start']->format('M d');

            $orderCounts[] = $count;

            $totalEarning[] = $amount;
        }

        $month_wise_data = [
          'labels' => $orderLabels,
          'data' => $orderCounts,
          'amount' => $totalEarning,
        ];
        return view('admin.dashboard',compact('digitalproducts','products','orders','users','activeUsers','mlmUsers','activemlmUsers','transactions','openticket','tickets','closeticket','ordered_items','reviews','recent_orders', 'data','month_wise_data'));
    }


    /**
     * Display a listing of the resource.
     */
    public function profile(): View
    {
        return view('admin.profile');
    }


    /**
     * ImageUpdate the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function imgupdate(Request $request, $id)
    {
        $this->validate($request,[
            'image.*' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if($request->hasFile('image'))
        {
            $imageName = $request->image->getClientOriginalName();
            $imageName = $request->image->store('public');
        }
        else
        {
            $data = Admin::where('id',$id)->first();
            $imageName = $data->image;
        }

        $admin =  Admin::find($id);
        $admin->image = $imageName;
        $admin->save(); 
        $notification = array(
            'message' => 'Picture Changed!', 
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    /**
     * Admin Password the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function passupdate(Request $request, $id)
    {
        $this->validate($request,[
            'old_password' => 'required|string',
            'new_password' =>  ['required','string',Password::min( 8 ),'same:c_password','different:old_password'],
        ]);

        $admin =  Admin::find($id);
        if (Hash::check($request->old_password, $admin->password)) { 
            $admin->fill([
                'password' => Hash::make($request->new_password)
            ])->save();

            $notification = array(
                'message' => 'Password Changed!', 
                'alert-type' => 'success',
            );
        } 
        else{
            $notification = array(
                'message' => 'Password does not match!', 
                'alert-type' => 'error',
            );
        }
        return redirect()->back()->with($notification);
        
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = User::orderBy('id', 'desc')->get();
        return view('admin.customers.websitecustomer',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    public function status(Request $request,string $id)
    {
        $this->validate($request,[
            'status' => 'required',
        ]);
        $user = User::find($id);

        $user->status = $request->status;
        $user->save(); 
        $notification = array(
            'message' => 'Status Change!', 
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = User::find($id);
        return view('admin.customers.show',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request);

        $this->validate($request,[
            'name' => 'required|string|max:255',
            'position' => 'nullable',
            'phone' => 'required|min:11|max:14',
        ]);

        $admin =  Admin::find($id);
        $admin->name = $request->name;
        $admin->position = $request->position;
        $admin->phone = $request->phone;
        $admin->save(); 
        $notification = array(
            'message' => 'Profile Updated Successfully!', 
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    public function check($id)
    {
        $user = User::find($id);
        $mlmuser = $user->mlmUser;
        // dd($mlmuser->refferer_id);
        $refferUser = User::find($mlmuser->refferer_id);
        $refferUsernumber = Mlmuser::where('refferer_id',$refferUser->id)->get();
        // dd($refferUsernumber[2]->id);
        if($refferUsernumber[2]->id == $user->id || $refferUsernumber[4]->id == $user->id){
            $user = Mlmuser::find($mlmuser->id);
            $user->parent_id = $refferUser->mlmUser->parent_id;
            $user->save();

            echo "parent change";

        }else{
            echo "parent not change";
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::where('id',$id)->delete();
        $notification = array(
            'message' => 'User Destroyed.', 
            'alert-type' => 'error',
        );
        return redirect()->back()->with($notification);
    }

    public function all_mail()
    {
        $contacts = SubmittedMail::where('admin_sent',false)->paginate(20);
        return view('admin.contactmail.index',compact('contacts'));
    }

    public function all_admin_sent_mail()
    {
        $contacts = SubmittedMail::where('admin_sent',true)->paginate(20);
        return view('admin.contactmail.sent',compact('contacts'));
    }

    public function compose()
    {
        return view('admin.contactmail.compose');
    }

    public function mail_show($id)
    {
        $contact =  SubmittedMail::where('id',$id)->first();
        return view('admin.contactmail.show',compact('contact'));
    }

    public function send(Request $request)
    {
        $this->validate($request,[
            'to' => 'required|string|max:255',
            'subject' => 'nullable',
            'message' => 'required',
            'attachment'=>'nullable',
            'attachment.*' => 'sometimes|image|video|zip|pdf|mimes:jpeg,png,jpg,gif,svg,pdf,docx,webp,mp4,mov,ogg,webm|max:20000'
        ]);
        $attachment = null;
        if($request->hasFile('attachment'))
        {
            // $attachment = $request->attachment->getClientOriginalName();
            $attachment = $request->attachment;
        }
        $contact = new SubmittedMail();

        $contact->name = 'admin';
        $contact->email = $request->to;
        $contact->subject = $request->subject;
        $contact->message = $request->message;
        $contact->admin_sent = true;
        $contact->save();

        $data = [
            'to' => $request->to,
            'subject' => $request->subject,
            'message' => $request->message,
            'attachment' => $attachment,
        ];

        // Send the email with the attached invoice
        Mail::to($request->to)->later(now()->addMinutes(1),new SendNotificationEmail($data));
        $notification = array(
            'message' => 'Email destroy.', 
            'alert-type' => 'error',
        );
        return redirect()->route('user.mail.list')->with($notification);

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function mail_destroy($id)
    {
        SubmittedMail::where('id',$id)->delete();
        $notification = array(
            'message' => 'Email destroy.', 
            'alert-type' => 'error',
        );
        return redirect()->back()->with($notification);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteAll(Request $request)
    {
        $ids = $request->ids;
        DB::table("submitted_mails")->whereIn('id', $ids)->delete();
        return response()->json(['success' => "E-mail Deleted successfully."]);
    }
    
    public function subscribers()
    {
        $data = Subscribe::orderBy('id', 'desc')->get();
        return view('admin.subscribers.index',compact('data'));
    }
    public function subscriber_mail()
    {
        return view('admin.subscribers.mail');
    }
    public function subscribers_mail_send(Request $request)
    {
        $request->validate([
            'subject' => 'required',
            'message' => 'required'
        ]);

        $subject = $request->subject;
        $message = $request->message;

        $subscribers = Subscribe::where('status','Active')->get();
        foreach($subscribers as $row) {
            \Mail::to($row->email)->send(new Subscribersmail($subject,$message));
        }
        $notification = array(
            'message' => 'Email is Sent Successfully.', 
            'alert-type' => 'success',
        );
        return redirect()->route('subscribers.list')->with($notification);
    }
     public function subscribers_delete($id)
    {
        Subscribe::where('id',$id)->delete();
        $notification = array(
            'message' => 'Subscriber delete successfully.', 
            'alert-type' => 'error',
        );
        return redirect()->back()->with($notification);
    }

    public function cache()
    {
        // Clear route cache
        // \Artisan::call('route:cache');
        // Clear route cache
        // \Artisan::call('route:clear');
        // Clear config cache
        // \Artisan::call('config:cache');
        // Clear cache clear
        \Artisan::call('cache:clear');   
        // Clear view cache
        // \Artisan::call('view:clear');
        // Clear cache using reoptimized class
        // \Artisan::call('optimize:clear');

        $notification = array(
            'message' => 'System Cache Has Been Removed.', 
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }
}
