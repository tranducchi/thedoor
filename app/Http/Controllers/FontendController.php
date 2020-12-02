<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slide;
use App\Models\FeedBack;

class FontendController extends Controller
{
    public function index()
    {
       $slide = Slide::select('image','title','describe','link')->where('active_status',1)->where('delete_status',1)->get();
       $count = Slide::select('*')->where('active_status',1)->where('delete_status',1)->count();
       return view('home',compact('slide','count'));
    }
    public function add_ste(Request $request){
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'describe' => 'required',
        ],[
            'name.required'=>'Trường tên không được để trống',
            'email.required'=>'Trường email không được để trống',
            'describe.required'=>'Trường mô tả không được để trống'
        ]);
        $feedback = new FeedBack; 
        $feedback->sender_name	=$request->name;
        $feedback->email=$request->email;
        $feedback->content_fb=$request->describe;
        $feedback->save();
        return redirect('/')->with('success', 'Thêm thành công !');
    }
    public function add_hire(Request $request){
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'describe' => 'required',
        ],[
            'name.required'=>'Trường tên không được để trống',
            'email.required'=>'Trường email không được để trống',
            'describe.required'=>'Trường mô tả không được để trống'
        ]);
        $hire = new Hire; 
        $hire->partner_name	=$request->name;
        $hire->email=$request->email;
        $hire->project_name=$request->project;
        $hire->
        $hire->save();
        return redirect('/')->with('success', 'Thêm thành công !');
    }
}
