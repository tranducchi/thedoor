@extends('admin.layouts.master')
@section('category', 'Blog')
@section('title', 'Bài viết mới')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <form action="/admin/blog" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1">Tên bài viết : </label>
                    <input type="text" name="title" class="form-control" placeholder="Nhập tên bài viết">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Mô tả</label>
                    <textarea class="form-control" name="describe" placeholder="Mô tả bài viết" id="exampleFormControlTextarea1" rows="3"></textarea>
                  </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Ảnh thumbnail</label>
                    <input type="file" name="img" class="form-control">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Nội dung : </label>
                    <textarea name="content" id="text" cols="30" rows="10"></textarea>
                    <script src={{ url('ckeditor/ckeditor.js') }}></script>
                    <script>
                        CKEDITOR.replace( 'text',
                   {
                       filebrowserBrowseUrl : 'ckfinder/ckfinder.html',
                       filebrowserImageBrowseUrl : 'ckfinder/ckfinder.html?type=Images',
                       filebrowserFlashBrowseUrl : 'ckfinder/ckfinder.html?type=Flash',
                       filebrowserUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                       filebrowserImageUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
                       filebrowserFlashUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
                   });
                   </script>
              
                </div>
            <input type="text" value="{{Auth::user()->id}}" name="author" hidden>
                <div class="form-group text-center mt-2">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-plus-circle pr-1"></i>Thêm mới</button>
                </div>
            </form>
        </div>
    </div>
@stop

