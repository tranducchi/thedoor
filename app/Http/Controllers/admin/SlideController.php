<?php

namespace App\Http\Controllers\admin;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slide;

class SlideController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slide = Slide::select('*')->paginate(15);
        return view('admin.slide.list',compact('slide'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.slide.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
     

       
        $request->validate(
            [
                'title' => 'required',
                'link' => 'required',
                'image' => 'required',
                'description' => 'required',
            ],
            [
                'title.required' => 'Vui lòng nhập tiêu đề cho slide',
                'link.required' => 'Vui lòng nhập liên kết cho slide',
                'image.required' => 'Vui lòng chọn ảnh cho slide',
                'description.required' => 'Vui lòng nhập mô tả cho slide'
            ]
        );
        $add = new Slide;
        $add->title = $request->title;
        $add->link = $request->link;
        $add->describe = $request->description;
        if($request->hasFile('image')){
            // Get filename with the extension
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('image')->storeAs('/public/img', $fileNameToStore);
        }else {
            $fileNameToStore = 'no-image.png';
        }
        $add->image = $fileNameToStore;
        $add->save();
        return redirect('/admin/slide');
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
        $slide = Slide::find($id);
        return view('admin.slide.edit', compact('slide'));
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
        $request->validate(
            [
                'title' => 'required',
                'link' => 'required',
                'description' => 'required',
            ],
            [
                'title.required' => 'Vui lòng nhập tiêu đề cho slide',
                'link.required' => 'Vui lòng nhập liên kết cho slide',
                'description.required' => 'Vui lòng nhập mô tả cho slide',
            ]
            );
            $update = Slide::find($id);
            $update->title = $request->title;
            $update->link = $request->link;
            $update->describe = $request->description;
            if($request->hasFile('image')){
                // Get filename with the extension
                $filenameWithExt = $request->file('image')->getClientOriginalName();
                //Get just filename
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                // Get just ext
                $extension = $request->file('image')->getClientOriginalExtension();
                // Filename to store
                $fileNameToStore= $filename.'_'.time().'.'.$extension;
                // Upload Image
                $path = $request->file('image')->storeAs('/public/img', $fileNameToStore);
                $update->image = $fileNameToStore;
            }
            $update->active_status = $request->status;
            $update->save();
            return redirect('/admin/slide')->with('success', 'Cập nhật thành công !');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $slide = Slide::find($id);
        $slide->delete_status =0;
        
        Storage::disk('public')->delete("img/" . $slide->image);
        $slide->save();
        return redirect('/admin/slide')->with('success', 'Xóa thành công !');
    }
    public function search(Request $request){    
        $k = $request->input('key');
        $slide = Slide::where('delete_status', '1')->where('title','LIKE','%'.$k.'%')->paginate(15);
        return view('admin.slide.search', compact('slide', 'k'));
    }
}
