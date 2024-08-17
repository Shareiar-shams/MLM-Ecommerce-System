<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Admin\Admin;
use App\Models\Admin\DigitalProduct;
use App\Models\Admin\Message;
use App\Models\Admin\Mlmuser;
use App\Models\Admin\Offer;
use App\Models\Admin\Order;
use App\Models\Admin\Product;
use App\Models\Admin\Transection;
use App\Models\User;
use Auth;
use Carbon\Carbon;
use Coderflex\LaravelTicket\Models\Category;
use Coderflex\LaravelTicket\Models\Label;
use Coderflex\LaravelTicket\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Illuminate\View\View;
class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $user = Mlmuser::where('user_id', Auth::user()->id)->first();

        $offers = isset($user) ? $user->offers : '';

        // $data = Mlmuser::where('parent_id', Auth::user()->id)->orderBy('id','ASC')->get();
        // $link = array();
        // foreach ($offers as $key => $value) {
        //     $encryptedMlmUserId = Crypt::encrypt($user->id);
        //     // $offerId = Crypt::encrypt($value->id); 
        //     if($value->offer_type == 'special'){
        //         $link[] = URL::signedRoute('offer.purchase', ['offer' => $value->id, 'type' => 'special', 'user' => $encryptedMlmUserId]);
        //     }else{
        //         $link[] = URL::signedRoute('offer.purchase', ['offer' => $value->id, 'type' => 'normal', 'user' => $encryptedMlmUserId]);
        //     }
            
        // }
        // // Store the link for the user or send it via email, etc.
        // $user->offer_link = $link;
        // $user->save();


        // return response()->json(['message' => 'Offer links generated and MLM users updated successfully']);
        return view('user.dashboard.index',compact('user','offers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request, $digitalproduct, $offerId, $type, $encryptedUserId)
    {
        // $offer = Offer::findOrFail($offerId);
        $userId = Crypt::decrypt($encryptedUserId);
        dd($userId);
        // $user = Mlmuser::findOrFail($userId);

        // if ($user->offers()->where('id', $offer->id)->exists()) {
        //     // Proceed with the purchase
        //     // Logic for updating purchase records, generating receipts, etc.

        //     return response()->json(['message' => 'Digital product purchased successfully']);
        // }

        // abort(403, 'Unauthorized');
    }
    /**
     * Show a user sell report.
     */
    public function activechild()
    {
        if( isset(Auth::user()->mlmUser) &&  isset(Auth::user()->mlmUser) && Auth::user()->mlmUser->parent_activation == 1 && Auth::user()->mlmUser->admin_activation == 1){
            $parentUser = Mlmuser::find(Auth::user()->mlmUser->id);

            $totalChild = $parentUser->children()
                ->where('admin_activation', 1)
                ->where('parent_activation', 1)
                ->get();
            return view('user.dashboard.totalchild',compact('totalChild'));
        }else{
            $notification = array(
                'message' => 'You are not Active User. Contact with Admin', 
                'alert-type' => 'error',
            );
            return redirect(route('dashboard'))->with($notification);
        }
    }

    /**
     * Show a user sell report.
     */
    public function sellReport()
    {
        if( isset(Auth::user()->mlmUser) && Auth::user()->mlmUser->parent_activation == 1 && Auth::user()->mlmUser->admin_activation == 1){
            $parentUser = Mlmuser::find(Auth::user()->mlmUser->id);

            $totalChild = $parentUser->children()
                ->where('admin_activation', 1)
                ->where('parent_activation', 1)
                ->get();

            $totalSell = $parentUser->refererchildren()
                ->get();
            // Get children added today with parent_activation and admin_activation = 1
            $today = Carbon::today();
            $childrenToday = $parentUser->refererchildren()
                ->whereDate('created_at', $today)
                ->get();

            $sevenDaysAgo = Carbon::today()->subDays(7);
            $childrenLastSevenDays = $parentUser->refererchildren()
                ->whereDate('created_at', '>=', $sevenDaysAgo)
                ->get();


            return view('user.dashboard.sellReport',compact('totalChild','childrenToday','childrenLastSevenDays','totalSell'));
        }else{
            $notification = array(
                'message' => 'You are not Active User. Contact with Admin', 
                'alert-type' => 'error',
            );
            return redirect(route('dashboard'))->with($notification);
        }
    }

    /**
     * Show a user today sell report.
     */
    public function todaysellReport()
    {
        if( isset(Auth::user()->mlmUser) && Auth::user()->mlmUser->parent_activation == 1 && Auth::user()->mlmUser->admin_activation == 1){
            $parentUser = Mlmuser::find(Auth::user()->mlmUser->id);
            // Get children added today with parent_activation and admin_activation = 1
            $today = Carbon::today();
            $childrenToday = $parentUser->refererchildren()
                ->whereDate('created_at', $today)
                ->get();

            return view('user.dashboard.todaysellReport',compact('childrenToday'));
        }else{
            $notification = array(
                'message' => 'You are not Active User. Contact with Admin', 
                'alert-type' => 'error',
            );
            return redirect(route('dashboard'))->with($notification);
        }
    }

    /**
     * Show a user today sell report.
     */
    public function weeklysellReport()
    {
        if( isset(Auth::user()->mlmUser) && Auth::user()->mlmUser->parent_activation == 1 && Auth::user()->mlmUser->admin_activation == 1){
            $parentUser = Mlmuser::find(Auth::user()->mlmUser->id);
            // Get children added today with parent_activation and admin_activation = 1
            $sevenDaysAgo = Carbon::today()->subDays(7);
            $childrenLastSevenDays = $parentUser->refererchildren()
                ->whereDate('created_at', '>=', $sevenDaysAgo)
                ->get();

            return view('user.dashboard.weeklysellReport',compact('childrenLastSevenDays'));
        }else{
            $notification = array(
                'message' => 'You are not Active User. Contact with Admin', 
                'alert-type' => 'error',
            );
            return redirect(route('dashboard'))->with($notification);
        }
    }


    /**
     * Show a user today sell report.
     */
    public function totalSell()
    {
        if( isset(Auth::user()->mlmUser) && Auth::user()->mlmUser->parent_activation == 1 && Auth::user()->mlmUser->admin_activation == 1){
            $parentUser = Mlmuser::find(Auth::user()->mlmUser->id);
            
            $totalSell = $parentUser->refererchildren()
                ->get();

            return view('user.dashboard.totalSell',compact('totalSell'));
        }else{
            $notification = array(
                'message' => 'You are not Active User. Contact with Admin', 
                'alert-type' => 'error',
            );
            return redirect(route('dashboard'))->with($notification);
        }
    }

    /**
     * Show toots option.
     */
    public function myproduct()
    {
        if( isset(Auth::user()->mlmUser) && Auth::user()->mlmUser->parent_activation == 1 && Auth::user()->mlmUser->admin_activation == 1){
            
            $product = DigitalProduct::findOrFail(Auth::user()->mlmUser->activate_product)->first();
            return view('user.dashboard.myproduct',compact('product'));
        }else{
            $notification = array(
                'message' => 'You are not Active User. Contact with Admin', 
                'alert-type' => 'error',
            );
            return redirect(route('dashboard'))->with($notification);
        }
    }

    /**
     * Show toots option.
     */
    public function courseDetails()
    {
        if( isset(Auth::user()->mlmUser) && Auth::user()->mlmUser->parent_activation == 1 && Auth::user()->mlmUser->admin_activation == 1){
            
            $product = DigitalProduct::findOrFail(Auth::user()->mlmUser->activate_product)->first();
            return view('user.dashboard.courseDetails',compact('product'));
        }else{
            $notification = array(
                'message' => 'You are not Active User. Contact with Admin', 
                'alert-type' => 'error',
            );
            return redirect(route('dashboard'))->with($notification);
        }
    }

    /**
     * Show toots option.
     */
    public function tools()
    {
        if( isset(Auth::user()->mlmUser) && Auth::user()->mlmUser->parent_activation == 1 && Auth::user()->mlmUser->admin_activation == 1){
            

            return view('user.dashboard.tools');
        }else{
            $notification = array(
                'message' => 'You are not Active User. Contact with Admin', 
                'alert-type' => 'error',
            );
            return redirect(route('dashboard'))->with($notification);
        }
    }

    public function order()
    {
        $orders = Order::where('user_id',Auth::id())->get();
        return view('user.dashboard.order',compact('orders'));
    }

    public function order_details($id='')
    {
        $order = Order::where('id',$id)->first();
        return view('user.dashboard.details',compact('order'));
    }

    /**
     * Show toots option.
     */
    public function basiclink()
    {
        if( isset(Auth::user()->mlmUser) && Auth::user()->mlmUser->parent_activation == 1 && Auth::user()->mlmUser->admin_activation == 1){
            

            return view('user.dashboard.basiclink');
        }else{
            $notification = array(
                'message' => 'You are not Active User. Contact with Admin', 
                'alert-type' => 'error',
            );
            return redirect(route('dashboard'))->with($notification);
        }
    }

    /**
     * Show toots option.
     */
    public function normallink()
    {
        if( isset(Auth::user()->mlmUser) && Auth::user()->mlmUser->parent_activation == 1 && Auth::user()->mlmUser->admin_activation == 1){
            $currentDate = Carbon::now()->format('d-m-Y');
            // Fetch all offers and filter based on the last_date format
            $offers = Offer::where('status',1)->where('offer_type', 'normal')
            ->get()
            ->filter(function ($offer) use ($currentDate) {
                // Convert last_date to a valid date representation (Y-m-d) for comparison
                $lastDate = Carbon::createFromFormat('d-m-Y', $offer->last_date)->endOfDay();

                // Compare the last_date with the current date
                return $lastDate->isSameDay($currentDate) || $lastDate->isFuture();
            });
            // $offers = Auth::user()->mlmUser->offers;
            // $offers = Offer::where('offer_type','normal')->where('last_date', '>=', $currentDate)->get();

            return view('user.dashboard.normalLink',compact('offers'));
        }else{
            $notification = array(
                'message' => 'You are not Active User. Contact with Admin', 
                'alert-type' => 'error',
            );
            return redirect(route('dashboard'))->with($notification);
        }
    }

    /**
     * Show toots option.
     */
    public function specialLink()
    {
        if( isset(Auth::user()->mlmUser) && Auth::user()->mlmUser->parent_activation == 1 && Auth::user()->mlmUser->admin_activation == 1){
            $offers = Auth::user()->mlmUser->offers;

            return view('user.dashboard.specialLink',compact('offers'));
        }else{
            $notification = array(
                'message' => 'You are not Active User. Contact with Admin', 
                'alert-type' => 'error',
            );
            return redirect(route('dashboard'))->with($notification);
        }
    }

    /**
     * Show toots option.
     */
    public function offerDetails($id)
    {
        if( isset(Auth::user()->mlmUser) && Auth::user()->mlmUser->parent_activation == 1 && Auth::user()->mlmUser->admin_activation == 1){

            // $offers = Auth::user()->mlmUser->offers;
            $offer = Offer::findOrFail($id);

            return view('user.dashboard.offerDetails',compact('offer'));
        }else{
            $notification = array(
                'message' => 'You are not Active User. Contact with Admin', 
                'alert-type' => 'error',
            );
            return redirect(route('dashboard'))->with($notification);
        }
    }

    /**
     * Show all chat between admin and users.
     */
    public function chats()
    {
        if( isset(Auth::user()->mlmUser) && Auth::user()->mlmUser->parent_activation == 1 && Auth::user()->mlmUser->admin_activation == 1){
            $admin = Admin::find(1); // Replace 1 with the actual admin ID
            $mlmUser = MLMUser::find(Auth::user()->mlmUser->id); // Replace $receiverId with the specific MLM user ID
            // Mark the messages as read
            $messages = Message::where('receiver_type', 'mlmuser')->where('receiver_id', $mlmUser->user->id)->update(['is_read' => 1]);
            // Fetch all messages exchanged between the admin and the MLM user
            $messages = Message::where(function ($query) use ($admin, $mlmUser) {
                $query->where('sender_type', 'admin')
                    ->where('sender_id', $admin->id)
                    ->where('receiver_type', 'mlmuser')
                    ->where('receiver_id', $mlmUser->id);
            })->orWhere(function ($query) use ($admin, $mlmUser) {
                $query->where('sender_type', 'mlmuser')
                    ->where('sender_id', $mlmUser->id)
                    ->where('receiver_type', 'admin')
                    ->where('receiver_id', $admin->id);
            })->get();
            

            return view('user.dashboard.chats',compact('messages'));
        }else{
            $notification = array(
                'message' => 'You are not Active User. Contact with Admin', 
                'alert-type' => 'error',
            );
            return redirect(route('dashboard'))->with($notification);
        }
    }


    /**
     * Store a newly created message in Message table.
     */
    public function chatstore(Request $request)
    {
        $admin = Admin::findOrFail(1); // Assuming you have authentication set up for admin

        $mlmuser = Mlmuser::findOrFail(Auth::user()->mlmUser->id);

        $message = new Message();
        $message->sender_type = 'mlmuser';

        $message->sender_id = Auth::user()->mlmUser->id; // Assuming you have authentication set up for user
        $message->receiver_type = 'admin';
        $message->receiver_id = $admin->id;
        $message->message = $request->input('message');
        $message->is_read = 1;
        $message->save();

        // Broadcast the message using Larasocket
        // Larasocket::broadcast(new MessageSent($message));
        // broadcast(new MessageSentEvent($message));

        return redirect()->back();
    }


    public function notifications()
    {
        return view('user.dashboard.allnotifications');
    }

    public function ticket()
    {
        $tickets = Auth::user()->tickets;
        
        return view('user.dashboard.ticket',compact('tickets'));
    }

    public function ticketCreate()
    {
        $categories = Category::where('is_visible',1)->get();
        $labels = Label::where('is_visible',1)->get();
        return view('user.dashboard.ticketcreate',compact('categories','labels'));
    }

    public function ticketshow($uuid)
    {
        $data = Ticket::where('uuid',$uuid)->first();
        return view('user.dashboard.ticketshows',compact('data'));
    }

    /**
     * Show a user sell report.
     */
    public function pendingUser()
    {
        if( isset(Auth::user()->mlmUser) && Auth::user()->mlmUser->parent_activation == 1 && Auth::user()->mlmUser->admin_activation == 1){
            $parentUser = Mlmuser::find(Auth::user()->mlmUser->id);

            $totalChild = $parentUser->refererchildren()
                ->where('parent_activation', 0)
                ->where('admin_activation', 1)
                ->get();

            return view('user.dashboard.pendingUser',compact('totalChild'));
        }else{
            $notification = array(
                'message' => 'You are not Active User. Contact with Admin', 
                'alert-type' => 'error',
            );
            return redirect(route('dashboard'))->with($notification);
        }
    }

    /**
     * Show a user sell report.
     */
    public function adminPending()
    {
        if( isset(Auth::user()->mlmUser) && Auth::user()->mlmUser->parent_activation == 1 && Auth::user()->mlmUser->admin_activation == 1){
            $parentUser = Mlmuser::find(Auth::user()->mlmUser->id);

            $totalChild = $parentUser->refererchildren()
                ->where('admin_activation', 0)
                ->get();

            return view('user.dashboard.adminPending',compact('totalChild'));
        }else{
            $notification = array(
                'message' => 'You are not Active User. Contact with Admin', 
                'alert-type' => 'error',
            );
            return redirect(route('dashboard'))->with($notification);
        }
    }

    /**
     * Show a user sell report.
     */
    public function product_sells()
    {
        if( isset(Auth::user()->mlmUser) && Auth::user()->mlmUser->parent_activation == 1 && Auth::user()->mlmUser->admin_activation == 1){
            $products = Product::where('status',1)->where('productType', '!=', 'customize')->get();

            return view('user.dashboard.sellsproduct',compact('products'));
        }else{
            $notification = array(
                'message' => 'You are not Active User. Contact with Admin', 
                'alert-type' => 'error',
            );
            return redirect(route('dashboard'))->with($notification);
        }
    }

    public function add_product(Request $request)
    {
        $this->validate($request,[
            'product_id' => 'required',
        ]);

        $mlmuser = Mlmuser::find(Auth::user()->mlmUser->id);
        $productId = $request->input('product_id');
        $product = Product::find($productId);
        
        $mlmuser->products()->attach($productId); 
        $notification = array(
            'message' => 'Product add your lists!', 
            'alert-type' => 'success',
        );
        
        return redirect(route('product_sells'))->with($notification);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        /** @var User */
        $user = Auth::user();
        $this->validate($request,[
            'title' => 'required|min:3',
            'message' => 'required',
            'labels' => 'required',
            'categories' => 'required',
            'priority' => 'required',
            'attachment'=>'nullable',
            'attachment.*' => 'sometimes|image|video|zip|mimes:jpeg,png,jpg,gif,svg,pdf,docx,webp,mp4,mov,ogg,webm|dimensions:min_width=100,min_height=100|max:20000'
        ]);
        $attachment = null;
        if($request->hasFile('attachment'))
        {
            $attachment = $request->attachment->getClientOriginalName();
            $attachment = $request->attachment->store('public');
        }

        $ticket = $user->tickets()->create([
            'uuid' => Str::uuid()->toString(),
            'user_id' => Auth::id(),
            'title' => $request->title,
            'message' => $request->message,
            'attachment' => $attachment,
            'priority' => $request->priority
        ]);

        $categories = Category::where('slug',$request->categories)->first();
        $labels = Label::where('slug',$request->labels)->first();

        $ticket->attachCategories($categories);
        $ticket->attachLabels($labels);
        
        // $ticket->messages()->create([
        //     'user_id' => Auth::id(), // Replace with the actual name
        //     'uuid' => Str::uuid()->toString(), // Replace with the actual slug
        //     'ticket_id' => $ticket->id,
        //     'message' => $ticket->message
        // ]);


        // or you can create the categories & the tickets directly by:
        // $ticket->categories()->create(...);
        // $ticket->labels()->create(...);

        $notification = array(
            'message' => 'Ticket Generate successfully', 
            'alert-type' => 'success',
        );

        return redirect(route('tickets.show',$ticket->uuid))
            ->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $user = Mlmuser::where('id',$id)->first();
        $refferUsers = Mlmuser::where('refferer_id',Auth::user()->id)->get();
        // dd(count($refferUsers));
        $json_data = json_decode($user->user->others);
        $digitalproduct = (isset($user->activate_product)) ? DigitalProduct::where('id',$user->activate_product)->first() : null;

        $referrer_parent_id = isset(Auth::user()->mlmUser->parent_id) ? Auth::user()->mlmUser->parent_id : null;

        $payAdmin = $parentTake = $actualPrice = $pay_transfer_parent ='';

        $transfer_user = 0;

        if(count($refferUsers) > 2 && ((isset($refferUsers[2]->id) && $refferUsers[2]->id == $user->id) || (isset($refferUsers[4]->id) && $refferUsers[4]->id == $user->id))){

            $user->parent_id = $referrer_parent_id;
            $user->parent_activation = isset($referrer_parent_id) ? 0 : 1;
            $user->save();
            $transfer_user = isset($referrer_parent_id) ? 1 : 0;
            if($json_data->offerId != null){
                $offer = Offer::where('id',$json_data->offerId)->first();
                if($offer->status != 0){

                    $discountPercentage = $offer->offer_percentage;
                    $originalPrice = (isset($offer->digitalProduct->special_price)) ? $offer->digitalProduct->special_price : $offer->digitalProduct->price; 
                    $userPercentage = (isset($offer->user_percentage)) ? $offer->user_percentage : 33.33;
                    $actualPrice = $originalPrice - ($originalPrice * ($discountPercentage / 100));
                    $payAdmin = number_format($actualPrice, 2);
                    $pay_transfer_parent = number_format($actualPrice * ($userPercentage / 100), 2);
                }else{
                    $actualPrice = (isset($digitalproduct->special_price)) ? $digitalproduct->special_price : $digitalproduct->price; 
                    $payAdmin = number_format($actualPrice, 2);
                    $userPercentage = 33.33;
                    $pay_transfer_parent = number_format($actualPrice * ($userPercentage / 100), 2);
                }
            }else{

                $actualPrice = (isset($digitalproduct->special_price)) ? $digitalproduct->special_price : $digitalproduct->price; 
                $payAdmin = number_format($actualPrice, 2);
                $userPercentage = 33.33;
                $pay_transfer_parent = number_format($actualPrice * ($userPercentage / 100), 2);
            }
            
            $parentTake = '';
        }
        elseif($json_data->offerId != "null"){
            if($user->user->user_type == 'special'){
                $user->parent_id = null;
            }else{

                $user->parent_id = Auth::user()->id;
            }
            $user->parent_activation = 1;
            $user->save();

            $offer = Offer::where('id',$json_data->offerId)->first();
            if($offer->status != 0){
                $discountPercentage = $offer->offer_percentage;
                $originalPrice = (isset($offer->digitalProduct->special_price)) ? $offer->digitalProduct->special_price : $offer->digitalProduct->price; 
                $userPercentage = (isset($offer->user_percentage)) ? $offer->user_percentage : 33.33;
                $actualPrice = $originalPrice - ($originalPrice * ($discountPercentage / 100));
                $payAdmin = number_format($actualPrice - ($actualPrice * ($userPercentage / 100)), 2);
                $parentTake = number_format(($actualPrice - $payAdmin), 2);
                
            }else{
                $actualPrice = (isset($digitalproduct->special_price)) ? $digitalproduct->special_price : $digitalproduct->price; 

                $userPercentage = 33.33;
                $payAdmin = number_format($actualPrice - ($actualPrice * ($userPercentage / 100)), 2);
                $parentTake = number_format(($actualPrice - $payAdmin), 2);
            }
        }
        else{
            $user->parent_id = Auth::user()->id;
            $user->parent_activation = 1;
            $user->save();

            $actualPrice = (isset($digitalproduct->special_price)) ? $digitalproduct->special_price : $digitalproduct->price; 

            $userPercentage = 33.33;
            $payAdmin = number_format($actualPrice - ($actualPrice * ($userPercentage / 100)), 2);
            $parentTake = number_format(($actualPrice - $payAdmin), 2);

        }
        return view('user.dashboard.payforuser',compact('user','transfer_user','pay_transfer_parent','digitalproduct','actualPrice','payAdmin','parentTake'));
    }

    
    // public function token()
    // {
    //     session_start();

    //     $request_token = $this->_bkash_Get_Token();

    //     $idtoken = $request_token['id_token'];

    //     $_SESSION['token'] = $idtoken;

    //     /*$strJsonFileContents = file_get_contents("config.json");
    //     $array = json_decode($strJsonFileContents, true);*/

    //     $array = $this->_get_config_file();

    //     $array['token'] = $idtoken;

    //     $array['createURL'] = 'https://tokenized.sandbox.bka.sh/v1.2.0-beta/tokenized/checkout/create';
    //     $array['executeURL'] = 'https://tokenized.sandbox.bka.sh/v1.2.0-beta/tokenized/checkout/execute';

    //     $newJsonString = json_encode($array);
    //     File::put(storage_path() . '/app/public/config.json', $newJsonString);

    //     echo $idtoken;
    // }

    // protected function _bkash_Get_Token()
    // {
    //     /*$strJsonFileContents = file_get_contents("config.json");
    //     $array = json_decode($strJsonFileContents, true);*/

    //     $array = $this->_get_config_file();

    //     $post_token = array(
    //         'app_key' => $array["app_key"],
    //         'app_secret' => $array["app_secret"]
    //     );

    //     $url = curl_init($array["tokenURL"]);
    //     $proxy = $array["proxy"];
    //     $posttoken = json_encode($post_token);
    //     $header = array(
    //         'Content-Type:application/json',
    //         'password:' . $array["password"],
    //         'username:' . $array["username"]
    //     );

    //     curl_setopt($url, CURLOPT_HTTPHEADER, $header);
    //     curl_setopt($url, CURLOPT_CUSTOMREQUEST, "POST");
    //     curl_setopt($url, CURLOPT_RETURNTRANSFER, true);
    //     curl_setopt($url, CURLOPT_POSTFIELDS, $posttoken);
    //     curl_setopt($url, CURLOPT_FOLLOWLOCATION, 1);
    //     curl_setopt($url, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
    //     //curl_setopt($url, CURLOPT_PROXY, $proxy);
    //     $resultdata = curl_exec($url);
    //     curl_close($url);
    //     return json_decode($resultdata, true);
    // }

    // protected function _get_config_file()
    // {
    //     $path = storage_path() . "/app/public/config.json";
    //     return json_decode(file_get_contents($path), true);
    // }

    // public function createpayment()
    // {
    //     session_start();

    //     /*$strJsonFileContents = file_get_contents("config.json");
    //     $array = json_decode($strJsonFileContents, true);*/

    //     $array = $this->_get_config_file();

    //     $amount = $_GET['amount'];
    //     $invoice = $_GET['invoice']; // must be unique
    //     $payerReference = $_GET['payerReference']; 
    //     $intent = "sale";
    //     $proxy = $array["proxy"];
    //     // $createpaybody=array('amount'=>$amount, 'currency'=>'BDT', 'merchantInvoiceNumber'=>$invoice,'intent'=>$intent);
    //     $callbackURL = $_GET['callbackURL'];
    //     $callbackURL = "http://localhost:8000";
    //     $requestbody = array(
    //         'mode' => '0011',
    //         'amount' => $amount,
    //         'currency' => 'BDT',
    //         'intent' => $intent,
    //         'payerReference' => $payerReference,
    //         'merchantInvoiceNumber' => $invoice,
    //         'callbackURL' => $callbackURL
    //     );   
    //     $url = curl_init($array["createURL"]);
    //     $createpaybodyx = json_encode($requestbody);

    //     $header=array(
    //         'Content-Type:application/json',
    //         'authorization:'.$array["token"],
    //         'x-app-key:'.$array["app_key"]
    //     );

    //     curl_setopt($url, CURLOPT_HTTPHEADER, $header);
    //     curl_setopt($url, CURLOPT_CUSTOMREQUEST, "POST");
    //     curl_setopt($url, CURLOPT_RETURNTRANSFER, true);
    //     curl_setopt($url, CURLOPT_POSTFIELDS, $createpaybodyx);
    //     curl_setopt($url, CURLOPT_FOLLOWLOCATION, 1);
    //     curl_setopt($url, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
    //     //curl_setopt($url, CURLOPT_PROXY, $proxy);
    //     $resultdata = curl_exec($url);
    //     curl_close($url);
    //     echo $resultdata;
        
    // }

    // public function executepayment()
    // {
    //     session_start();

    //     /*$strJsonFileContents = file_get_contents("config.json");
    //     $array = json_decode($strJsonFileContents, true);*/

    //     $array = $this->_get_config_file();

    //     $paymentID = $_GET['paymentID'];

    //     // $userId = $_GET['userID'];
    //     $proxy = $array["proxy"];
    //     $post_token = array(
    //        'paymentID' => $paymentID
    //     );
    //     $url = curl_init($array["executeURL"]);
    //     $posttoken = json_encode($post_token);
    //     $header = array(
    //         'Content-Type:application/json',
    //         'authorization:' . $array["token"],
    //         'x-app-key:' . $array["app_key"]
    //     );

    //     curl_setopt($url, CURLOPT_HTTPHEADER, $header);
    //     curl_setopt($url, CURLOPT_CUSTOMREQUEST, "POST");
    //     curl_setopt($url, CURLOPT_RETURNTRANSFER, true);
    //     curl_setopt($url, CURLOPT_POSTFIELDS, $posttoken);
    //     curl_setopt($url, CURLOPT_FOLLOWLOCATION, 1);
    //     curl_setopt($url, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
    //     // curl_setopt($url, CURLOPT_PROXY, $proxy);

    //     $resultdatax = curl_exec($url);
    //     curl_close($url);

    //     // $this->_updateOrderStatus($resultdatax,$userId);

    //     echo $resultdatax;
    // }

    // protected function _updateOrderStatus($resultdatax,$userId)
    // {
    //     $resultdatax = json_decode($resultdatax);

    //     if ($resultdatax && $resultdatax->paymentID != null && $resultdatax->transactionStatus == 'Completed') {

    //         $user = Mlmuser::find($userId);
    //         $user->admin_activation = 1;
    //         $user->parent_activation = 1;
    //         $user->save();

    //         $item = new Transection();
    //         $item->user_id  = $user->user->id;
    //         $item->mlmuser_id  = $userId;
    //         $item->digitalProdcut_id = $user->activate_product;
    //         $item->transaction_number = $resultdatax->trxID;
    //         $item->offer_percentage = $request->offer_percentage;
    //         $item->formable_type = "user";
    //         $item->formable_id = Auth::user()->id();
    //         $item->toable_type = "admin";
    //         $item->toable_id = 1;
    //         $item->payment_type = "bKash";
    //         $item->amount = $resultdatax->amount;
    //         $item->transection_time = $resultdatax->paymentExecuteTime;
            
    //         $item->save();
            
    //     }
    // }
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
