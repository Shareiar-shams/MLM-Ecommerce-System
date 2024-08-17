<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Mail\MlmInvoiceEmail;
use App\Mail\Websitemail;
use App\Models\Admin\Contact;
use App\Models\Admin\DigitalProduct;
use App\Models\Admin\FaqCategory;
use App\Models\Admin\IndexDynamicData;
use App\Models\Admin\Mlmuser;
use App\Models\Admin\Offer;
use App\Models\Admin\Order;
use App\Models\Admin\Page;
use App\Models\Admin\PaymentGateway;
use App\Models\Admin\Product;
use App\Models\Admin\ProductCategory;
use App\Models\Admin\ProductType;
use App\Models\Admin\Review;
use App\Models\Admin\SelectedCategory;
use App\Models\Admin\Setting;
use App\Models\Admin\Slider;
use App\Models\User;
use App\Models\User\OrderedItem;
use App\Models\User\SubmittedMail;
use App\Models\User\Subscribe;
use Auth;
use DB;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use Session;


class ViewportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $productOffer = null;
        // $currentDate = Carbon::now()->format('d-m-Y');
        $digital_products = DigitalProduct::where('status',1)->get();
        $sliders = Slider::where('status',1)->get();
        $upcoming_products = DigitalProduct::where('status',0)->get();
        $categoriesProducts = Product::where('status',true)->where('productType', '!=', 'customize')->get();
        // $types = ProductType::where('status',true)->orderBy('id', 'ASC')->limit(4)->get();
        // $Typeproduct = Product::where('status',true)->orderBy('id', 'ASC')->limit(4)->get();
        $campaign = Offer::where('offer_for','ecommerceproduct')->first();
        $Typeproduct = $categoriesProducts;

        $productType = ProductType::where('single_type', true)->first();

        // Load the Blade view and convert it to HTML
        if ($productType) {
            $slider_products = $productType->products()->where('status',true)->where('productType', '!=', 'customize')->inRandomOrder()->get();
        } else {
            $slider_products = []; 
        }

        $selectedCategories = SelectedCategory::with('category')->get();
        $indexDatas = IndexDynamicData::where('status', true)->get();
        $double_column = IndexDynamicData::where('mapping','double_column')->get();
        $slider_items = IndexDynamicData::where('mapping','slider_products')->first();
        $site_setting = Setting::first();
        $customize_products = Product::where('productType','customize')->where('status',1)->get();

        return view('user.index',compact('digital_products','sliders','upcoming_products','categoriesProducts','Typeproduct', 'selectedCategories','indexDatas', 'slider_products','double_column','slider_items','site_setting','campaign','customize_products'));
    }

    public function getRecentProductDisplay($slug) {

        $category = ProductCategory::where('slug',$slug)->withCount('products')->first();

        if($category->parent_id === null)
            $Typeproduct = $category->products()->where('status',1)->inRandomOrder()->limit(4)->get();
        else
            $Typeproduct = $category->chindrenproducts()->where('status',1)->inRandomOrder()->limit(4)->get();


        return view('user.home.group_type_product', compact('Typeproduct'));
    }

    public function getAllRecentProductDisplay(){
        $Typeproduct = Product::where('status',true)->where('productType', '!=', 'customize')->orderBy('id', 'ASC')->limit(4)->get();
        return view('user.home.group_type_product', compact('Typeproduct'));  
    }

    public function getProductsByType($productType) {
        $products = ProductType::where('slug', $productType)
            ->first()
            ->products()
            ->inRandomOrder()
            ->limit(4)
            ->get();
        // dd($products);

        return response()->json($products);
    }


    /**
     * Display a listing of the resource.
     */
    public function about()
    {
        $about = Page::where('slug','about')->first();
        return view('user.about',compact('about'));
    }

    public function invoice()
    {

        $invoiceData = [
            'title' => "Invoice for Your Purchase Digital Product",
            'invoiceNo' => uniqid(),
            'name' => Auth::user()->name,
            'email' => 'islamshareiar@gmail.com',
            'address' => Auth::user()->address,
            'amount' => "90",
            'productName' => "Laravel",
            'productSKU' => "987921334",
            'paymentMethod' => "Bkash",
            'transection_id' => "TUJ743G8FJR34",
        ];

        // Send the email with the attached invoice
        Mail::to('islamshareiar@gmail.com')->later(now()->addMinutes(1),new MlmInvoiceEmail($invoiceData));

        dd('invoice send successfully');
    }

    /**
     * Display a listing of the resource.
     */
    public function contact()
    {
        $contact = Contact::first();
        return view('user.contact',compact('contact'));
    }

    /**
     * Display a listing of the resource.
     */
    public function affiliate()
    {
        $digital_products = DigitalProduct::where('status',1)->get();
        $upcoming_products = DigitalProduct::where('status',0)->get();
        return view('user.affiliate',compact('digital_products','upcoming_products'));
    }

    /**
     * Display a listing of the resource.
     */
    public function mlmProduct($slug)
    {
        $productOffer = null;
        $product = DigitalProduct::where('slug',$slug)->first();
        $upcoming_products = DigitalProduct::where('status',0)->get();
        if(isset($product->offer) && $product->offer->status == 1 && $product->offer->offer_for === "digitalproduct" && $product->offer->offer_type === "normal"){

            $productOffer = Offer::where('id',$product->offer->id)->first();
        }

        return view('user.mlmproduct',compact('product','upcoming_products','productOffer'));
    }

    /**
     * Display a listing of the resource.
     */
    public function products()
    {
        $bestSellers = OrderedItem::select('*', DB::raw('SUM(quantity) as total_sold'))
            ->join('products', 'ordered_items.product_id', '=', 'products.id')
            ->groupBy('ordered_items.product_id')
            ->orderBy('total_sold', 'desc')
            ->limit(5) // Limit to top 10 best sellers (adjust as needed)
            ->get();
        $categories = ProductCategory::with('children')->whereNull('parent_id')->orderBy('id','DESC')->get();
        $types = ProductType::where('status',true)->inRandomOrder()->limit(4)->get();
        $products = Product::where('status',true)->where('productType', '!=', 'customize')->inRandomOrder()->paginate(15);
        return view('user.products',compact('categories','types','products','bestSellers'));
    }
    public function user_shop($encryptedUserId='')
    {
        $bestSellers = OrderedItem::select('products.id', 'products.name', DB::raw('SUM(quantity) as total_sold'))
            ->join('products', 'ordered_items.product_id', '=', 'products.id')
            ->groupBy('ordered_items.product_id')
            ->orderBy('total_sold', 'desc')
            ->limit(5) // Limit to top 10 best sellers (adjust as needed)
            ->get();
        $reffererId = Crypt::decrypt($encryptedUserId);
        $referrer_details = Mlmuser::where('id',$reffererId)->first();

        $categories = ProductCategory::with('children')->whereNull('parent_id')->orderBy('id','DESC')->get();
        $types = ProductType::where('status',true)->inRandomOrder()->limit(4)->get();
        $products = $referrer_details->products()->paginate(15);
        return view('user.products',compact('categories','types','products','referrer_details','bestSellers'));
    }
    public function product_show_type($slug)
    {
        $bestSellers = OrderedItem::select('products.id', 'products.name', DB::raw('SUM(quantity) as total_sold'))
            ->join('products', 'ordered_items.product_id', '=', 'products.id')
            ->groupBy('ordered_items.product_id')
            ->orderBy('total_sold', 'desc')
            ->limit(5) // Limit to top 10 best sellers (adjust as needed)
            ->get();

        $type = ProductType::where('slug',$slug)->first();
        $products = $type->products()->where('status',1)->where('productType', '!=', 'customize')->orderBy('created_at','DESC')->paginate(15);

        $categories = ProductCategory::with('children')->whereNull('parent_id')->orderBy('id','DESC')->get();

        $types = ProductType::where('status',true)->inRandomOrder()->limit(4)->get();

        return view('user.products',compact('categories','types','products','bestSellers'));
    }

    public function product_search(Request $request, $category)
    {
        $this->validate($request,[
            'search' => 'required',
        ]);
        $category = ProductCategory::where('slug',$category)->withCount('products')->first();
        $search = $request->input('search');

        if(empty($category)){
            $products = Product::where('status',1)->where('productType', '!=', 'customize')
                ->where(function($query) use ($search){
                $query->where('name', 'LIKE',  '%'.$search .'%')
                      ->orWhere('slug', 'LIKE',  '%'.$search .'%')
                      ->orWhere('short_description', 'LIKE',  '%'.$search .'%')
                      ->get();
                })->orderBy('created_at','DESC')->paginate(15);
        }else{
            if($category->parent_id === null)
                $field_name = 'category_id';
            else
                $field_name = 'subcategory_id';

            $products = Product::where('status',1)->where('productType', '!=', 'customize')->where($field_name, $category->id)
                ->where(function($query) use ($search){
                $query->where('name', 'LIKE',  '%'.$search .'%')
                      ->orWhere('slug', 'LIKE',  '%'.$search .'%')
                      ->orWhere('short_description', 'LIKE',  '%'.$search .'%')
                      ->get();
                })->orderBy('created_at','DESC')->paginate(15);
        }

        
        $categories = ProductCategory::with('children')->whereNull('parent_id')->orderBy('id','DESC')->get();

        $types = ProductType::where('status',true)->inRandomOrder()->limit(4)->get();
        $bestSellers = OrderedItem::select('products.id', 'products.name', DB::raw('SUM(quantity) as total_sold'))
            ->join('products', 'ordered_items.product_id', '=', 'products.id')
            ->groupBy('ordered_items.product_id')
            ->orderBy('total_sold', 'desc')
            ->limit(5) // Limit to top 10 best sellers (adjust as needed)
            ->get();

        return view('user.products',compact('categories','types','products','bestSellers'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $products = Product::where('productType', '!=', 'customize')->where('name', 'like', "%$query%")->limit(5)->get();

        return response()->json($products);
    }

    public function shopcategories($category)
    {
        if($category == "all"){
            $products = Product::where('status',true)->inRandomOrder()->paginate(15);

        }else{

            $category = ProductCategory::where('slug',$category)->withCount('products')->first();

            if($category->parent_id === null)
                $products = $category->products()->where('status',1)->where('productType', '!=', 'customize')->orderBy('created_at','DESC')->paginate(15);
            else
                $products = $category->chindrenproducts()->where('status',1)->where('productType', '!=', 'customize')->orderBy('created_at','DESC')->paginate(15);
        }

        $categories = ProductCategory::with('children')->whereNull('parent_id')->orderBy('id','DESC')->get();

        $types = ProductType::where('status',true)->inRandomOrder()->limit(4)->get();
        $bestSellers = OrderedItem::select('products.id', 'products.name', DB::raw('SUM(quantity) as total_sold'))
            ->join('products', 'ordered_items.product_id', '=', 'products.id')
            ->groupBy('ordered_items.product_id')
            ->orderBy('total_sold', 'desc')
            ->limit(5) // Limit to top 10 best sellers (adjust as needed)
            ->get();
        
        return view('user.products',compact('products','categories','types','bestSellers'));
    }

    public function price_range_category(Request $request, $category)
    {
        $category = ProductCategory::where('slug',$category)->withCount('products')->first();
        if(!empty($category)){

            if($category->parent_id === null)
                $query = $category->products()->where('status',1)->where('productType', '!=', 'customize')->orderBy('created_at','DESC');
            else
                $query = $category->chindrenproducts()->where('status',1)->where('productType', '!=', 'customize')->orderBy('created_at','DESC');
        }else{
            $query = Product::where('status',1)->orderBy('created_at','DESC');
        }
        if($request->min_price && $request->max_price){
            // This will only execute if you received any price
            // Make you you validated the min and max price properly
            $query = $query->where('price','>=',$request->min_price);
            $query = $query->where('price','<=',$request->max_price);
        }

        $products = $query->paginate(15);

        $bestSellers = OrderedItem::select('products.id', 'products.name', DB::raw('SUM(quantity) as total_sold'))
            ->join('products', 'ordered_items.product_id', '=', 'products.id')
            ->groupBy('ordered_items.product_id')
            ->orderBy('total_sold', 'desc')
            ->limit(5) // Limit to top 10 best sellers (adjust as needed)
            ->get();

        $types = ProductType::where('status',true)->inRandomOrder()->limit(4)->get();
        $categories = ProductCategory::with('children')->whereNull('parent_id')->orderBy('id','DESC')->get();
        
        return view('user.products',compact('products','categories','types','bestSellers'));
    }


    public function pagination_category($category, Request $request)
    {
        $category = ProductCategory::where('slug',$category)->withCount('products')->first();
        if(!empty($category)){

            $query = ($category->parent_id === null) ? $category->products() : $category->chindrenproducts();
            
            if($request->ppp){

                if($request->ppp == 'all'){
                    $products = $query->where('status',1)->where('productType', '!=', 'customize')->orderBy('created_at','DESC')->get();
                }else{
                    $products = $query->where('status',1)->where('productType', '!=', 'customize')->orderBy('created_at','DESC')->paginate($request->ppp);
                }
            }else{
                if($request->orderby == 'menu_order')
                {
                    $products = $query->where('status',1)->where('productType', '!=', 'customize')->orderBy('created_at','DESC')->paginate(15);
                }elseif($request->orderby == 'asc'){
                    $products = $query->where('status',1)->where('productType', '!=', 'customize')->orderBy('created_at','ASC')->paginate(15);
                }elseif($request->orderby == 'price'){
                    $products = $query->where('status',1)->where('productType', '!=', 'customize')->orderBy('price','ASC')->paginate(15);
                }elseif($request->orderby == 'price-desc'){
                    $products = $query->where('status',1)->where('productType', '!=', 'customize')->orderBy('price','DESC')->paginate(15);
                }else{
                    $products = $query->where('status',1)->where('productType', '!=', 'customize')->orderBy('created_at','DESC')->paginate(15);
                }
            }
        }else{
            if($request->ppp){
                if($request->ppp == 'all')
                {
                    $products = Product::where('status',1)->where('productType', '!=', 'customize')->orderBy('created_at','DESC')->get();
                }else{
                    $products = Product::where('status',1)->where('productType', '!=', 'customize')->orderBy('created_at','DESC')->paginate($request->ppp);
                }
            }else{
                if($request->orderby == 'menu_order')
                {
                    $products = Product::where('status',1)->where('productType', '!=', 'customize')->orderBy('created_at','DESC')->paginate(15);
                }elseif($request->orderby == 'asc'){
                    $products = Product::where('status',1)->where('productType', '!=', 'customize')->orderBy('created_at','ASC')->paginate(15);
                }elseif($request->orderby == 'price'){
                    $products = Product::where('status',1)->where('productType', '!=', 'customize')->orderBy('price','ASC')->paginate(15);
                }elseif($request->orderby == 'price-desc'){
                    $products = Product::where('status',1)->where('productType', '!=', 'customize')->orderBy('price','DESC')->paginate(15);
                }else{
                    $products = Product::where('status',1)->where('productType', '!=', 'customize')->orderBy('created_at','DESC')->paginate(15);
                }
            }
        }
        $bestSellers = OrderedItem::select('products.id', 'products.name', DB::raw('SUM(quantity) as total_sold'))
            ->join('products', 'ordered_items.product_id', '=', 'products.id')
            ->groupBy('ordered_items.product_id')
            ->orderBy('total_sold', 'desc')
            ->limit(5) // Limit to top 10 best sellers (adjust as needed)
            ->get();
    
        $types = ProductType::where('status',true)->inRandomOrder()->limit(4)->get();
        $categories = ProductCategory::with('children')->whereNull('parent_id')->orderBy('id','DESC')->get();
        
        return view('user.products',compact('products','categories','types','bestSellers'));
    }

    /**
     * Display a listing of the resource.
     */
    public function productDetails($slug)
    {
        $product = Product::where('slug',$slug)->first();

        $attributeOptions = (isset($product->attributeOptions)) ? $product->attributeOptions : null;
        $attributes = (isset($product->attribute)) ? $product->attribute : null;
        return view('user.productDetails',compact('product','attributeOptions','attributes'));
    }

    public function referrer_product($slug, $encryptedUserId='')
    {
        $reffererId = Crypt::decrypt($encryptedUserId);
        $referrer_details = Mlmuser::where('id',$reffererId)->first();
        $product = Product::where('slug',$slug)->first();
        $attributeOptions = (isset($product->attributeOptions)) ? $product->attributeOptions : null;
        $attributes = (isset($product->attribute)) ? $product->attribute : null;
        return view('user.productDetails',compact('product','attributeOptions','attributes','reffererId'));
    }

    public function top_product()
    {
        $products = Product::with('reviews')->where('productType', '!=', 'customize')
              ->select('products.*')
              ->leftJoin('reviews', 'reviews.product_id', '=', 'products.id')
              ->groupBy('products.id')
              ->orderByRaw('AVG(reviews.rating) DESC')
              ->paginate(15);
        $types = ProductType::where('status',true)->inRandomOrder()->limit(4)->get();
        $categories = ProductCategory::with('children')->whereNull('parent_id')->orderBy('id','DESC')->get();
        $bestSellers = OrderedItem::select('products.id', 'products.name', DB::raw('SUM(quantity) as total_sold'))
            ->join('products', 'ordered_items.product_id', '=', 'products.id')
            ->groupBy('ordered_items.product_id')
            ->orderBy('total_sold', 'desc')
            ->limit(5) // Limit to top 10 best sellers (adjust as needed)
            ->get();

        return view('user.products',compact('products','categories','types','bestSellers'));
    }

    public function filterByTag($tag)
    {
        $bestSellers = OrderedItem::select('products.id', 'products.name', DB::raw('SUM(quantity) as total_sold'))
            ->join('products', 'ordered_items.product_id', '=', 'products.id')
            ->groupBy('ordered_items.product_id')
            ->orderBy('total_sold', 'desc')
            ->limit(5) // Limit to top 10 best sellers (adjust as needed)
            ->get();


        $products = Product::where('status',1)->where('productType', '!=', 'customize')->where(function($query) use ($tag){
                $query->where('tags', 'LIKE',  '%'.$tag .'%')->get();
            })->orderBy('created_at','DESC')->paginate(15);

        $categories = ProductCategory::with('children')->whereNull('parent_id')->orderBy('id','DESC')->get();

        $types = ProductType::where('status',true)->inRandomOrder()->limit(4)->get();

        return view('user.products',compact('categories','types','products','bestSellers'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function reviewstore(Request $request, Product $product)
    {
        $request->validate([
            'review' => 'required|string',
            'rating' => 'required|numeric|min:0|max:5',
        ]);
        $review = new Review;
        $review->user_id = Auth()->user()->id;;
        $review->review = $request->review;
        $review->rating = $request->rating;
        $product->reviews()->save($review);
        return redirect()->back()->with('message_review', 'Review Add!' );
    }

    

    /**
     * Display a listing of the resource.
     */
    public function orderTrack(Request $request)
    {
        return view('user.orderTrack');
    }

    public function track_request(Request $request){
        $order = Order::where('tracking_id', $request->tracking_id)->first();
        return response()->json(['order' => $order]);
    }    

    /**
     * Display a listing of the resource.
     */
    public function checkout()
    {
        $cart_items = \Cart::session(Session::getId())->getContent();
        if(count($cart_items) > 0){
            $pages = Page::where('slug', 'like', '%terms%')
             ->orWhere('slug', 'like', '%privacy%')
             ->get();
            dd($pages);
            return view('user.checkout');

        }else{
            return view('user.cart');
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function mlmcheckout(Request $request)
    {
        if (Auth::check()) {
            if(isset(Auth::user()->mlmUser) && Auth::user()->mlmUser->parent_activation == 1 && Auth::user()->mlmUser->admin_activation == 1){

                if( isset(Auth::user()->mlmUser) && Auth::user()->mlmUser->activate_product == $request->digitalproductId){
                    $notification = array(
                        'message' => 'Already You purchased this product', 
                        'alert-type' => 'error',
                    );
                    return redirect(route('main'))->with($notification);
                }

                $productId = $request->digitalproductId;
                $offerId = $request->offerId;
                $gateways = PaymentGateway::where('slug', '!=' , 'cod')->where('status',1)->get();
                $digital_product = DigitalProduct::findOrFail($productId);
                $offer = null;
                if(isset($request->offerId)){

                    $offer = Offer::where('id',$request->offerId)->where('offer_for','digitalproduct')->where('status',1)->first();
                }

                return view('user.mlmcheckout',compact('digital_product','offer','gateways'));

            }
            else{
                if(!isset(Auth::user()->others)){
                    $json_data = array(
                        "digitalproduct" => $request->digitalproductId,
                        "offerId" => $request->offerId
                    );
                    $arr_tojson = json_encode($json_data);
                    $user = User::find(Auth::user()->id);
                    $user->others = $arr_tojson;
                    $user->user_type = 'normal';
                    $user->save();

                    $productId = $request->digitalproductId;
                    $offerId = $request->offerId;
                }else{
                    $user = User::find(Auth::user()->id);
                    $arr_tojson = json_decode($user->others);

                    $productId = $arr_tojson->digitalproduct;
                    $offerId = $arr_tojson->offerId;

                }
                $gateways = PaymentGateway::where('slug', '!=' , 'cod')->where('status',1)->get();
                $digital_product = DigitalProduct::findOrFail($productId);
                $offer = null;
                if(isset($request->offerId)){

                    $offer = Offer::where('id',$request->offerId)->where('offer_for','digitalproduct')->where('status',1)->first();
                }
                return view('user.mlmcheckout',compact('digital_product','offer','gateways'));
            }
        }else{
            Session::put('digital_product_purchase_parem', [
                'digitalproductId' => $request->digitalproductId,
                'offerId' => $request->offerId
            ]);
            // Redirect guests to the login or registration page
            return redirect()->route('login');
        }
    }


    public function payReferre(Request $request){
        $this->validate($request,[
            'invoice' => 'required',
            'productId' => 'required',
            'referrer_id' => 'required',
            
        ]);
        $gatewayType = $gatewayNumber = $accountType = null;
        $refferDetails = User::find($request->referrer_id);

        $user = new Mlmuser();
        $user->user_id = Auth::user()->id;
        $user->parent_id = null;
        $user->refferer_id = $request->referrer_id;
        $user->invoice = $request->invoice;
        $user->reffer_code = $refferDetails->username;
        $user->activate_product = $request->productId;
        $user->parent_activation = 0;
        $user->admin_activation = 0;
        $user->others_documents = null;
        $user->save();  

        $json_data = isset($refferDetails->mlmUser->others_documents) ? $refferDetails->mlmUser->others_documents : null;

        if (isset($json_data)) {
            $json_data = json_decode($json_data);
            $gatewayType = $json_data->payment_gatway_type;
            $gatewayNumber = $json_data->number;
            $accountType = $json_data->type;
        }
        // After saving the user data, prepare the data to be sent in the response
        $response_data = [
            'message' => 'Data saved successfully',
            'gatewayType' => $gatewayType,
            'gatewayNumber' => $gatewayNumber,
            'accountType' => $accountType,
        ];

        // return redirect(route('main'));
        return response()->json($response_data);
    }


    public function campaign_product()
    {
        $campaign = Offer::where('offer_for','ecommerceproduct')->first();
        return view('user.campaign',compact('campaign'));
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
        $validated = $request->validate([
            'email' => 'required|email|unique:subscribes|max:30']
        );

        $token = hash('sha256', time());
        $subscriber = new Subscribe();
        $subscriber->email = $request->email;
        $subscriber->token = $token;
        $subscriber->status = 'Active';
        // $subscriber->save();

        $subscriber->save();

        // Send email
        $subject = 'Comfirmation Subscription Mail';
        $verification_link = url('/products');
        $body_text = "Click Here";
        $message = 'Thanks For subscribed. We are very blessed to have customers like you. Don`t miss our latest product:<br><br>';
        
        // $message .= $verification_link;

        $message .= '<a class="btn btn-primary" href="'.$verification_link.'">';
        $message .= $body_text;
        $message .= '</a><br><br>';
        $message .= 'You can unsubscribe at any time.';

        \Mail::to($request->email)->send(new Websitemail($subject,$message));

        $notification = array(
        'message' => 'Thanks for subscription', 
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }
    
    public function contact_email(Request $request){

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'nullable',
            'message' => 'required'
        ]);

        $contact = new SubmittedMail();

        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->subject = $request->subject;
        $contact->message = $request->message;

        $contact->save();
        \Mail::send('user.contact_mail',
            array(
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'subject' => $request->get('subject'),
                'user_message' => $request->get('message'),
            ), function($message) use ($request)
            {
                $message->from(env('MAIL_FROM_ADDRESS'))->subject($request->subject);
                $message->to(env('MAIL_FROM_ADDRESS'));
            }
        );
        $notification = array(
        'message' => 'Thank you for contact us!', 
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    public function faq()
    {
        $categories = FaqCategory::where('status',1)->orderBy('id','ASC')->get();
        return view('user.faq',compact('categories'));
    }

    public function faq_catalog(string $slug)
    {
        $category = FaqCategory::where('slug',$slug)->first();
        return view('user.faqDetails',compact('category'));
    }

    public function customize_product($slug)
    {   
        $terms = Page::where('slug', 'like', '%terms%')->first();
        $return = Page::where('slug', 'like', '%return%')->first();
        $product = Product::where('slug',$slug)->first();
        return view('user.customize',compact('product','terms','return'));
    }
    public function page(string $slug)
    {
        $page = Page::where('slug',$slug)->first();
        return view('user.page',compact('page'));
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
