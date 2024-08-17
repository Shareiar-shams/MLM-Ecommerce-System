<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        $request->validate([
            'title' => 'required',
            'subtitle' => 'nullable',
            'address' => 'required',
            'contact_number' => 'required',
            'time_schedule' => 'required',
            'email' => 'required',
            'location' => 'required',
            // Add validation rules for other categories if needed
        ]);


        $data = Contact::find($id);

        $data->title = $request->title;
        $data->subtitle = $request->subtitle;
        $data->address = $request->address;

        $data->contact_number = $numbers = isset($request->contact_number) ? json_encode($request->contact_number) : null;

        $data->time_schedule = $time = isset($request->time_schedule) ? json_encode($request->time_schedule) : null;

        $data->email = $email = isset($request->email) ? json_encode($request->email) : null;

        $data->location = $request->location;

        $data->save(); 

    
        $notification = array(
            'message' => 'Contact Page Data Successfully Updated', 
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
