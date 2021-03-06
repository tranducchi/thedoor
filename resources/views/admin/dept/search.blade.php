@extends('admin.layouts.master')
@section('category', 'Bộ phận nhân sự')
@section('title', 'Danh sách')
@section('content')
    <div class="row">
        <div class="col-lg-6 offset-lg-3 mb-2">
            <form method="post" action="/admin/dept/search" class="d-flex justify-content-start">
                @csrf
                <input class="form-control mr-sm-2" type="text" name="key" placeholder="Tìm kiếm" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">
                    <i class="fa fa-search"></i>
                </button>
            </form>
        </div>

        <div class="col-lg-12">
            <div class="alert alert-warning">
                Tìm thấy <b>{{$dept->count()}}</b> cho từ khóa "<b>{{$k}}</b>"
            </div>
        </div>

        <div class="col-lg-12">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tên</th>
                    <th scope="col">Số điện thoại</th>
                    <th scope="col">Trưởng nhóm</th>
                    <th scope="col">Sửa</th>
                    <th scope="col">Xóa</th>
                </tr>
                </thead>
                <tbody>
                <?php $i = 1; ?>
                @foreach($dept as $d)
                    @if($d->delete_status==1)
                        <tr>
                            <th scope="row">{{$i}}</th>
                            <td>{{$d->dept_name}}</td>
                            <td>{{$d->phone}}</td>
                            <td>{{"Chi tran"}}</td>
                            <td><a href="/admin/dept/{{$d->id}}/edit" class="ml-2"><i class="fas fa-pencil-alt"></i></a>
                            </td>
                            <td>
                                <form action="{{ url('/admin/dept', ['id'=>$d->id]) }}" method="post">
                                    <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Xoá bộ phận nhân sự ? ');"><i
                                            class="fa fa-times"></i></button>
                                    @method('delete')
                                    @csrf
                                </form>
                            </td>
                        </tr>
                        <?php $i++; ?>
                    @endif
                @endforeach
                <tr class="col-lg-12 text-center">
                    {{$dept->links()}}
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@stop
