<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $users = User::select('id', 'name', 'email', 'type', 'created_at')->orderBy('created_at', 'desc')->paginate(15);
       return view('admin.user.list', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.add');
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
            'email' => 'required',
            'password' => 'required|confirmed|min:6',
         
        ],[
            'name.required'=>'Trường tên không được để trống',
            'email.required'=>'Trường điện thoại không được để trống',
            'password.required'=>'Mật khẩu không được để trống',
            'password.confirmed'=>'Mật khẩu không trùng khớp',
            'password.min'=>'Mật khẩu phải lớn hơn 6 kí tự',
        ]);
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password =Hash::make($request->password);
        $user->save();
        return redirect('/admin/user')->with('success', 'Thêm thành công !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admin.user.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.user.edit', compact('user'));
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
            'email' => 'required',
         
        ],[
            'name.required'=>'Trường tên không được để trống',
            'email.required'=>'Trường điện thoại không được để trống',
        ]);
        if($request->password){
            $validatedData = $request->validate([
                'password' => 'confirmed|min:6',
             
            ],[
                'password.confirmed'=>'Mật khẩu không trùng khớp',
                'password.min'=>'Mật khẩu phải lớn hơn 6 kí tự',
            ]);
        }
        
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if($user->r_password){
            $user->password =Hash::make($request->password);
        }
        $user->save();
        return redirect('/admin/user')->with('success', 'Cập nhật thành công !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect('/admin/user')->with('success', 'Xoá thành công !');
    }
    public function destroys(Request $request){
        if($request->id ==null){
            return redirect('/admin/user');
        }
        $id = $request->id;
        $user = User::where('id', $id);
        $user->delete();
        return redirect('/admin/user')->with('success', 'Xoá thành công !');
    }
    public function search(Request $request){
        $k = $request->input('key');
        $users = User::where('name','LIKE','%'.$k.'%')->paginate(15);
        return view('admin.user.search', compact('users', 'k'));
    }
}
