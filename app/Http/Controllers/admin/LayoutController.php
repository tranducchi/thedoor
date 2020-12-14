<?php

namespace App\Http\Controllers\admin;
use App\Models\Layout;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class LayoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $layouts = Layout::select('id', 'offset', 'link')->where('delete_status',1)->orderBy('created_at', 'desc')->get();

      return view('admin.layout.list', compact('layouts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.layout.add');
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
            'img' => 'required',
        ],[
            'img.required'=>'Trường ảnh không được để trống',
        ]);
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
        $layout = new Layout;
        $layout->offset = $request->offset;
        $layout->link = $fileNameToStore;
        $layout->save();
        return redirect('/admin/layout')->with('success', 'Thêm thành công !');
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
        $layout = Layout::find($id);
        return view('admin.layout.edit', compact('layout'));
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
        $layout = Layout::find($id);
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
            $layout->link = $fileNameToStore;
        }
        $layout->offset = $request->offset;
        $layout->save();
        return redirect('/admin/layout')->with('success', 'Cập nhật thành công !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dept = Layout::find($id);
        $dept->delete_status =0;
        $dept->save();
        Storage::disk('public')->delete("img/" . $dept->link);
        return redirect('admin/layout')->with('success', 'Xóa thành công !');
    }
    public function delete(Request $request){
        if($request->id ==null){
            return redirect('/admin/layout');
        }
        $id = $request->id;
        
        Layout::whereIn('id', $id)->update([
            'delete_status'=>'0'
        ]);
        return redirect('/admin/layout')->with('success', 'Xóa thành công !');
    }
}
