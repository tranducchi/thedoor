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
use App\Models\Customer;
use App\Models\Blog;
use App\Models\Layout;
class FontendController extends Controller
{

    public function index()
    {
       $slide = Slide::select('image','title','describe','link')->where('active_status',1)->where('delete_status',1)->get();
       $count = Slide::select('*')->where('active_status',1)->where('delete_status',1)->count();
       $serv = Service::select('service_name','id')->where('delete_status',1)->get();
       $sldept = Dept::select('dept_name','id')->where('delete_status',1)->get();
       $staffs = Staff::select('slug', 'photo')->where('delete_status',1)->orderBy('created_at', 'desc')->get();
       $customers = Customer::select('id', 'customer_name', 'image')->where('delete_status', 1)->get();
       $blogs = Blog::select('id', 'author_id', 'title', 'thumbnail', 'slug', 'created_at')->where('delete_status', 1)->orderBy('updated_at', 'desc')->take(10)->get();
       $layouts = Layout::select('link', 'offset')->where('delete_status',1)->get();
       return view('home',compact('slide','count','serv','sldept', 'customers', 'staffs', 'blogs', 'layouts'));
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
        return response()->json([
            'success' => 'Phản hồi thành công !',
        ],
        200);
    }
    public function add_hire(Request $request){
        $validatedData = $request->validate([
            'partner_name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'service_id'=>'required',
            'budget'=>'required',
        ],[
            'partner_name.required' => 'Trường tên không được để trống',
            'email.required' => 'Trường email không được để trống',
            'phone.required' => 'Trường điện thoại không được để trống',
            'service_id.required'=>'Trường dịch vụ không được để trống',
            'budget.required'=>'Trường giá tiền không được để trống',
        ]);
        $hire = new HirePage; 
        $hire->partner_name	=$request->partner_name;
        $hire->email=$request->email;
        $hire->phone=$request->phone;
        $hire->service_id=$request->service_id;
        $hire->budget=$request->budget."000000";
        $hire->save();
        return response()->json([
            'success' => 'Gửi đơn thành công !',
        ],
        200);
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
            return "yes";
            // // Get filename with the extension
            // $filenameWithExt = $request->file('profile')->getClientOriginalName();
            // //Get just filename
            // $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // // Get just ext
            // $extension = $request->file('profile')->getClientOriginalExtension();
            // // Filename to store
            // $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // // Upload Image
            // $path = $request->file('profile')->storeAs('/public/img', $fileNameToStore);
        }else {
            // $fileNameToStore = 'no-profile.png';
            return "no";
        }
   
        // $candidate = new Candidate;
        // $candidate->profile=$fileNameToStore;
       
        // $candidate->name=$request->name;
        // $candidate->email=$request->email;
        // $candidate->project_name=$request->project_name;
        // $candidate->introduce=$request->introduce;
        // $candidate->dept_id=$request->dept_id;
    
        // $candidate->save();
      
        // return redirect('/')->with('success', 'Thêm thành công !');
    }
    //show list 
    public function listPost(){
       
    }
    //all post 
    public function getPost(){
        $posts = Blog::select('title', 'describe', 'slug', 'thumbnail')->where('delete_status',1)->where('status',1)->orderBy('updated_at', 'desc')->paginate(5);
        $layouts = Layout::select('link', 'offset')->where('delete_status',1)->get();
        return view('list-post', compact('layouts', 'posts'));
    }
    public function search(Request $request){
        $layouts = Layout::select('link', 'offset')->where('delete_status',1)->get();
        $k = $request->input('key');
        $posts = Blog::where('delete_status', '1')->where('status', 1)->where('title','LIKE','%'.$k.'%')->paginate(5);
        return view('search-blog', compact('posts', 'k', 'layouts'));
    }
    public function viewPost(Request $request, $slug){
        $post = Blog::where('slug', $slug)->get();
        $layouts = Layout::select('link', 'offset')->where('delete_status',1)->get();
        return view('detail-post', compact('layouts', 'post'));
    }
}
