@section('title', 'Tìm kiếm')

@extends('admin.layouts.master')
@section('content')
<div class="row">
        <div class="col-lg-6 offset-lg-3 mb-2">
            <form method="post" action="/admin/slide/search" class="d-flex justify-content-start">
                @csrf
                <input class="form-control mr-sm-2" type="text" name="key" placeholder="Tìm kiếm" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">
                    <i class="fa fa-search"></i>
                </button>
            </form>
        </div>
        <div class="col-lg-12">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tiêu đề slide</th>
                    <th scope="col">Ảnh</th>
                    <th scope="col">Liên kết</th>
                    <th scope="col">Trạng thái</th>
                    <th scope="col">Sửa</th>
                    <th scope="col">Xóa</th>
                </tr>
                </thead>
                <tbody>
                <?php $i = 1; ?>
                @foreach($slide as $s)

                    @if($s->delete_status==1)
                        <tr>
                            <th scope="row">{{$i}}</th>
                            <td>{{$s->title}}</td>
                            <td>
                                <img width="150" src="{{asset('storage/img/'.$s->image)}}" alt="">
                            </td>
                            <td>{{$s->link}}</td>
                            <td>
                            @if($s->active_status == 1)
                                    Hiển thị
                                @else
                                    Ẩn đi
                            @endif
                            </td>
                            <td><a href="/admin/slide/{{$s->id}}/edit" class="ml-2"><i
                                        class="fas fa-pencil-alt"></i></a></td>
                            <td>
                                <form action="{{ url('/admin/slide', ['id'=>$s->id]) }}" method="post">
                                    <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Xoá slide ? ');"><i
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
                    {{$slide->links()}}
                </tr>
                </tbody>
            </table>
        </div>
    </div>

    @endsection