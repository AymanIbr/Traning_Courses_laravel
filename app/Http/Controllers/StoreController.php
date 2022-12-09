<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stores = Store::latest('id')->paginate(5);
        return view('admin.stores.index',compact('stores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.stores.create');
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
            'name'=> 'required'
        ]);
        Store::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ]);
        return redirect()->route('stores.index')->with('success','Store Added Successfuly')
        ->with('type', 'success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Store $store)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $store = Store::findOrFail($id);
        return view('admin.stores.edit',compact('store'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'=> 'required|unique:stores,name'
        ]);
        Store::findOrFail($id)->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ]);
        return redirect()->route('stores.index')->with('success','Store Updated Successfuly')
        ->with('type', 'success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Store::findOrFail($id)->delete();
        return redirect()->route('stores.index')->with('success','Store Deleted Successfuly')
        ->with('type', 'danger');
    }
}
