<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\DigitalProduct;
use App\Models\Admin\Mlmuser;
use App\Models\Admin\Offer;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:view digital product|create digital product|update digital product|delete digital product', ['only' => ['index']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Offer::where('offer_for','digitalproduct')->get();
        return view('admin.digitalProduct.offer',compact('data'));
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
            'name' => 'required|min:3|unique:offers',
            'offer_for' => 'required',
            'offer_type' => 'nullable',
            'description' => 'nullable',
            'offer_percentage'=>'nullable',
            'user_percentage' => 'nullable',
            'last_date' => 'nullable',
            'status' => 'required',
        ]);

        $item = new Offer();
        $item->name = $request->name;
        $item->description = $request->description;
        $item->offer_for = $request->offer_for;
        $item->offer_type = $request->offer_type;
        $item->offer_percentage = $request->offer_percentage;
        $item->user_percentage = $request->user_percentage;
        $item->status = $request->status;
        $item->last_date = Carbon::parse($request->last_date)->format("d-m-Y");
        
        $item->save();

        $notification = array(
            'message' => 'Offer Add Successfully!', 
            'alert-type' => 'success',
        );
        $redirect = empty($request->offer_percentage) ? route('product.campaign.offer') : route('productoffer.index');

        return redirect($redirect)->with($notification);
    }
    public function status(Request $request, string $id){
        $this->validate($request,[
            'status' => 'required',
        ]);
        $item = Offer::find($request->id);

        $item->status = $request->status;
        $item->save(); 
        $notification = array(
            'message' => 'Status Change!', 
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    public function description(Request $request, string $id){
        $this->validate($request,[
            'description' => 'required',
        ]);
        $item = Offer::find($request->id);

        $item->description = $request->description;
        $item->save(); 
        $notification = array(
            'message' => 'Description Change!', 
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    public function digitalProduct(string $id)
    {
        $data = Offer::find($id);
        $products = DigitalProduct::where('status',1)->get();
        return view('admin.digitalProduct.addProductToOffer',compact('data','products'));
    }
    public function adddigitalProduct(Request $request, string $id){
        $this->validate($request,[
            'digital_product_id' => 'required',
        ]);
        $offer = Offer::find($id);
        if($offer->status == 1){
            $product = DigitalProduct::find($request->digital_product_id);
            if(!isset($product->offer)){
                $offer->digitalProduct()->associate($request->digital_product_id);
                $offer->save(); 
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
        }else{

            $notification = array(
                'message' => 'This Offer Not active!', 
                'alert-type' => 'error',
            );
        }
        return redirect(route('productoffer.index'))->with($notification);
    }

    public function user(string $id)
    {
        $data = Offer::find($id);
        
        $users = Mlmuser::where('parent_activation',1)->where('admin_activation',1)->get();
        return view('admin.digitalProduct.addUserToOffer',compact('data','users'));
    }

    public function associateUsersWithOffer(Request $request, string $id){
        $this->validate($request,[
            'mlmUsers' => 'required',
        ]);
        $offer = Offer::find($id);
        if($offer->status == 1){
            $requestusers = $request->mlmUsers;
            $users = MlmUser::whereIn('id', $request->input('mlmUsers'))->get();
            // if($offer->offer_type == 'special'){
            //     foreach ($users as $key => $user) {
            //         foreach ($user->offers as $key => $useroffer) {
            //             if($useroffer->id != $offer->id){
            //                 $notification = array(
            //                     'message' => 'User '.$user->user->username.' already used for other special offer', 
            //                     'alert-type' => 'error',
            //                 );
            //                 return redirect(route('productoffer.index'))->with($notification);
            //             }
            //         }
            //     }
            // }
            $offer->mlmUsers()->sync($users);
            
            $notification = array(
                'message' => 'Users associated with offer successfully', 
                'alert-type' => 'success',
            );
        }else{
            $notification = array(
                'message' => 'This Offer Not active!', 
                'alert-type' => 'error',
            );
        }
        return redirect(route('productoffer.index'))->with($notification);
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Offer::find($id);
        return view('admin.digitalProduct.offerdescription',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Offer::find($id);
        return view('admin.digitalProduct.offeredit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request,[
            'name' => 'required|min:3',
            'offer_for' => 'required',
            'offer_type' => 'nullable',
            'description' => 'nullable',
            'offer_percentage'=>'nullable',
            'user_percentage' => 'nullable',
            'last_date' => 'nullable',
            'status' => 'required',
        ]);
        $item = Offer::find($id);
        $item->name = $request->name;
        $item->offer_for = $request->offer_for;
        $item->offer_type = $request->offer_type;
        $item->offer_percentage = $request->offer_percentage;
        $item->user_percentage = $request->user_percentage;
        $item->status = $request->status;
        $item->last_date = Carbon::parse($request->last_date)->format("d-m-Y");
        
        $item->save();

        $notification = array(
            'message' => 'Offer Update Successfully!', 
            'alert-type' => 'success',
        );

        $redirect = empty($request->offer_percentage) ? route('product.campaign.offer') : route('productoffer.index');
        
        return redirect($redirect)->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Offer::where('id',$id)->delete();
        $notification = array(
            'message' => 'Offer Destroy.', 
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }
}
