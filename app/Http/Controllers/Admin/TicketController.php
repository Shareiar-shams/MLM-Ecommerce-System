<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Coderflex\LaravelTicket\Models\Ticket;
use Coderflex\LaravelTicket\Models\Category;
use Coderflex\LaravelTicket\Models\Label;
use Illuminate\Support\Str;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:view tickets|create tickets|update tickets|delete tickets', ['only' => ['index','store','status','show']]);
         $this->middleware('permission:create tickets', ['only' => ['create','store','ticketStore']]);
         $this->middleware('permission:update tickets', ['only' => ['edit','update']]);
         $this->middleware('permission:delete tickets', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tickets = Ticket::orderBy('id','DESC')->get();

        return view('admin.tickets.index',compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('is_visible',1)->get();
        $labels = Label::where('is_visible',1)->get();
        return view('admin.tickets.create',compact('categories','labels'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'message' => 'required',
            'ticket_id' => 'required',
            'attachment'=>'nullable',
            'attachment.*' => 'sometimes|image|video|zip|mimes:jpeg,png,jpg,gif,svg,pdf,docx,webp,mp4,mov,ogg,webm|dimensions:min_width=100,min_height=100|max:20000'
        ]);
        $attachment = null;
        if($request->hasFile('attachment'))
        {
            $attachment = $request->attachment->getClientOriginalName();
            $attachment = $request->attachment->store('public');
        }
        $ticket = Ticket::find($request->ticket_id);
        $ticket->status = "open";
        $ticket->save();
        $ticket->messages()->create([
            'user_id' => $ticket->user->id, // Replace with the actual name
            'ticket_id' => $ticket->id,
            'message' => $request->message,
            'attachment' => $attachment
        ]);

        $notification = array(
            'message' => 'Reply Sent', 
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    public function ticketStore(Request $request)
    {
        /** @var User */
        $user = Auth::guard('admin')->user();
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

        return redirect(route('ticket.show',$ticket->uuid))
            ->with($notification);
    }

    public function close(Request $request,$uuid)
    {
        $data = Ticket::where('uuid',$uuid)->first();
        $data->status = $request->status;
        $data->save();
        $notification = array(
            'message' => 'Ticket Close', 
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Ticket::where('uuid',$id)->first();
        return view('admin.tickets.show',compact('data'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Ticket::where('id',$id)->delete();
        $notification = array(
            'message' => 'Ticket Destroy.', 
            'alert-type' => 'error',
        );
        return redirect()->back()->with($notification);
    }
}
