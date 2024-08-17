<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ProductsExport;
use App\Http\Controllers\Controller;
use App\Imports\ProductsImport;
use App\Models\Admin\Offer;
use App\Models\Admin\OfferProduct;
use App\Models\Admin\Product;
use App\Models\Admin\ProductCategory;
use App\Models\Admin\ProductImage;
use App\Models\Admin\ProductType;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('permission:view product', ['only' => ['index','stockout','campaign_offer','imexport']]);
        $this->middleware('permission:create product', ['only' => ['add','create','affiliatecreate','customizecreate','store','addPermissionToRole','givePermissionToRole']]);
        $this->middleware('permission:update product', ['only' => ['update','edit']]);
        $this->middleware('permission:delete product', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $products = Product::query();

        if (isset($request->productType)) {
            $products->where('productType', $request->input('productType'));
        }

        if (isset($request->is_type)) {
            $products->where('type_id', $request->input('is_type'));
        }
        if (isset($request->category)) {
            $products->where('category_id', $request->input('category'));
        }

        if (isset($request->orderby)) {
            $orderBy = $request->input('orderby');
            $products->orderBy('id',$orderBy);
            // Add more ordering options if needed
        }

        $products = $products->get();
        // $products = Product::all();
        $categories = ProductCategory::with('children')->whereNull('parent_id')->orderBy('id','DESC')->get();
        $types = ProductType::where('status',true)->get();
        return view('admin.product.item.index',compact('products','categories','types'));
    }

    /**
     * Display a listing of the resource.
     */
    public function add()
    {
        return view('admin.product.item.add');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sku = Str::random(10);
        $type = ProductType::where('status',1)->orderBy('id','DESC')->get();
        $categories = ProductCategory::where('parent_id',null)->get();
        return view('admin.product.item.physical.create',compact('sku','categories','type'));
    }

    public function img_dlt(Request $request)
    {
         
        $id = $request->id;
         
        $image = ProductImage::where('id',$id)->delete();
    }
    /**
     * Show the form for creating a new resource.
     */
    public function affiliatecreate()
    {
        $sku = Str::random(10);
        $type = ProductType::where('status',1)->orderBy('id','DESC')->get();
        $categories = ProductCategory::where('parent_id',null)->get();
        return view('admin.product.item.affiliate.create',compact('sku','categories','type'));
    }

    public function customizecreate()
    {
        $sku = Str::random(10);
        $type = ProductType::where('status',1)->orderBy('id','DESC')->get();
        $categories = ProductCategory::where('parent_id',null)->get();
        return view('admin.product.item.customize.create',compact('sku','categories','type'));
    }

    public function change_status(Request $request,$id)
    {
        $this->validate($request,[
            'status' => 'required',
        ]);
        $item = Product::find($id);

        $item->status = $request->status;
        $item->save(); 
        $notification = array(
            'message' => 'Status Change!', 
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|min:3',
            'slug' => 'required|min:3|max:255|unique:products',
            'SKU' => 'required|min:3|max:255|unique:products',
            'affiliate_link' => 'nullable',
            'featured_image.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|dimensions:min_width=100,min_height=100',
            'gallery_image.*' => 'sometimes|image|mimes:jpg,jpeg,png,gif,svg|dimensions:min_width=100,min_height=100',
            'short_description' => 'required',
            'description' => 'required',
            'productType' => 'required',
            'tags' => 'nullable',
            'specifications' => 'nullable',
            'specification_name' => 'nullable',
            'specification_description' => 'nullable',
            'stock' => 'nullable|numeric',
            'type_id'   => 'required|numeric',
            'category_id'   => 'required|numeric',
            'subcategory_id'   => 'nullable|numeric',
            'price' => 'required|numeric',
            'special_price' => 'nullable|numeric',
            'video_link' => 'nullable',
            'meta_keywords' => 'nullable',
            'meta_descriptions' => 'nullable',
            'customize_charge' => 'nullable',
        ]);

        if($request->hasFile('featured_image'))
        {
            $imageName = $request->featured_image->getClientOriginalName();
            $imageName = $request->featured_image->store('public');
        }

        $tags = isset($request->tags) ? json_encode($request->tags) : null;
        $specification_name = isset($request->specification_name) ? json_encode($request->specification_name) : null;
        $specification_description = isset($request->specification_description) ? json_encode($request->specification_description) : null;

        $meta_keywords = isset($request->meta_keywords) ? json_encode($request->meta_keywords) : null;

        $item = new Product();
        $item->name = $request->name;
        $item->slug = $request->slug;
        $item->affiliate_link = $request->affiliate_link;
        $item->SKU = $request->SKU;
        $item->featured_image = $imageName;
        $item->short_description = $request->short_description;
        $item->description = $request->description;
        $item->productType = $request->productType;
        $item->tags = $tags;
        $item->specifications = $request->specifications;
        $item->specification_name = $specification_name;
        $item->specification_description = $specification_description;
        $item->stock = $request->stock;
        $item->type_id = $request->type_id;
        $item->category_id = $request->category_id;
        $item->subcategory_id = $request->subcategory_id;
        $item->price = $request->price;
        $item->special_price = $request->special_price;
        $item->video_link = $request->video_link;
        $item->meta_keywords = $meta_keywords;
        $item->meta_descriptions = $request->meta_descriptions;
        $item->customize_charge = $request->customize_charge;
        $item->save(); 
        if($request->file('gallery_image'))
        {
            foreach ($request->file('gallery_image') as $image) {
                $productImage = new ProductImage;
                $name = $image->getClientOriginalName();
                $imageName = $image->store('public');
                // $path = 'images/product/'.$item->slug.'/'.$imagename;
                // $image->move($path);
                $productImage->product_id = $item->id;
                $productImage->image_path = $imageName;
                $productImage->save();
            }
        }
        $notification = array(
            'message' => 'Item Add Successfully!', 
            'alert-type' => 'success',
        );
        return redirect(route('item.index'))->with($notification);
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
        $type = ProductType::where('status',1)->orderBy('id','DESC')->get();
        $categories = ProductCategory::where('parent_id',null)->get();
        $product = Product::find($id);

        if($product->productType == "physical")
            return view('admin.product.item.physical.edit',compact('product','categories','type'));
        if($product->productType == "customize")
            return view('admin.product.item.customize.edit',compact('product','categories','type'));
        else
            return view('admin.product.item.affiliate.edit',compact('product','categories','type'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request,[
            'name' => 'required|min:3',
            'slug' => 'required|min:3|max:255',
            'SKU' => 'required|min:3|max:255',
            'affiliate_link' => 'nullable',
            'featured_image.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|dimensions:min_width=100,min_height=100',
            'gallery_image.*' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|dimensions:min_width=100,min_height=100',
            'short_description' => 'required',
            'description' => 'required',
            'productType' => 'required',
            'tags' => 'nullable',
            'specifications' => 'nullable',
            'specification_name' => 'nullable',
            'specification_description' => 'nullable',
            'stock' => 'nullable|numeric',
            'type_id'   => 'required|numeric',
            'category_id'   => 'required|numeric',
            'subcategory_id'   => 'nullable|numeric',
            'price' => 'required|numeric',
            'special_price' => 'nullable|numeric',
            'video_link' => 'nullable',
            'meta_keywords' => 'nullable',
            'meta_descriptions' => 'nullable',
            'customize_charge' => 'nullable',
        ]);


        $tags = isset($request->tags) ? json_encode($request->tags) : null;
        $specification_name = isset($request->specification_name) ? json_encode($request->specification_name) : null;
        $specification_description = isset($request->specification_description) ? json_encode($request->specification_description) : null;

        $meta_keywords = isset($request->meta_keywords) ? json_encode($request->meta_keywords) : null;

        $item = Product::find($id);

        if($request->hasFile('featured_image'))
        {
            $imageName = $request->featured_image->getClientOriginalName();
            $imageName = $request->featured_image->store('public');
        }else{

            $imageName = $item->featured_image;
        }
        
        $item->name = $request->name;
        $item->slug = $request->slug;
        $item->affiliate_link = $request->affiliate_link;
        $item->SKU = $request->SKU;
        $item->featured_image = $imageName;
        $item->short_description = $request->short_description;
        $item->description = $request->description;
        $item->productType = $request->productType;
        $item->tags = $tags;
        $item->specifications = $request->specifications;
        $item->specification_name = $specification_name;
        $item->specification_description = $specification_description;
        $item->stock = $request->stock;
        $item->type_id = $request->type_id;
        $item->category_id = $request->category_id;
        $item->subcategory_id = $request->subcategory_id;
        $item->price = $request->price;
        $item->special_price = $request->special_price;
        $item->video_link = $request->video_link;
        $item->meta_keywords = $meta_keywords;
        $item->meta_descriptions = $request->meta_descriptions;
        $item->customize_charge = $request->customize_charge;
        $item->save(); 
        if($request->file('gallery_image'))
        {
            foreach ($request->file('gallery_image') as $image) {
                $productImage = new ProductImage;
                $name = $image->getClientOriginalName();
                $imageName = $image->store('public');
                
                $productImage->product_id = $item->id;
                $productImage->image_path = $imageName;
                $productImage->save();
            }
        }
        $notification = array(
            'message' => 'Item Update Successfully!', 
            'alert-type' => 'success',
        );
        return redirect(route('item.index'))->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Product::where('id',$id)->delete();
        productImage::where('product_id',$id)->delete();
        $notification = array(
            'message' => 'Product destroy.', 
            'alert-type' => 'error',
        );
        return redirect()->back()->with($notification);
    }

    public function export()
    {
        return Excel::download(new ProductsExport, 'products.csv');
    }

    public function import(Request $request)
    {
        $file = $request->file('csv');
        Excel::import(new ProductsImport, $file);

        $notification = array(
            'message' => 'Products imported successfully!', 
            'alert-type' => 'success',
        );
        return redirect(route('item.index'))->with($notification);
    }

    public function imexport()
    {
        return view('admin.product.item.import-export');
    }

    public function stockout()
    {
        $products = Product::where('productType','physical')->where('stock',0)->get();
        return view('admin.product.item.stock-out',compact('products'));
    }

    public function campaign_offer()
    {
        $campaign = Offer::where('offer_for','ecommerceproduct')->first();
        $products = Product::where('productType','physical')->where('status',1)->get();
        return view('admin.product.item.campaign',compact('campaign','products'));
    }

    public function product_campaing(Request $request, $id)
    {
        $this->validate($request,[
            'product_id' => 'required',
        ]);

        $offer = Offer::findOrFail($id);
        $productId = $request->input('product_id');
        $product = Product::find($productId);
        if(count($product->offers) < 1){
            $offer->products()->attach($productId); 
            $notification = array(
                'message' => 'Product add with this offer!', 
                'alert-type' => 'success',
            );
        }else{

            $notification = array(
                'message' => 'This Product already associate with other offer!', 
                'alert-type' => 'error',
            );
        }
        
        return redirect(route('product.campaign.offer'))->with($notification);
    }

    public function status(Request $request,$id)
    {
        $this->validate($request,[
            'status' => 'required',
        ]);
        $item = OfferProduct::find($id);

        $item->status = $request->status;
        $item->save(); 
        $notification = array(
            'message' => 'Status Change!', 
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    public function delete(string $id)
    {
        OfferProduct::where('id',$id)->delete();
        $notification = array(
            'message' => 'Product dissociate from offer!', 
            'alert-type' => 'error',
        );
        return redirect()->back()->with($notification);
    }
}
