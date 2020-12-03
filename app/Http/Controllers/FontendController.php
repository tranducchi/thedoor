<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slide;
use App\Models\FeedBack;
use App\Models\HirePage;
use App\Models\Service;
use App\Models\Dept;
use App\Models\Staff;
use App\Models\Candidate;
class FontendController extends Controller
{
    public function index()
    {
       $slide = Slide::select('image','title','describe','link')->where('active_status',1)->where('delete_status',1)->get();
       $count = Slide::select('*')->where('active_status',1)->where('delete_status',1)->count();
       $serv = Service::select('service_name','id')->where('delete_status',1)->get();
       $sldept = Dept::select('dept_name','id')->where('delete_status',1)->get();
       return view('home',compact('slide','count','serv','sldept'));
    }
    public function add_ste(Request $request){
        // $validatedData = $request->validate([   
        //     'name' => 'required',
        //     'email' => 'required',
        //     'describe' => 'required',
        // ],[
        //     'name.required'=>'Trường tên không được để trống',
        //     'email.required'=>'Trường email không được để trống',
        //     'describe.required'=>'Trường mô tả không được để trống'
        // ]);
        $feedback = new FeedBack; 
        $feedback->sender_name	=$request->name;
        $feedback->email=$request->email;
        $feedback->content_fb=$request->describe;
        $feedback->save();
        return redirect('/')->with('success', 'Thêm thành công !');
    }
    public function add_hire(Request $request){
        // $validatedData = $request->validate([
        //     'partner_name' => 'required',
        //     'email' => 'required',
        //     'project_name' => 'required',
        //     'describe_project' => 'required',
        //     'service_id'=>'required',
        //     'budget'=>'required',
        // ],[
        //     'partner_name.required' => 'Trường tên không được để trống',
        //     'email.required' => 'Trường email không được để trống',
        //     'project_name.required' => 'Trường tên dự án không được để trống',
        //     'describe_project.required' =>'Trường mô tả không được để trống',
        //     'service_id.required'=>'Trường dịch vụ không được để trống',
        //     'budget.required'=>'Trường giá tiền không được để trống',
        // ]);
        $hire = new HirePage; 
        $hire->partner_name	=$request->partner_name;
        $hire->email=$request->email;
        $hire->project_name=$request->project_name;
        $hire->describe_project=$request->describe_project;
        $hire->service_id=$request->service_id;
        $hire->budget=$request->budget;
        $hire->save();
        return redirect('/')->with('success', 'Thêm thành công !');
    }
    public function add_candidate(Request $request){
      
        // $validatedData = $request->validate([
        //     'name' => 'required',
        //     'email' => 'required',
        //     'project_name' => 'required',
        //     'introduce' => 'required',
        //     'dept_id'=>'required',
        //     // 'profile'=>'required',
        // ],[
        //     'name.required' => 'Trường tên không được để trống',
        //     'email.required' => 'Trường email không được để trống',
        //     'project_name.required' => 'Trường tên dự án không được để trống',
        //     'introduce.required' =>'Trường mô tả không được để trống',
        //     'dept_id.required'=>'Trường bộ phận không được để trống',
        //     // 'profile.required'=>'Trường profile không được để trống',
        // ]);
        //upload

        if($request->hasFile('profile')){
            // Get filename with the extension
            $filenameWithExt = $request->file('profile')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('profile')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('profile')->storeAs('/public/img', $fileNameToStore);
        }else {
            $fileNameToStore = 'no-profile.pdf';
        }
   
        $candidate = new Candidate;
        $candidate->profile=$fileNameToStore;
       
        $candidate->name=$request->name;
        $candidate->email=$request->email;
        $candidate->project_name=$request->project_name;
        $candidate->introduce=$request->introduce;
        $candidate->dept_id=$request->dept_id;
    
        $candidate->save();
      
        return redirect('/')->with('success', 'Thêm thành công !');
    }
}
