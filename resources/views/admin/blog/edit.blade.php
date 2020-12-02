@extends('admin.layouts.master')
@section('category', 'Blog')
@section('title', 'Sửa bài viết')
@section('content')
    <div class="row">
        <div class="col-lg-12">
        <form action="/admin/blog/{{$blog->id}}" method="POST" enctype="multipart/form-data">
                @csrf
                {{ method_field('PATCH') }}
                <div class="form-group">
                    <label for="exampleInputEmail1">Tên bài viết : </label>
                <input type="text" name="title" value="{{$blog->title}}" class="form-control" placeholder="Nhập tên bài viết">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Mô tả</label>
                <textarea class="form-control" name="describe" placeholder="Mô tả bài viết" id="exampleFormControlTextarea1" rows="3">{{$blog->describe}}</textarea>
                  </div>
                  <div class="row mb-2">
                    <div class="col">
                        <img width="300" src="{{asset('storage/img/'.$blog->thumbnail)}}" alt="">
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="exampleInputPassword1">Ảnh : </label>
                            <input type="file" name="img" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Nội dung : </label>
                <textarea name="content" id="text" cols="30" rows="10">{{$blog->content}}</textarea>
                    <script src={{ url('ckeditor/ckeditor.js') }}></script>
                    <script>
                        CKEDITOR.replace( 'text', {
                            filebrowserBrowseUrl: '{{ route('ckfinder_browser') }}',

                        } );
                    </script>
                    @include('ckfinder::setup')
                </div>
            <input type="text" value="{{Auth::user()->name}}" name="author" hidden>
                <div class="form-group text-center mt-2">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-sync pr-1"></i>Cập nhật</button>
                </div>
            </form>
        </div>
    </div>
@stop

