@extends('admin.layouts.master')
@section('category', 'Blog')
@section('title','Chi tiết bài viêt')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="h3">{{$blog->title}}</div>
        <div class="col-lg-12 text-center">
            <img width="400" src="{{asset('/storage/img/'.$blog->thumbnail)}}" alt="">
        </div>
        <div class="content" style="overflow: hidden">
            {!!$blog->content!!}
        </div>
        <div class="d-flex flex-row">
            <form action="/admin/bl/{{$blog->id}}" method="POST" enctype="multipart/form-data">
                <button type="submit" class="btn btn-success mr-2">
                    <i class="fa fa-check pr-1"></i>
                    Phê duyệt
                </button>
                @csrf
              
            </form>
            <form method="post">
                <button type="submit" class="btn btn-danger"
                        formaction="{{ url('/admin/blog', ['id'=>$blog->id]) }}"
                        onclick="return confirm('Xoá bài viết ? ');"><i
                        class="fa fa-trash pr-1"></i>Xoá</button>
                @method('delete')
                @csrf
            </form>
        </div>
    </div>

</div>
@stop