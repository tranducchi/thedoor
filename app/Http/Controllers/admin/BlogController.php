<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Support\Str;
class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blog::select('id', 'title', 'thumbnail', 'describe', 'delete_status', 'content', 'author_id', 'created_at')->where('delete_status',1)->orderBy('created_at', 'desc')->paginate(15);
        return view('admin.blog.list', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.blog.add');
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
            'title' => 'required',
            'describe' => 'required',
            'content' => 'required',
        ],[
            'title.required'=>'Trường tiêu đề không được để trống',
            'describe.required'=>'Trường mô tả không được để trống',
            'content.required'=>'Trường nội dung không được để trống',
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
        $blog = new Blog;
        $blog->title = $request->title;
        $blog->slug =Str::slug($request->title);
        $blog->describe = $request->describe;
        $blog->thumbnail = $fileNameToStore;
        $blog->content = $request->content;
        $blog->author_id = $request->author;
        $blog->save();
        return redirect('/admin/blog')->with('success', 'Thêm thành công !');
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
        $blog = Blog::find($id);
        return view('admin.blog.edit', compact('blog'));
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
            'title' => 'required',
            'describe' => 'required',
            'content' => 'required',
        ],[
            'title.required'=>'Trường tiêu đề không được để trống',
            'describe.required'=>'Trường mô tả không được để trống',
            'content.required'=>'Trường nội dung không được để trống',
        ]);
        $blog = Blog::find($id);
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
            $blog->thumbnail = $fileNameToStore;
        }
        
        $blog->title = $request->title;
        $blog->slug =Str::slug($request->title);
        $blog->describe = $request->describe;
        $blog->content = $request->content;
        $blog->author_id = $request->author;
        $blog->save();
        return redirect('/admin/blog')->with('success', 'Cập nhật thành công !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dept = Blog::find($id);
        $dept->delete_status =0;
        $dept->save();
        return redirect('admin/blog')->with('success', 'Xóa thành công !');
    }
    public function search(Request $request){
        $k = $request->input('key');
        $blogs = Blog::where('title','LIKE','%'.$k.'%')->where('delete_status',1)->paginate(15);
        return view('admin.blog.search', compact('blogs', 'k'));
    }
    public function delete(Request $request){
        if($request->id ==null){
            return redirect('/admin/blog');
        }
        $id = $request->id;
        Blog::whereIn('id', $id)->update([
            'delete_status'=>'0'
        ]);
        return redirect('/admin/blog')->with('success', 'Xóa thành công !');
    }
}
