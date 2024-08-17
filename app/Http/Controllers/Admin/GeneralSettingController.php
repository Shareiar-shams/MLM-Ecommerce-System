<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Contact;
use App\Models\Admin\Cookie;
use App\Models\Admin\IndexDynamicData;
use App\Models\Admin\Menu;
use App\Models\Admin\ProductCategory;
use App\Models\Admin\ProductType;
use App\Models\Admin\SelectedCategory;
use App\Models\Admin\Setting;
use Illuminate\Http\Request;

class GeneralSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:manage site all settings', ['only' => ['index','app_name_customization','app_logo_customization','app_favicon_customization','app_loader_customization','app_meta_customization','menu_edit','menu_update','menu_status','homePage','single_carousal','single_column','double_column','slider_products','create','selected_categoris_store','store','edit','update','destroy']]);

        $this->middleware('permission:manage cookies', ['only' => ['cookie_show','cookie_update']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menus = Menu::orderBy('id','ASC')->get();
        $setting = Setting::where('id',1)->first();
        $contact = Contact::first();
        return view('admin.general.viewport',compact('menus','setting','contact'));
    }

    public function app_name_customization(Request $request)
    {
        $request->validate([
            'app_name' => 'required',
            'home_page_title' => 'required',
            // Add validation rules for other categories if needed
        ]);

        if(isset($request->id)){

            $data = Setting::find($request->id);
        }
        else{

            $data = new Setting();
        }
        $data->app_name = $request->app_name;
        $data->home_page_title = $request->home_page_title;
        $data->save(); 

    
        $notification = array(
            'message' => 'App Name Successfully Updated', 
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    public function app_logo_customization(Request $request)
    {
        $request->validate([
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            // Add validation rules for other categories if needed
        ]);

        if(isset($request->id)){

            $data = Setting::find($request->id);

            if($request->hasFile('logo'))
            {
                $imageName = $request->logo->getClientOriginalName();
                $imageName = $request->logo->store('public');
            }else{

                $imageName = $data->logo;
            }
        }
        else{
            if($request->hasFile('logo'))
            {
                $imageName = $request->logo->getClientOriginalName();
                $imageName = $request->logo->store('public');
            }

            $data = new Setting();
        }
        $data->logo = $imageName;
        $data->save(); 

    
        $notification = array(
            'message' => 'Logo Successfully Updated', 
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    public function app_favicon_customization(Request $request)
    {
        $request->validate([
            'favicon' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            // Add validation rules for other categories if needed
        ]);

        if(isset($request->id)){

            $data = Setting::find($request->id);

            if($request->hasFile('favicon'))
            {
                $imageName = $request->favicon->getClientOriginalName();
                $imageName = $request->favicon->store('public');
            }else{

                $imageName = $data->favicon;
            }
        }
        else{
            if($request->hasFile('favicon'))
            {
                $imageName = $request->favicon->getClientOriginalName();
                $imageName = $request->favicon->store('public');
            }

            $data = new Setting();
        }
        $data->favicon = $imageName;
        $data->save(); 

    
        $notification = array(
            'message' => 'Logo Successfully Updated', 
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    public function app_loader_customization(Request $request)
    {
        $request->validate([
            'loader' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
            // Add validation rules for other categories if needed
        ]);

        if(isset($request->id)){

            $data = Setting::find($request->id);

            if($request->hasFile('loader'))
            {
                $imageName = $request->loader->getClientOriginalName();
                $imageName = $request->loader->store('public');
            }else{

                $imageName = $data->loader;
            }
        }
        else{
            if($request->hasFile('loader'))
            {
                $imageName = $request->loader->getClientOriginalName();
                $imageName = $request->loader->store('public');
            }

            $data = new Setting();
        }
        $data->loader = $imageName;
        $data->display_loader = $request->display_loader;
        $data->save(); 

    
        $notification = array(
            'message' => 'Logo Successfully Updated', 
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }


    public function app_meta_customization(Request $request)
    {
        $request->validate([
            'index_meta_keyword' => 'required',
            'index_meta_description' => 'nullable',
            // Add validation rules for other categories if needed
        ]);

        if(isset($request->id)){

            $data = Setting::find($request->id);
        }
        else{

            $data = new Setting();
        }

        $meta_keywords = isset($request->index_meta_keyword) ? json_encode($request->index_meta_keyword) : null;

        $data->index_meta_keyword = $meta_keywords;
        $data->index_meta_description = $request->index_meta_description;

        $data->save(); 

    
        $notification = array(
            'message' => 'Meta Successfully Updated', 
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function menu_edit(string $id)
    {
        $menu = Menu::find($id);
        return view('admin.general.menuedit',compact('menu'));
    }

    public function menu_update(Request $request, string $id)
    {
        $this->validate($request,[
            'name' => 'required',
            'route' => 'required',
            'ordering' => 'required',
        ]);

        $data = Menu::findOrFail($id);
        $data->name = $request->name;
        $data->route = $request->route;
        $data->ordering = $request->ordering;
        $data->save();

        $notification = array(
            'message' => 'Successfully Updated', 
            'alert-type' => 'success',
        );
        return redirect()->route('system.index')->with($notification);
    }
    public function menu_status(Request $request,$id)
    {
        $this->validate($request,[
            'status' => 'required',
        ]);
        $item = Menu::find($id);
        $item->status = $request->status;
        $item->save(); 
        $notification = array(
            'message' => 'Status Change!', 
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }



    public function homePage()
    {
        $product_types = ProductType::where('status',true)->get();
        $categories = ProductCategory::with('children')->whereNull('parent_id')->orderBy('id','DESC')->get();
        $selectedCategories = SelectedCategory::with('category')->get();

        $single_column = IndexDynamicData::where('mapping','single_column')->first();
        $double_column = IndexDynamicData::where('mapping','double_column')->get();
        $slider_products = IndexDynamicData::where('mapping','slider_products')->first();

        $indexDatas = IndexDynamicData::where('status', true)->get();
        return view('admin.general.homePage',compact('product_types','categories', 'selectedCategories', 'indexDatas','single_column','double_column','slider_products'));
    }

    public function single_carousal(Request $request)
    {
        $request->validate([
            'section_title' => 'required',
            'type_id' => 'required',
            // Add validation rules for other categories if needed
        ]);

        $data = IndexDynamicData::where('mapping', 'single_type')->first();
        if(!isset($data)){
            $data = new IndexDynamicData();
        }
        $data->mapping = 'single_type';
        $data->title = $request->section_title;
        $data->save(); 

        $productTypes = ProductType::all();

        // Update each record individually
        foreach ($productTypes as $productType) {
            $productType->update(['single_type' => false]);
        }


        $item = ProductType::find($request->type_id);
        $item->single_type = true;
        $item->save(); 
        $notification = array(
            'message' => 'Type are selected Change!', 
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    public function single_column(Request $request)
    {
        $request->validate([
            'bg_image.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'heading' => 'required',
            'sub_heading' => 'required',
            'button_name' => 'required',
            'button_url' => 'required',
            // Add validation rules for other categories if needed
        ]);

        

        if($request->id){

            $data = IndexDynamicData::find($request->id);
            if($request->hasFile('bg_image'))
            {
                $imageName = $request->bg_image->getClientOriginalName();
                $imageName = $request->bg_image->store('public');
            }else{

                $imageName = $data->bg_image;
            }
        }else{

            if($request->hasFile('bg_image'))
            {
                $imageName = $request->bg_image->getClientOriginalName();
                $imageName = $request->bg_image->store('public');
            }
            $data = new IndexDynamicData();
        }
        $data->mapping = 'single_column';
        $data->bg_image = $imageName;
        $data->heading = $request->heading;
        $data->sub_heading = $request->sub_heading;
        $data->button_name = $request->button_name;
        $data->button_url = $request->button_url;
        $data->save();

        $notification = array(
            'message' => 'Successfully Updated', 
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }


    public function double_column(Request $request)
    {
        $request->validate([
            'section_title' => 'required',
            'bg_image.*' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'heading' => 'required',
            'sub_heading' => 'required',
            'button_name' => 'required',
            'button_url' => 'required',

            'bg_image1.*' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'heading1' => 'required',
            'sub_heading1' => 'required',
            'button_name1' => 'required',
            'button_url1' => 'required',
            // Add validation rules for other categories if needed
        ]);
        $title_editer = IndexDynamicData::where('mapping', 'double_column_title')->first();
        if(!isset($title_editer)){
            $title_editer = new IndexDynamicData();
        }
        $title_editer->mapping = 'double_column_title';
        $title_editer->title = $request->section_title;
        $title_editer->save(); 


        

        if($request->id_1){
            $data = IndexDynamicData::find($request->id_1);

            if($request->hasFile('bg_image'))
            {
                $imageName = $request->bg_image->getClientOriginalName();
                $imageName = $request->bg_image->store('public');
            }else{

                $imageName = $data->bg_image;
            }

        }else{
            
            if($request->hasFile('bg_image'))
            {
                $imageName = $request->bg_image->getClientOriginalName();
                $imageName = $request->bg_image->store('public');
            }
            $data = new IndexDynamicData();
        }
        $data->mapping = 'double_column';
        $data->bg_image = $imageName;
        $data->heading = $request->heading;
        $data->sub_heading = $request->sub_heading;
        $data->button_name = $request->button_name;
        $data->button_url = $request->button_url;
        $data->save();

        if($request->id_2){
            $data1 = IndexDynamicData::find($request->id_2);

            if($request->hasFile('bg_image1'))
            {
                $imageName1 = $request->bg_image1->getClientOriginalName();
                $imageName1 = $request->bg_image1->store('public');
            }else{

                $imageName1 = $data1->bg_image;
            }

        }else{
            if($request->hasFile('bg_image1'))
            {
                $imageName1 = $request->bg_image1->getClientOriginalName();
                $imageName1 = $request->bg_image1->store('public');
            }
            $data1 = new IndexDynamicData();
        }
        $data1->mapping = 'double_column';
        $data1->bg_image = $imageName1;
        $data1->heading = $request->heading1;
        $data1->sub_heading = $request->sub_heading1;
        $data1->button_name = $request->button_name1;
        $data1->button_url = $request->button_url1;
        $data1->save();



        $notification = array(
            'message' => 'Successfully Updated', 
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    public function slider_products(Request $request)
    {
        $request->validate([
            'heading' => 'required',
            'sub_heading' => 'required',
            'bg_image.*' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'button_url' => 'required'
            // Add validation rules for other categories if needed
        ]);
        if(isset($request->id)){

            $data = IndexDynamicData::find($request->id);

            if($request->hasFile('bg_image'))
            {
                $imageName = $request->bg_image->getClientOriginalName();
                $imageName = $request->bg_image->store('public');
            }else{

                $imageName = $data->bg_image;
            }
        }
        else{
            if($request->hasFile('bg_image'))
            {
                $imageName = $request->bg_image->getClientOriginalName();
                $imageName = $request->bg_image->store('public');
            }

            $data = new IndexDynamicData();
        }
        $data->mapping = 'slider_products';
        $data->heading = $request->heading;
        $data->sub_heading = $request->sub_heading;
        $data->bg_image = $imageName;
        $data->button_url = $request->button_url;
        $data->save(); 

    
        $notification = array(
            'message' => 'Successfully Updated', 
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function cookie_show()
    {
        $cookie = Cookie::first();
        return view('admin.general.cookie',compact('cookie'));
    }

    public function cookie_update(Request $request)
    {
        $request->validate([
            'text' => 'required',
        ]);

        $data = Cookie::find($request->id);

        $data->text = $request->text;
        $data->status = $request->status;

        $data->save();

        $notification = array(
        'message' => 'Cookie Successfully Updated', 
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function selected_categoris_store(Request $request)
    {
        $request->validate([
            'section_title' => 'required',
            'category_id' => 'required|exists:product_categories,id',
            'category_id2' => 'required|exists:product_categories,id',
            'category_id3' => 'required|exists:product_categories,id',
            'category_id4' => 'required|exists:product_categories,id',
            // Add validation rules for other categories if needed
        ]);

        $data = IndexDynamicData::where('mapping', 'category_selected')->first();
        if(!isset($data)){
            $data = new IndexDynamicData();
        }
        $data->mapping = 'category_selected';
        $data->title = $request->section_title;
        $data->save(); 
        // Assuming $request contains the data from your form submission

        // Define arrays to hold category and subcategory IDs
        $selectedCategories = [];
        $selectedSubCategories = [];


        // Check if subcategory is selected, if not, use category ID
        $category_id = $request->category_id;
        $category_id2 = $request->category_id2;
        $category_id3 = $request->category_id3;
        $category_id4 = $request->category_id4;


        $subcategory_id = isset($request->subcategory_id) ? $request->subcategory_id : null;
        $subcategory_id2 = isset($request->subcategory_id2) ? $request->subcategory_id2 : null;
        $subcategory_id3 = isset($request->subcategory_id3) ? $request->subcategory_id3 : null;
        $subcategory_id4 = isset($request->subcategory_id4) ? $request->subcategory_id4 : null;

        // Push the category IDs into the selectedCategories array
        array_push($selectedCategories, $category_id, $category_id2, $category_id3, $category_id4);


        array_push($selectedSubCategories, $subcategory_id, $subcategory_id2, $subcategory_id3, $subcategory_id4);


        // Filter out any empty values
        $selectedCategories = array_filter($selectedCategories);

        $loop = 0;
        // Save selected categories to the database
        foreach ($selectedCategories as $categoryId) {
            SelectedCategory::create([
                'category_id' => $categoryId,
                'subcategory_id' => $selectedSubCategories[$loop]
            ]);

            $loop++;
        }

        $notification = array(
            'message' => 'Selected categories saved successfully.', 
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
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
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
