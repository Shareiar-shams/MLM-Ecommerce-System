<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User\Cart;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Session;
use Str;
class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // $redirectResponse = redirect()->intended()->getTargetUrl();

        // // Extract the digitalproduct_id, offer_id, and type from the URL
        // $digitalProductId = null;
        // $offerId = null;
        // $type = null;

        // $urlSegments = explode('/', $redirectResponse);
        // $segmentsCount = count($urlSegments);

        // // Find the segments containing the desired parameters
        // for ($i = 0; $i < $segmentsCount; $i++) {
        //     if (Str::contains($urlSegments[$i], 'digitalproduct')) {
        //         $digitalProductId = $urlSegments[$i + 1] ?? null;
        //     }
        //     if (Str::contains($urlSegments[$i], 'offer')) {
        //         $offerId = $urlSegments[$i + 1] ?? null;
        //     }
        //     if (Str::contains($urlSegments[$i], 'type')) {
        //         $type = $urlSegments[$i + 1] ?? null;
        //     }
        // }

        // dd($digitalProductId);
        

        $request->authenticate();

        $request->session()->regenerate();
        if(session()->has('referrer_params')){
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

            // Clear the stored purchase parameters from the session
            session()->forget('digital_product_purchase_parem');
            return redirect()->route('mlmcheckout', ['digitalproductId' => $digitalproductId, 'offerId' => $offerId]);
        }elseif(session()->has('cart')){
            $user = Auth::user();
            $sessionCart = session()->get('cart', []);
            foreach ($sessionCart as $item) {
                $attributes = serialize($item['attributes']);

                Cart::create([
                    'user_id' => $user->id,
                    'product_id' => $item['id'],
                    'name' => $item['name'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'attributes' => $attributes,
                ]);
            }
            // session()->forget('cart');

            $session_id = Session::getId();
            $cart = Session::get('cart');
            $condition = Session::get('condition');
            // $dbcart = Cart::where('user_id',$user->id)->where('checker',1)->get();
            // if($dbcart){

            //     foreach ($dbcart as $key => $item) {
            //         $attributes = unserialize($item->attributes);
            //         $cart = array(
            //             'id' => $item->id,
            //             'name' => $product->name,
            //             'price' => $totalcost,
            //             'quantity' => $request->quantity,
            //             'attributes' => $attributes,
            //         );
            //         \Cart::session($session_id)->add($cart);
            //     }
            // }
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

        }
        return redirect()->intended();
        // return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
