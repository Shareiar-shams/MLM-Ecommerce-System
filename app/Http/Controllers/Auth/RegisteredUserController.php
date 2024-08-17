<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Session;
class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {

        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:'.User::class],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'phone' => ['nullable', 'string', 'max:255'],
        ]);
        if(session()->has('referrer_params')){
            $referrerParams = session()->get('referrer_params');

            $reffererId = $referrerParams['refferer_id'];
            $type = $referrerParams['type'];
            $receive_link = $referrerParams['link'];
           
            // Process the purchase and other parameters
            // Save the purchase details and other parameters to the database
            $user = User::create([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'status' => 1,
                'phone' => $request->phone,
                'referrer_id' => $reffererId,
                'user_type' => $type,
                'link' => $receive_link,
            ]);

            event(new Registered($user));

            Auth::login($user);
            // Clear the stored purchase parameters from the session
            session()->forget('referrer_params');

            return redirect()->intended('/');
        }elseif (session()->has('purchase_params')) {
            $purchaseParams = session()->get('purchase_params');

            // Retrieve the parameters and process them
            $productId = $purchaseParams['product_id'];
            $offerId = $purchaseParams['offer_id'];
            $type = $purchaseParams['type'];
            $reffererId = $purchaseParams['refferer_id'];
            $receive_link = $purchaseParams['link'];
            $json_data = array(
                "digitalproduct" => $productId,
                "offerId" => $offerId
            );
            $arr_tojson = json_encode($json_data);
            // Process the purchase and other parameters
            // Save the purchase details and other parameters to the database
            $user = User::create([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'status' => 1,
                'phone' => $request->phone,
                'referrer_id' => $reffererId,
                'user_type' => $type,
                'others' => $arr_tojson,
                'link' => $receive_link,
            ]);

            event(new Registered($user));

            Auth::login($user);
            // Clear the stored purchase parameters from the session
            session()->forget('purchase_params');

            // Redirect to the purchase URL with the stored parameters
            return Redirect::to(route('offer.purchase', [
                'digitalproduct' => $productId,
                'offer' => $offerId,
                'type' => $type,
                'user' => Crypt::encrypt($reffererId),
            ]));
        }elseif(session()->has('digital_product_purchase_parem')){
            $purchaseParams = session()->get('digital_product_purchase_parem');
            // Retrieve the parameters and process them
            $digitalproductId = $purchaseParams['digitalproductId'];
            $offerId = isset($purchaseParams['offerId']) ? $purchaseParams['offerId'] : null;

            $user = User::create([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'status' => 1,
                'phone' => $request->phone,
            ]);

            event(new Registered($user));

            Auth::login($user);

            // Clear the stored purchase parameters from the session
            session()->forget('digital_product_purchase_parem');
            return redirect()->route('mlmcheckout', ['digitalproductId' => $digitalproductId, 'offerId' => $offerId]);
        }elseif(session()->has('cart')){

            $session_id = Session::getId();
            $cart = Session::get('cart');
            $condition = Session::get('condition');

            $user = User::create([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'status' => 1,
                'phone' => $request->phone,
            ]);

            event(new Registered($user));

            Auth::login($user);

            \Cart::session($session_id)->add($cart);
            if($condition){

                \Cart::session($session_id)->condition($condition);
            }
            $checkoutRoute = Session::get('checkoutRoute');

            if($checkoutRoute){
                return redirect()->intended($checkoutRoute);
            }
            else{
                
                $redirectTo = $request->has('redirect_to') ? $request->redirect_to : route('main'); 

                return redirect()->intended($redirectTo);
            }

        }else{
            
            $user = User::create([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'status' => 1,
                'phone' => $request->phone,
            ]);

            event(new Registered($user));

            Auth::login($user);
            return redirect()->intended();
            // return redirect(RouteServiceProvider::HOME);
        }
        
    }
}
