<?php

namespace App\Http\Controllers;

use App\Mail\ContactSubmit;
use App\Models\User;
use App\Models\Course;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PagesController extends Controller
{
    public function index(){
        $products = Product::latest('id')->paginate(5);
        return view('Front.index',compact('products'));
    }

    //Search
    public function search(Request $request){
        $products = Product::where('name','like','%'.$request->search . '%')
        ->orWhere('content','like','%' .$request->search . '%')->get();
        return view('Front.index',compact('products'));
    }

    public function product($slug){
        $product = Product::where('slug',$slug)->first();
        return view('Front.product',compact('product'));
    }

    public function purchase($slug){
        $product = Product::where('slug',$slug)->first();
        return view('Front.purchase',compact('product'));
    }
    public function contact(){
        return view('Front.contact');
    }
    public function contactSubmit(Request $request){
        $request->validate([
            'name' => 'required',
            'message'=> 'required',
            'mobile'=> 'required',
            'email' => 'required',
            'subject'=>'required'
        ]);
        Mail::to('admin@gmail.com')->send(new ContactSubmit($request->except('_token')));
        return redirect()->route('homePage');
    }

    public function purcharsSubmit(Request $request, $slug)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'mobile' => 'required'
        ]);

        // dd($request->all());

        $product = Product::where('slug', $slug)->select('id')->first();
        $user = User::where('email', $request->email)->first();
        if(is_null($user)) {
            // create new user
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'gender' => $request->gender
            ]);
        }
        $purchase = Purchase::create([
            'user_id' => $user->id,
            'product_id' => $product->id
        ]);
        return redirect()->route('pay', $purchase->id);
    }
    public function pay($id){
        $purchase = Purchase::find($id);
        return view('Front.pay',compact('purchase'));
    }
    public function thanks($id){
        Purchase::findOrFail($id)->update([
            'status'=>1
        ]);
        return redirect()->route('homePage');
    }

}
