<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\Product;
use App\Models\Purchase;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index (){
        $Count_product = Product::count();
        $Count_Store = Store::count();
        $Count_Purchase = Purchase::count();
        return view('admin.index',compact('Count_product','Count_Store','Count_Purchase'));
    }
}
