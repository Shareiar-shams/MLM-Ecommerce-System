<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Admin\CustomizeProductOption;
use App\Models\Admin\Page;
use App\Models\Admin\PaymentGateway;
use App\Models\Admin\Product;
use App\Models\Admin\Shipping;
use App\Models\Admin\coupon;
use App\Models\User;
use App\Models\User\Cart;
use Auth;
use Illuminate\Http\Request;
use Session;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // \Cart::session(Session::getId())->clearCartConditions();
        // dd(\Cart::session(Session::getId())->getConditions());
        // dd(\Cart::session(Session::getId())->getContent());
        return view('user.cart');
    }

    public function check($id){
        $product = Product::find($id);

        // Initialize the attributes array
        $attributes = [];
        $attribute_price = [];
        $optionPrice = 0;


        $attributes_value = (isset($product->attribute)) ? $product->attribute : null;

        $attributeOptions_value = (isset($product->attributeOptions)) ? $product->attributeOptions : null;

        if ($attributeOptions_value->isNotEmpty() && isset($attributes_value)) {

            $productAttributeIds = $attributes_value->pluck('id')->toArray();


            foreach ($attributeOptions_value as $attributeOption) {
                if (in_array($attributeOption->attribute_id, $productAttributeIds)) {
                    // Retrieve the attribute corresponding to the option
                    $attribute = $attributes_value->where('id', $attributeOption->attribute_id)->first();

                    // Retrieve the first attribute option for the current attribute
                    $firstOption = $attributeOption->value;
                    // Add the first option to the array if available
                    if (!isset($attributes[$attribute->name])) {
                        $optionPrice += (int)$attributeOption->price;
                        $attributes[$attribute->name] = $firstOption ?? null;

                        $attribute_price[$firstOption] = $attributeOption->price ?? null;
                        // Break the loop after finding the first option for each attribute
                        // break;
                    }
                }
            }
            dd($attributes);
        }
    }
    public function getCartSessionDisplay() {
        // Fetch updated cart information
        $cartContent = \Cart::session(Session::getId())->getContent();
        return view('user.layouts.includeFile.cart-drop', compact('cartContent'));
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
        $this->validate($request,[
            'id' => 'required',
            
            'quantity' => 'required|numeric|min:1',
            
        ]);

        $session_id = Session::getId();
        $product = Product::find($request->id);
        $optionPrice = 0;
        $productCustomizeAttributes = $request->input('customization_attribute', []);
        // Convert array to collection for easier processing
        $selectedOptionIds = collect($productCustomizeAttributes);
        $selectedOptions = CustomizeProductOption::whereIn('id', $selectedOptionIds)->get();

        $customizeOptionStore = [];
        if(!empty($selectedOptions)){

            if($request->customizeOptionPrice){
                $optionPrice += (int)$request->customizeOptionPrice;
            }
            // Loop through selected options and build an array of options
            foreach ($selectedOptions as $option) {
                $customizeOptionStore[] = [ // Use array append operator
                  'option_id' => $option->id,
                  'option_type' => $option->option_type,
                  'option_name' => $option->option_name,
                  'option_value' => $option->option_value,
                  'option_image' => $option->image
                ];
            }
        }

        $productAttributes = $request->input('product_attribute', []);
        $productAttributeOptions = $request->input('product_attribute_option', []);

        $refferer = $request->refferer_id;
        // Initialize the attributes array
        $attributes = [];
        $attribute_price = [];
        
        if(!empty($productAttributes)){
            // Loop through the attributes and options to build the associative array
            for ($i = 0; $i < count($productAttributes); $i++) {
                // Assuming the attribute name is unique, use it as the key
                $data = explode("&", $productAttributeOptions[$i]);
                $optionPrice += (int)$data[0];
                $attributes[$productAttributes[$i]] = $data[1] ?? null;

                $attribute_price[$data[1]] = $data[0] ?? null;

            }
        }else{

            $attributes_value = (isset($product->attribute)) ? $product->attribute : null;
            $attributeOptions_value = (isset($product->attributeOptions)) ? $product->attributeOptions : null;

            if ($attributeOptions_value->isNotEmpty() && isset($attributes_value)) {

                $productAttributeIds = $attributes_value->pluck('id')->toArray();


                foreach ($attributeOptions_value as $attributeOption) {
                    if (in_array($attributeOption->attribute_id, $productAttributeIds)) {
                        // Retrieve the attribute corresponding to the option
                        $attribute = $attributes_value->where('id', $attributeOption->attribute_id)->first();

                        // Retrieve the first attribute option for the current attribute
                        $firstOption = $attributeOption->value;
                        // Add the first option to the array if available
                        if (!isset($attributes[$attribute->name])) {
                            $optionPrice += (int)$attributeOption->price;
                            $attributes[$attribute->name] = $firstOption ?? null;

                            $attribute_price[$firstOption] = $attributeOption->price ?? null;
                            // Break the loop after finding the first option for each attribute
                            // break;
                        }
                    }
                }
            }

        }
        if(Auth::guest())
        {
            $totalcost = (isset($product->special_price)) ? $product->special_price+$optionPrice : $product->price+$optionPrice;
            $cart = session()->get('cart');
            // $user_id = Auth::user()->id;
            
            $cart[] = $carts = array(
                'id' => $request->id,
                'name' => $product->name,
                'price' => $totalcost,
                'quantity' => $request->quantity,
                'attributes' => array(
                    'image' => $product->featured_image,
                    // 'size' => $product->product_size,
                    // 'color' => $request->attribute_pa_color,
                    'attributes' => $attributes,
                    'customizeOptionStore' => $customizeOptionStore,
                    'refferer' => $refferer,
                    'attributes_value' => $attribute_price,
                    'slug' => $product->slug,
                    'SKU' => $product->SKU,
                    'category'=>$product->category->slug,
                    'subcategory'=>(isset($product->subCategory)) ? $product->subCategory->slug : null
                )
            );
            \Cart::session($session_id)->add($carts);
            session()->put('cart', $cart);
        }else{
            $totalcost = (isset($product->special_price)) ? $product->special_price+$optionPrice : $product->price+$optionPrice;
            $cart = array(
                'id' => $request->id,
                'name' => $product->name,
                'price' => $totalcost,
                'quantity' => $request->quantity,
                'attributes' => array(
                    'image' => $product->featured_image,
                    // 'size' => $product->product_size,
                    // 'color' => $request->attribute_pa_color,
                    'attributes' => $attributes,
                    'customizeOptionStore' => $customizeOptionStore,
                    'refferer' => $refferer,
                    'attributes_value' => $attribute_price,
                    'slug' => $product->slug,
                    'SKU' => $product->SKU,
                    'category'=>$product->category->slug,
                    'subcategory'=>(isset($product->subCategory)) ? $product->subCategory->slug : null,
                )
            );

            $data = new Cart();
            $data->user_id = Auth::user()->id;
            $data->product_id = $request->id;
            $data->price = $totalcost;
            $data->quantity = $request->quantity;
            $data->attributes = serialize($cart['attributes']);

            $data->save();

            \Cart::session($session_id)->add($cart);
            
            
        }
        

        $notification = array(
            'message' => 'Product has been added to your cart!', 
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
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
        $this->validate($request,[
            'quantity' => 'required|numeric|min:1',
        ]);

        $session_id = Session::getId();
        $product = product::findOrFail($id);
        $stock = $product->stock;

        if ($request->quantity < $stock){
            \Cart::session($session_id)->update($id,
                array(
                    'quantity' => array(
                        'relative' => false,
                        'value' => $request->quantity
                    ),
            ));
            $notification = array(
                'message' => 'Cart Updated!', 
                'alert-type' => 'success',
            );
            return redirect()->back()->with($notification);
        }
        else{

            $notification = array(
                'message' => 'Product Out of Stock!', 
                'alert-type' => 'warning',
            );
            return redirect()->back()->with($notification);
        }
       
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $session_id = Session::getId();
        \Cart::session($session_id)->remove($id);
        $notification = array(
            'message' => 'Item has been removed from your cart!', 
            'alert-type' => 'error',
        );
        return redirect()->back()->with($notification);
    }

    /**
     * Remove the all cart products from storage.
     */
    public function cartDestroy()
    {
        $session_id = Session::getId();
        \Cart::session($session_id)->clear();
        $notification = array(
            'message' => 'Cart Cleard!', 
            'alert-type' => 'error',
        );
        return redirect()->back()->with($notification);
    }

    /**
     * Display a listing of the resource.
     */
    public function wishlist()
    {
        if (Auth::check()) 
        {
            $user = User::find(Auth::user()->id);

            $wishProduct = $user->wishlist('User Wishlist');
            return view('user.wishlist',compact('wishProduct'));
        }
        return redirect(route('login'));
    }
    public function wish(Request $request)
    {
        if (Auth::check()) 
        {
            $user = User::find(Auth::user()->id);
            $product = Product::find($request->id);

            $user->wish($product, 'User Wishlist');
            $notification = array(
                'message' => 'Product Add Wishlist!', 
                'alert-type' => 'success',
            );
            return redirect()->back()->with($notification);
        }
        return redirect(route('login'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function wishlistProductDelete(string $id)
    {
        $user = User::find(Auth::user()->id);
        $product = Product::find($id);

        $user->unwish($product,'User Wishlist');
        $notification = array(
            'message' => 'Product Delete From Wishlist!', 
            'alert-type' => 'error',
        );
        return redirect()->back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function clearWishList()
    {
        $user = User::find(Auth::user()->id);

        $user->clearwish('User Wishlist');
        $notification = array(
            'message' => 'Wishlist cleared!', 
            'alert-type' => 'error',
        );
        return redirect()->back()->with($notification);
    }


    public function coupon_applied(Request $request)
    {
        $this->validate($request,[
            'code' => 'required',
        ]);
        $session_id = Session::getId();
        $coupon = coupon::where('code',$request->code)->where('status',1)->first();
        // \Cart::session($session_id)->removeCartCondition('Moury');
        // dd(\Cart::session($session_id)->getConditions());

        if (!$coupon) {
            $notification = array(
                'message' => 'Invalid coupon code. Please try again.', 
                'alert-type' => 'error',
            );
            // return redirect()->back()->with($notification);
            return response()->json(['success' => false, 'error' => 'Coupon not found']);
        }
        elseif ($coupon)
        {
            // Check if a coupon condition already exists in the cart
            // $existingCouponCondition = count(\Cart::session(Session::getId())->getConditions());
            if (count(\Cart::session(Session::getId())->getConditions()) < 1 ) {
                $value = ($coupon->discount_type == 'amount') ? $coupon->discount : $coupon->discount . '%';
                $display_discount = ($coupon->discount_type == 'amount') ? '৳'. $coupon->discount : $coupon->discount . '%';
                $condition = new \Darryldecode\Cart\CartCondition([
                    'name' => $coupon->title,
                    'type' => 'coupon',
                    'target' => 'total',
                    'value' => '-' . $value,
                    'attributes' => [
                        'code' => $coupon->code,
                        'number_of_times' => $coupon->number_of_times,
                        'discount' => $display_discount,
                    ],
                ]);

                \Cart::session($session_id)->condition($condition);
                session()->put('condition', $condition);
                return response()->json([
                    'success' => true,
                    'title' => $coupon->title,
                    'discount' => $coupon->discount,
                    'discount_type' => $coupon->discount_type,
                ]);
                
            } else {
                return response()->json(['success' => false, 'error' => 'You have already used a coupon.']);
            }
        }
    }

    public function checkout(){
        
        // dd(session()->get('order_data'));
        if (Auth::check()) {
            $cart_items = \Cart::session(Session::getId())->getContent();
            if(count($cart_items) > 0){
                $terms = Page::where('slug', 'like', '%terms%')->first();
                $privacy = Page::where('slug', 'like', '%privacy%')->first();
                $shipping_fixed = Shipping::first();
                $shippings = Shipping::where('title', 'NOT LIKE', '%Free%')->get();

                $gateways = PaymentGateway::where('status',1)->get();
                $cartContent = \Cart::session(Session::getId())->getContent();
                return view('user.checkout', compact('cartContent','shipping_fixed','terms','privacy','gateways','shippings'));

            }else{
                return redirect(route('cart.index'));
            }
        }else{
            $checkoutRoute = route('checkout');
            session()->put('checkoutRoute', $checkoutRoute);
            return redirect()->route('login');
        }

    }


    public function billing_data_update(Request $request)
    {
        $this->validate($request,[
            'billing_first_name' => 'required',
            'billing_last_name' => 'required',
            'billing_email' => 'required',
            'billing_phone' => 'required',
            'billing_company' => 'nullable',
            'billing_address' => 'required',
            'billing_address_op' => 'nullable',
            'billing_town_city' => 'required',
            'postal_code' => 'required',
            'order_notes' => 'nullable',
            
        ]);

        $sanitizedAddress = htmlspecialchars($request->billing_address) . ' ' . htmlspecialchars($request->billing_address_op);
        $address = trim($sanitizedAddress);
        // $address = $request->billing_address.$request->billing_address_op;
        $session_id = Session::getId();

        $billing_data = session()->get('order_data');
            // $user_id = Auth::user()->id;
        $data = array(
            'billing_first_name' => $request->billing_first_name,
            'billing_last_name' => $request->billing_last_name,
            'billing_email' => $request->billing_email,
            'billing_phone' => $request->billing_phone,
            'billing_company' => $request->billing_company,
            'billing_address' => $address,
            'billing_town_city' => $request->billing_town_city,
            'postal_code' => $request->postal_code,
            'order_notes' => $request->order_notes,
            
        );
        if($request->same_ship_address == 1){
            $data['shipping_first_name'] = $request->billing_first_name;
            $data['shipping_last_name'] = $request->billing_last_name;
            $data['shipping_email'] = $request->billing_email;
            $data['shipping_phone'] = $request->billing_phone;
            $data['shipping_company'] = $request->billing_company;
            $data['shipping_address'] = $address;
            $data['shipping_town_city'] = $request->billing_town_city;
            $data['shipping_postal_code'] = $request->postal_code;
        }
        session()->put('order_data', $data);
        return redirect()->back();
    }

    public function shipping_data_update(Request $request)
    {
        $this->validate($request,[
            'shipping_first_name' => 'required',
            'shipping_last_name' => 'required',
            'shipping_email' => 'required',
            'shipping_phone' => 'required',
            'shipping_company' => 'nullable',
            'shipping_address' => 'required',
            'shipping_address_op' => 'nullable',
            'shipping_town_city' => 'required',
            'shipping_postal_code' => 'required',
            
        ]);

        $sanitizedShippingAddress = htmlspecialchars($request->shipping_address) . ' ' . htmlspecialchars($request->shipping_address_op);
        $shipping_address = trim($sanitizedShippingAddress);
        // $address = $request->shipping_address.$request->shipping_address_op;
        // $session_id = Session::getId();

        $shipping_data = session()->get('order_data');

        if (!$shipping_data) {
            $shipping_data = []; // Initialize an empty array if not found
        }
            // $user_id = Auth::user()->id;
        $newData = array(
            'billing_first_name' => $shipping_data['billing_first_name'],
            'billing_last_name' => $shipping_data['billing_last_name'],
            'billing_email' => $shipping_data['billing_email'],
            'billing_phone' => $shipping_data['billing_phone'],
            'billing_company' => $shipping_data['billing_company'],
            'billing_address' => $shipping_data['billing_address'],
            'billing_town_city' => $shipping_data['billing_town_city'],
            'postal_code' => $shipping_data['postal_code'],
            'order_notes' => $shipping_data['order_notes'],


            'shipping_first_name' => $request->shipping_first_name,
            'shipping_last_name' => $request->shipping_last_name,
            'shipping_email' => $request->shipping_email,
            'shipping_phone' => $request->shipping_phone,
            'shipping_company' => $request->shipping_company,
            'shipping_address' => $shipping_address,
            'shipping_town_city' => $request->shipping_town_city,
            'shipping_postal_code' => $request->shipping_postal_code,
            
        );

        $shipping_data = array_merge($shipping_data, $newData);
        session()->put('order_data', $shipping_data);

        return redirect()->back();
    }

    public function shipping_method_option(Request $request)
    {
        $total = \Cart::session(Session::getId())->getTotal();

        if ($request->shipping_id) {
            $total = $total + $request->shipping_cost;
        }

        $shipping_method_data = session()->get('order_data');

        if (!$shipping_method_data) {
            $shipping_method_data = []; // Initialize an empty array if not found
        }

        $shipping_method_data = array_merge($shipping_method_data, [
            'shipping_id' => $request->shipping_id,
            'shipping_title' => $request->shipping_title,
            'shipping_cost' => $request->shipping_cost,
            'total_cost' => $total,
        ]);

        session()->put('order_data', $shipping_method_data);

        return response()->json([
            'shipping_method_cost' => $request->shipping_cost,
            'total' => $total,
        ]);
    }

    public function test()
    {
        return view('user.methodcheck');
    }

    public function session_data()
    {
        $orderData = session('order_data');

        if (isset($orderData) && !empty($orderData)) {
            return response()->json(['success' => true, 'data' => $orderData]);
        } else {
            return response()->json(['success' => false, 'message' => 'No order data found']);
        }
    }
}
