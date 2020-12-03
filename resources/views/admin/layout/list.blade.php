@extends('admin.layouts.master')
@section('category', 'Bộ phận nhân sự')
@section('title','Danh sách')
@section('content')
    <div class="row">
        <div class="col-lg-6 offset-lg-3 mb-2">
        </div>
        <div class="col-lg-12">
            <form method="post">
                @csrf
            <div class="show-delete pb-2">
                <button class="btn btn-danger btn-sm" formaction="{{url('/admin/lo/delete')}}"><i class="fa fa-trash mr-1"></i>Xóa mục đã chọn</button>
            </div>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col"><input type="checkbox" id="checkAll">
                    </th>
                    <th scope="col">#</th>
                    <th scope="col">Trang</th>
                    <th scope="col">Ảnh nền</th>
                    <th scope="col">Sửa</th>
                    <th scope="col">Xóa</th>
                </tr>
                </thead>
                <tbody>
                <?php $i = 1; ?>
                @if($layouts) 
                @foreach($layouts as $l)
            
                        <tr>
                            <th>
                                <input type="checkbox" class="sub_chk" name="id[]" value="{{$l->id}}">
                            </th>
                            <th scope="row">{{$i}}</th>
                            <td>Trang {{$l->offset}}</td>
                            <td>
                            <img width="150" src="{{asset('/storage/img/'.$l->link)}}" alt="">
                            </td>
                            <td>
                                <a href="/admin/layout/{{$l->id}}/edit" class="ml-2"><i class="fas fa-pencil-alt"></i></a>
                            </td>
                    
                            <td>
                                <form method="post">
                                    <button type="submit" class="btn btn-danger btn-sm"
                                            formaction="{{ url('/admin/layout', ['id'=>$l->id]) }}"
                                            onclick="return confirm('Xoá nhân viên ? ');"><i
                                            class="fa fa-times"></i></button>
                                    @method('delete')
                                    @csrf
                                </form>
                            </td>
                        </tr>
                 
              
                <?php $i++; ?>
        @endforeach
                @endif
                </tbody>
            </table>
        </form>
        </div>

    </div>
@stop

