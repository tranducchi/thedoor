<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Staff;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $service = Service::select('id', 'service_name', 'delete_status', 'logo', 'describe')->where('delete_status',1)->orderBy('created_at','desc')->paginate(15);
        return view('admin.service.list', compact('service'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.service.add');
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
            'describe' => 'required'
        ],[
            'name.required'=>'Trường tên không được để trống',
            'describe.required'=>'Trường mô tả không được để trống'
        ]);
        //upload file
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
        $service = new Service;
        $service->service_name = $request->name;
        $service->describe = $request->describe;
        $service->logo = $fileNameToStore;
        $service->save();
        return redirect('/admin/service')->with('success', 'Thêm thành công !');

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
        $service = Service::find($id);
        return view('admin.service.edit', compact('service'));
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
            'describe' => 'required'
        ],[
            'name.required'=>'Trường tên không được để trống',
            'describe.required'=>'Trường mô tả không được để trống'
        ]);
        //upload file
        $service = Service::find($id);
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
            $service->logo = $fileNameToStore;
        }
        $service->service_name = $request->name;
        $service->describe = $request->describe;
        $service->save();
        return redirect('/admin/service')->with('success', 'Cập nhật thành công !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $service = Service::find($id);
        $service->delete_status =0;
        $service->save();
        return redirect('/admin/service')->with('success', 'Xóa thành công ! ');
    }
    public function delete(Request $request){
        $id = $request->id;
        Service::whereIn('id', $id)->update([
            'delete_status'=>'0'
        ]);
        return redirect('/admin/service')->with('success', 'Xóa thành công !');
    }
}
