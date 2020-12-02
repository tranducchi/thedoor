@extends('admin.layouts.master')
@section('category', 'Blog')
@section('title','Danh sách')
@section('content')
    <div class="row">
        <div class="col-lg-6 offset-lg-3 mb-2">
            <form method="post" class="d-flex justify-content-start">
                @csrf
                <input class="form-control mr-sm-2" type="text" name="key" placeholder="Tìm kiếm" aria-label="Search">
                <button formaction="/admin/blog/search" class="btn btn-outline-success my-2 my-sm-0" type="submit">
                    <i class="fa fa-search"></i>
                </button>
            </form>
        </div>
        <div class="col-lg-12">
            <form method="post">
                @csrf
            <div class="show-delete pb-2">
                <button class="btn btn-danger btn-sm" formaction="{{url('/admin/bg/delete')}}"><i class="fa fa-trash mr-1"></i>Xóa mục đã chọn</button>
            </div>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col"><input type="checkbox" id="checkAll">
                    </th>
                    <th scope="col">#</th>
                    <th scope="col">Tên</th>
                    <th scope="col">Ảnh</th>
                    <th scope="col">Ngày đăng</th>
                    <th scope="col">Sửa</th>
                    <th scope="col">Xóa</th>
                </tr>
                </thead>
                <tbody>
                <?php $i = 1; ?>
                @if($blogs)
                    @foreach($blogs as $b)
                            <tr>
                                <td>
                                    <input type="checkbox" class="sub_chk" name="id[]" value="{{$b->id}}">
                                </td>
                                <th scope="row">{{$i}}</th>
                                <td>{{$b->title}}</td>
                                <td>
                                    <img width="150" src="{{asset('/storage/img/'.$b->thumbnail)}}" alt="">
                                </td>
                                <td>
                                    {{$b->created_at->format('d/m/yy')}}
                                </td>
                                <td><a href="/admin/blog/{{$b->id}}/edit" class="ml-2"><i class="fas fa-pencil-alt"></i></a>
                                </td>
                                <td>
                                    <form method="post">
                                        <button type="submit" class="btn btn-danger btn-sm"
                                                formaction="{{ url('/admin/blog', ['id'=>$b->id]) }}"
                                                onclick="return confirm('Xoá bài viết ? ');"><i
                                                class="fa fa-times"></i></button>
                                        @method('delete')
                                        @csrf
                                    </form>
                                </td>
                            </tr>
                            <?php $i++; ?>
                    
                    @endforeach
                @endif
                <tr class="col-lg-12 text-center">
                    {{$blogs->links()}}
                </tr>
                </tbody>
            </table>
        </form>
        </div>

    </div>
@stop

