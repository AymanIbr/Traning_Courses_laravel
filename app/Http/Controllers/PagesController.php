<?php

namespace App\Http\Controllers;

use App\Mail\ContactSubmit;
use App\Models\User;
use App\Models\Course;
use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PagesController extends Controller
{
    public function index(){
        $courses = Course::latest('id')->paginate(5);
        return view('Front.index',compact('courses'));
    }

    //Search
    public function search(Request $request){
        $courses = Course::where('name','like','%'.$request->search . '%')
        ->orWhere('content','like','%' .$request->search . '%')->get();
        return view('Front.index',compact('courses'));
    }

    public function course($slug){
        $course = Course::where('slug',$slug)->first();
        return view('Front.course',compact('course'));
    }

    public function register($slug){
        $course = Course::where('slug',$slug)->first();
        return view('Front.register',compact('course'));
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

    public function registerSubmit(Request $request, $slug)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'mobile' => 'required'
        ]);

        // dd($request->all());

        $course = Course::where('slug', $slug)->select('id')->first();
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
        $register = Registration::create([
            'user_id' => $user->id,
            'course_id' => $course->id
        ]);
        return redirect()->route('pay', $register->id);
    }
    public function pay($id){
        $register = Registration::find($id);
        return view('Front.pay',compact('register'));
    }
    public function thanks($id){
        Registration::findOrFail($id)->update([
            'status'=>1
        ]);
        return redirect()->route('homePage');
    }

}
