<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('user.dashboard.profile', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }
        $json_data = array(
            "payment_gatway_type" => "Bkash",
            "number" => "01307665311",
            "type" => "personal"
        );
        // $arr_tojson = json_encode($json_data);
        // $request->user()->mlmUser->others_documents = $arr_tojson;
        $request->user()->save();
        // $request->user()->mlmUser->save();
        $notification = array(
            'message' => 'Profile Update!', 
            'alert-type' => 'success',
        );
        return Redirect::route('profile.edit')->with($notification);
    }

    /**
     * Update the user's profile information.
     */
    public function credential(Request $request)
    {
        $this->validate($request,[
            'payment_gatway_type' => 'required',
            'number' => 'required|min:10|max:14',
            'type' => 'required',
            
        ]);
        $json_data = array(
            "payment_gatway_type" => $request->payment_gatway_type,
            "number" => $request->number,
            "type" => $request->type
        );
        $arr_tojson = json_encode($json_data);
        $request->user()->mlmUser->others_documents = $arr_tojson;
        // $request->user()->save();
        $request->user()->mlmUser->save();
        $notification = array(
            'message' => 'Credential Add Successfully', 
            'alert-type' => 'success',
        );
        return Redirect::route('profile.edit')->with($notification);
    }

    /**
     * ImageUpdate the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function imgupdate(Request $request)
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
            $data = User::where('id',Auth::user()->id)->first();
            $imageName = $data->image;
        }

        $user =  User::find(Auth::user()->id);
        $user->profile_image = $imageName;
        $user->save(); 
        $notification = array(
            'message' => 'Picture Changed!', 
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
