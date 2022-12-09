<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Category;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Registration;
use App\Models\Store;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest('id')->paginate(5);
        return view('admin.products.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $stores = Store::select(['id','name'])->get();
        return view('admin.products.create',compact('stores'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=> 'required|unique:products,name',
            'price'=> 'required',
            'image'=> 'required|image',
            'store_id'=> 'required',
            'content'=> 'required'
        ]);

        $ex = $request->file('image')->getClientOriginalExtension();
        $new_image_name = 'pruchurs'.'.'.'Product'.rand().$ex;
        $request->file('image')->move(public_path('uplods'),$new_image_name );

        Product::create([
            'name' => $request->name ,
            'image' => $new_image_name ,
            'price' => $request->price,
            'content' => $request->content,
            'store_id'=>$request->store_id,
            'slug' => Str::slug($request->name)
        ]);
        return redirect()->route('products.index')->with('success', 'Product Add Successfuly')
        ->with('type', 'success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $stores = Store::select(['id','name'])->get();
        $product = Product::findOrFail($id);
        return view('admin.products.edit',compact('stores','product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'=> 'required|unique:products,name',
            'price'=> 'required',
            'image'=> 'nullabel|image',
            'store_id'=> 'required',
            'content'=> 'required'
        ]);
        $product = Product::findOrFail($id);
        $new_image_name = $product->image;
        if($request->has('image')){
            $ex = $request->file('image')->getClientOriginalExtension();
        $new_image_name = 'purchase'.'.'.'Product'.rand().$ex;
        $request->file('image')->move(public_path('uplods'),$new_image_name );
        }
        Product::findOrFail($id)->update([
            'name'=> $request->name,
            'price'=> $request->price,
            'image'=> $new_image_name,
            'store_id'=> $request->store_id,
            'content'=> $request->content
        ]);
        return redirect()->route('products.index')->with('success', 'Product Updated Successfuly')
        ->with('type', 'success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::findOrFail($id)->delete();
        return redirect()->route('products.index')->with('success', 'Product Deleted Successfuly')
        ->with('type', 'danger');;
    }
    public function registration(){
        $data = Purchase::latest('id')->paginate(5);
        return view('admin.products.purchase',compact('data'));
    }
    public function registrationDelete($id){
        Purchase::findOrFail($id)->delete();
        return redirect()->route('registration')->with('success', 'Purchase Deleted Successfuly')
        ->with('type', 'danger');;
    }
}
