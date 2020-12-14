<?php

namespace App\Http\Controllers\admin;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Models\Dept;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $staff = Staff::select('id', 'id_dept', 'staff_name', 'phone', 'address','email', 'photo', 'story', 'delete_status')->where('delete_status', 1)->orderBy('created_at', 'desc')->paginate(15);
        return view('admin.staff.list', compact('staff'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dept = Dept::select('id', 'dept_name', 'delete_status')->get();
        return view('admin.staff.add', compact('dept'));
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
            'phone' => 'required|unique:staff',
            'email' => 'required|unique:staff',
            'story' => 'required'
        ],[
            'name.required'=>'Trường tên không được để trống',
            'phone.unique'=>'Số điện thoại đã tồn tại',
            'email.unique'=>'Email đã tồn tại',
            'phone.required'=>'Trường điện thoại không được để trống',
            'email.required'=>'Trường email không được để trống',
            'story.required'=>'Trường câu chuyện thoại không được để trống'
        ]);
        //upload
        if($request->hasFile('img')){
            // Get filename with the extension
            $filenameWithExt = $request->file('img')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('img')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('img')->storeAs('/public/img', $fileNameToStore);
        }else {
            $fileNameToStore = 'no-image.png';
        }
        $staff = new Staff;
        $staff->photo = $fileNameToStore;
        $staff->staff_name = $request->name;
        $staff->slug =Str::slug($request->name);
        $staff->phone = $request->phone;
        $staff->address = $request->address;
        $staff->email = $request->email;
        $staff->story = $request->story;
        $staff->id_dept = $request->id_dept;
        $staff->save();
        return redirect('/admin/staff')->with('success', 'Thêm thành công !');
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
        $dept = Dept::select('id', 'dept_name', 'delete_status')->where('delete_status', 1)->get();
        $staff = Staff::find($id);
        return view('admin.staff.edit',compact('dept', 'staff'));
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
            'phone' => 'required',
            'email' => 'required',
            'story' => 'required'
        ],[
            'name.required'=>'Trường tên không được để trống',
            'phone.required'=>'Trường điện thoại không được để trống',
            'email.unique'=>'Email đã tồn tại',
            'phone.unique'=>'Số điện thoại đã tồn tại',
            'name.unique'=>'Số điện thoại đã tồn tại',
            'email.required'=>'Trường email không được để trống',
            'story.required'=>'Trường câu chuyện thoại không được để trống'
        ]);
        //upload
        $staff =Staff::find($id);
        if($request->hasFile('img')){
            // Get filename with the extension
            $filenameWithExt = $request->file('img')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('img')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('img')->storeAs('/public/img', $fileNameToStore);
            $staff->photo = $fileNameToStore;
        }
        $staff->staff_name = $request->name;
        $staff->slug =Str::slug($request->name);
        $staff->phone = $request->phone;
        $staff->address = $request->address;
        $staff->email = $request->email;
        $staff->story = $request->story;
        $staff->id_dept = $request->id_dept;
        $staff->story = $request->story;
        $staff->save();
        return redirect('/admin/staff')->with('success', 'Cập nhật thành công !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $staff = Staff::find($id);
        $staff->delete_status =0;
        Storage::disk('public')->delete("img/" . $staff->photo);
        $staff->save();
        return redirect('/admin/staff')->with('success', 'Xóa thành công !');
    }
    public function search(Request $request){
        $k = $request->input('key');
        $staff = Staff::where('delete_status', '1')->where('staff_name','LIKE','%'.$k.'%')->paginate(15);
        return view('admin.staff.search', compact('staff', 'k'));
    }
    public function delete(Request $request){
        if($request->id ==null){
            return redirect('/admin/staff');
        }
        $id = $request->id;
        Staff::whereIn('id', $id)->update([
            'delete_status'=>'0'
        ]);
        return redirect('/admin/staff')->with('success', 'Xóa thành công !');
    }
}
