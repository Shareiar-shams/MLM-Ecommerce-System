<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Admin\DigitalProduct;
use App\Models\Admin\Mlmuser;
use App\Models\Admin\Offer;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\URL;
use Session;

class DigitalProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($digitalproductId='', $offerId='', $type='', $encryptedUserId='')
    {
        $reffererId = Crypt::decrypt($encryptedUserId);
        if (Auth::check()) {
            $json_data = array(
                "digitalproduct" => $digitalproductId,
                "offerId" => $offerId
            );
            $arr_tojson = json_encode($json_data);

            $user = User::find(Auth::user()->id);
            $user->referrer_id = $reffererId;
            $user->user_type = $type;
            $user->others = $arr_tojson;
            $user->link = URL::signedRoute('offer.purchase', ['digitalproduct' => $digitalproductId, 'offer' => $offerId, 'type' => $type, 'user' => $encryptedUserId]);
            $user->save();
            // $offer = Offer::findOrFail($offerId);
        
            // $mlmuser = Mlmuser::findOrFail($reffererId);

            // if ($mlmuser->offers()->where('offer_id', $offer->id)->exists()) {
            //     // Proceed with the purchase
            //     // Logic for updating purchase records, generating receipts, etc.

                
            // }

            // abort(403, 'Unauthorized');
            // Redirect registered users directly
            // return redirect()->route('offer.purchase', compact('digitalproductId', 'offerId', 'type', 'reffererId'));

            $productOffer = null;
            $product = DigitalProduct::where('id',$digitalproductId)->first();
            $upcoming_products = DigitalProduct::where('status',0)->get();
            if(isset($product->offer) && $product->offer->status == 1 && $product->offer->offer_for === "digitalproduct"){

                $productOffer = Offer::where('id',$offerId)->first();
            }
            return view('user.mlmproduct',compact('product','upcoming_products','productOffer'));
        } 
            // Store the parameters in the session
        Session::put('purchase_params', [
            'product_id' => $digitalproductId,
            'offer_id' => $offerId,
            'type' => $type, 
            'refferer_id' => $reffererId,
            'link' => URL::signedRoute('offer.purchase', ['digitalproduct' => $digitalproductId, 'offer' => $offerId, 'type' => $type, 'user' => $encryptedUserId])
        ]);

        $productOffer = null;
        $product = DigitalProduct::where('id',$digitalproductId)->first();
        $upcoming_products = DigitalProduct::where('status',0)->get();
        if(isset($product->offer) && $product->offer->status == 1 && $product->offer->offer_for === "digitalproduct"){

            $productOffer = Offer::where('id',$offerId)->first();
        }
        return view('user.mlmproduct',compact('product','upcoming_products','productOffer'));
        // Redirect guests to the login or registration page
        // return redirect()->route('login');
        
    }


    public function referrer_user($encryptedUserId='', $type='')
    {
        $reffererId = Crypt::decrypt($encryptedUserId);
        if (Auth::check()) {

            $user = User::find(Auth::user()->id);
            $user->referrer_id = $reffererId;
            $user->user_type = $type;
            $user->link = URL::signedRoute('user.referrer', ['referrer' => Crypt::encrypt($reffererId), 'type' => 'normal']);
            $user->save();

            $mlmuser = Mlmuser::findOrFail($reffererId);

            // return response()->json(['message' => 'User available']);

             return redirect()->route('main');


            // Redirect registered users directly
            // return redirect()->intended('/');
        } 
            // Store the parameters in the session
        Session::put('referrer_params', [
            'refferer_id' => $reffererId,
            'type' => $type,
            'link' => URL::signedRoute('user.referrer', ['referrer' => Crypt::encrypt($reffererId), 'type' => 'normal'])
        ]);

        // Redirect guests to the login or registration page
        return redirect()->route('main');
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
