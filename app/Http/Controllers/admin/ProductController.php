<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::select('id', 'id_customer', 'id_service', 'name', 'begin_day', 'finish_date', 'members', 'delete_status')->where('delete_status', 1)->orderBy('created_at', 'desc')->paginate(15);
        return view('admin.product.list', compact('product'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customer = Customer::select('id', 'customer_name')->where('delete_status',1)->get();
        $service = Service::select('id', 'service_name', 'logo', 'describe')->where('delete_status',1)->get();
        return view('admin.product.add', compact('service', 'customer'));
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
            'start' => 'required',
            'end' => 'required|after:start',
            'mem' => 'required',
        ],[
            'name.required'=>'Trường tên không được để trống',
            'start.required'=>'Chọn thời gian bắt đầu',
            'end.required'=>'Chọn thời gian kết thúc',
            'mem.required'=>'Nhập số lượng thành viên',
            'end.after'=>'Ngày kết thúc phải sau ngày bắt đầu'
        ]);
        $product = new Product;
        $product->name = $request->name;
        $product->slug =Str::slug($request->name);
        $product->id_service = $request->id_service;
        $product->id_customer = $request->id_customer;
        $product->begin_day = $request->start;
        $product->finish_date = $request->end;
        $product->members = $request->mem;
        $product->save();

        return redirect('/admin/product')->with('success', 'Thêm thành công !');
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
        $product = Product::find($id);
        $customer = Customer::select('id', 'customer_name')->where('delete_status',1)->get();
        $service = Service::select('id', 'service_name', 'logo', 'describe')->where('delete_status',1)->get();
        return view('/admin/product/edit', compact('customer', 'service', 'product'));
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
            'start' => 'required',
            'end' => 'required|after:start',
            'mem' => 'required',
        ],[
            'name.required'=>'Trường tên không được để trống',
            'start.required'=>'Chọn thời gian bắt đầu',
            'end.required'=>'Chọn thời gian kết thúc',
            'mem.required'=>'Nhập số lượng thành viên',
            'end.after'=>'Ngày kết thúc phải sau ngày bắt đầu'
        ]);
        $product = Product::find($id);
        $product->name = $request->name;
        $product->slug =Str::slug($request->name);
        $product->id_service = $request->id_service;
        $product->id_customer = $request->id_customer;
        $product->begin_day = $request->start;
        $product->finish_date = $request->end;
        $product->members = $request->mem;
        $product->save();

        return redirect('/admin/product')->with('success', 'Cập nhật thành công !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function delete(Request $request){
        $id = $request->id;
        Product::whereIn('id', $id)->update([
            'delete_status'=>'0'
        ]);
        return redirect('/admin/product')->with('success', 'Xóa thành công !');
    }
}
