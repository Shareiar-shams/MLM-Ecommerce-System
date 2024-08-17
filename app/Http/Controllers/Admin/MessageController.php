<?php

namespace App\Http\Controllers\Admin;

use App\Events\MessageSentEvent;
use App\Http\Controllers\Controller;
use App\Models\Admin\Admin;
use App\Models\Admin\Message;
use App\Models\Admin\Mlmuser;
use Auth;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:manage user messages', ['only' => ['index','create','store','show','edit','update','destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Message::where('sender_type','mlmuser')
        ->groupBy('sender_id')
        ->orderBy('sender_id', 'asc')
        ->get();
        return view('admin.mlm.allchat', compact('data'));
        // $admin = Admin::findOrFail(Auth::guard('admin')->user()->id); // Assuming you have authentication set up for admin

        // $mlmuser = Mlmuser::findOrFail($id); // Assuming you have authentication set up for user

        // $messages = Message::where(function ($query) use ($admin, $mlmuser) {
        //     $query->where([
        //         ['sender_type', 'admin'],
        //         ['sender_id', $admin->id],
        //         ['receiver_type', 'mlmuser'],
        //         ['receiver_id', $mlmuser->id],
        //     ])->orWhere([
        //         ['sender_type', 'mlmuser'],
        //         ['sender_id', $mlmuser->id],
        //         ['receiver_type', 'admin'],
        //         ['receiver_id', $admin->id],
        //     ]);
        // })
        // ->orderBy('id')
        // ->get();
        // return response()->json(['messages' => $messages, 'admin' => $admin, 'mlmuser' => $mlmuser]);

        // return view('admin.mlm.chat', compact('messages', 'admin', 'mlmuser'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // $message = Message::create([
        //     'sender_type' => 'admin',
        //     'sender_id' => Auth::guard('admin')->user()->id,
        //     'receiver_type' => 'mlmuser',
        //     'receiver_id' => $request->input('receiver_id'),
        //     'message' => $request->input('message')
        // ]);
        $admin = Admin::findOrFail(Auth::guard('admin')->user()->id); // Assuming you have authentication set up for admin

        $mlmuser = Mlmuser::findOrFail($request->receiver_id);

        $message = new Message();
        $message->sender_type = 'admin';
        // $admin->sentMessages()->save($message);
        // $mlmuser->receivedMessages()->save($message);

        $message->sender_id = Auth::guard('admin')->user()->id; // Assuming you have authentication set up for admin
        $message->receiver_type = 'mlmuser';
        $message->receiver_id = $request->input('receiver_id');
        $message->message = $request->input('message');
        $message->is_read = 1;
        $message->save();

        // Broadcast the message using Larasocket
        // Larasocket::broadcast(new MessageSent($message));
        // broadcast(new MessageSentEvent($message));

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Mark the messages as read
        $messages = Message::where('sender_type', 'mlmuser')->where('sender_id', $id)->update(['is_read' => 1]);

        $admin = Admin::findOrFail(Auth::guard('admin')->user()->id); // Assuming you have authentication set up for admin

        $mlmuser = Mlmuser::findOrFail($id); // Assuming you have authentication set up for user

        $messages = Message::where(function ($query) use ($admin, $mlmuser) {
            $query->where([
                ['sender_type', 'admin'],
                ['sender_id', $admin->id],
                ['receiver_type', 'mlmuser'],
                ['receiver_id', $mlmuser->id],
            ])->orWhere([
                ['sender_type', 'mlmuser'],
                ['sender_id', $mlmuser->id],
                ['receiver_type', 'admin'],
                ['receiver_id', $admin->id],
            ]);
        })
        ->orderBy('id')
        ->get();
        // dd($mlmuser->messagesSent);
        return view('admin.mlm.chat', compact('messages', 'admin', 'mlmuser'));

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
        //
    }
}
