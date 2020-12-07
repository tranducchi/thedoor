<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Dept;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class DeptController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dept = Dept::select('id', 'dept_name', 'phone', 'leader_id', 'delete_status')->where('delete_status',1)->orderBy('created_at','desc')->paginate(15);
        return view('admin.dept.list', compact('dept'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $staff = Staff::select('id', 'staff_name')->where('delete_status',1)->get();
        return  view('admin.dept.add', compact('staff'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'phone' => 'required'
        ],[
            'name.required'=>'Trường tên không được để trống',
           
            'phone.required'=>'Trường điện thoại không được để trống'
        ]);
        $dept = new Dept;
        $dept->dept_name = $request->name;
        $dept->slug =Str::slug($request->name);
        $dept->phone = $request->phone;
        $dept->leader_id = $request->leader;
        $dept->save();
        return redirect('/admin/dept')->with('success','Thêm thành công !');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $staff = Staff::select('id', 'staff_name', 'delete_status')->where('delete_status',1)->get();
        $dept = Dept::find($id);
        return view('admin.dept.edit', compact('dept','staff'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'phone' => 'required'
        ],[
            'name.required'=>'Trường tên không được để trống',
    
            'phone.required'=>'Trường điện thoại không được để trống'
        ]);
        $dept = Dept::find($id);
        $dept->dept_name = $request->name;
        $dept->phone = $request->phone;
        $dept->leader_id = $request->leader;
        $dept->save();
        return redirect('/admin/dept')->with('success','Cập nhập thành công !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dept = Dept::find($id);
        $dept->delete_status =0;
        $dept->save();
        return redirect('admin/dept')->with('success', 'Xóa thành công !');
    }
    public function search(Request $request){
        $k = $request->input('key');
        $dept = Dept::where('dept_name','LIKE','%'.$k.'%')->where('delete_status',1)->paginate(15);
        return view('admin.dept.search', compact('dept', 'k'));
    }
    public function delete(Request $request){
        if($request->id ==null){
            return redirect('/admin/dept');
        }
        $id = $request->id;
        Dept::whereIn('id', $id)->update([
            'delete_status'=>'0'
        ]);
        return redirect('/admin/dept')->with('success', 'Xóa thành công !');
    }
}
