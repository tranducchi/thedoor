<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\DetailProduct;
use App\Models\Product;
use Illuminate\Http\Request;

class DetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $details = DetailProduct::select('id', 'id_product', 'describe', 'created_at')->where('delete_status',1)->orderBy('created_at', 'desc')->paginate(15);
        return view('admin.detail_product.list', compact('details'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::select('id','name', 'delete_status')->where('delete_status',1)->get();
        return view('admin.detail_product.add', compact('products'));
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
            'describe' => 'required|unique:depts,dept_name',
            'text' => 'required'
        ],[
            'describe.required'=>'Trường mô tả',
            'text.required'=>'Trường nội dung không được để trống'
        ]);
        $detail = new DetailProduct();
        $detail->id_product = $request->id_product;
        $detail->media = $request->text;
        $detail->describe = $request->describe;
        $detail->save();
        return redirect('/admin/detail')->with('success','Thêm thành công !');
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
        $products = Product::select('id','name', 'delete_status')->where('delete_status',1)->get();
        $detail = DetailProduct::find($id);
        return view('admin.detail_product.edit', compact('products', 'detail'));
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
            'describe' => 'required|unique:depts,dept_name',
            'text' => 'required'
        ],[
            'describe.required'=>'Trường mô tả',
            'text.required'=>'Trường nội dung không được để trống'
        ]);
        $detail = DetailProduct::find($id);
        $detail->id_product = $request->id_product;
        $detail->media = $request->text;
        $detail->describe = $request->describe;
        $detail->save();
        return redirect('/admin/detail')->with('success','Thêm thành công !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dept = DetailProduct::find($id);
        $dept->delete_status =0;
        $dept->save();
        return redirect('admin/detail')->with('success', 'Xóa thành công !');
    }
    public function delete(Request $request){
        if($request->id ==null){
            return redirect('/admin/detail');
        }
        $id = $request->id;
        DetailProduct::whereIn('id', $id)->update([
            'delete_status'=>'0'
        ]);
        return redirect('/admin/detail')->with('success', 'Xóa thành công !');
    }
    public function search(Request $request){
        $products = Product::select('id','name', 'delete_status')->where('delete_status',1)->get();
        $k = $request->input('key');
        $details = DetailProduct::where('describe','LIKE','%'.$k.'%')->where('delete_status',1)->paginate(15);
        return view('admin.detail_product.search', compact('details', 'k', 'products'));
    }
//    xem chi tiết bài viết theo sản phẩm
    public function byProduct($id){
        $title = Product::select('name')->where('id',$id)->where('delete_status',1)->first();
        $details = DetailProduct::select('id', 'media', 'describe', 'delete_status', 'created_at', 'id_product')->where('delete_status',1)->where('id_product', $id)->paginate(15);
        return view('admin.detail_product.byproduct',compact('details','title'));
    }
}
