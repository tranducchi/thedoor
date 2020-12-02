<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Product;
use App\Models\DetailProduct;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customer = Customer::select('id', 'customer_name', 'phone', 'email', 'address', 'image', 'delete_status')->orderBy('created_at','desc')->paginate(15);
        return view('admin.customer.list', compact('customer'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.customer.add');
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
            'phone' => 'required',
            'email' => 'required',
            'address' => 'required',
        ],[
            'name.required'=>'Trường tên không được để trống',
            'phone.required'=>'Trường điện thoại không được để trống',
            'email.required'=>'Trường email không được để trống',
            'address.required'=>'Trường địa chỉ không được để trống'
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
        $customer = new Customer;
        $customer->image = $fileNameToStore;
        $customer->customer_name = $request->name;
        $customer->phone = $request->phone;
        $customer->address = $request->address;
        $customer->email = $request->email;
        $customer->save();
        return redirect('/admin/customer')->with('success', 'Thêm thành công !');
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
        $customer = Customer::find($id);
        return view('admin.customer.edit', compact('customer'));
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
            'address' => 'required',
        ],[
            'name.required'=>'Trường tên không được để trống',
            'phone.required'=>'Trường điện thoại không được để trống',
            'email.required'=>'Trường email không được để trống',
            'address.required'=>'Trường địa chỉ không được để trống'
        ]);
        //upload
        $customer = Customer::find($id);
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
            $customer->image = $fileNameToStore;
        }
        $customer->customer_name = $request->name;
        $customer->phone = $request->phone;
        $customer->address = $request->address;
        $customer->email = $request->email;
        $customer->save();
        return redirect('/admin/customer')->with('success', 'Cập nhật thành công !');
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
        Customer::whereIn('id', $id)->update([
            'delete_status'=>'0'
        ]);
        return redirect('/admin/service')->with('success', 'Xóa thành công !');
    }
    public function showProduct($id){
        $title = Customer::select('customer_name','id')->where('id', $id)->where('delete_status',1)->get();
        $products = Product::select('id', 'id_customer','name', 'begin_day', 'finish_date')->where('id_customer', $id)->where('delete_status', 1)->paginate(15);
        return view('admin.customer.show-product',compact('title', 'products'));
    }
    public function viewCustomer($id){
        $product=Product::find($id);
        $details = $product->details;
        return view('admin.customer.detail_by_customer', compact('details'));
    }
}
