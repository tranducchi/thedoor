@section('title', 'Slide')
@section('category', 'Slide')
@extends('admin.layouts.master')
@section('content')
<div class="row">
        <div class="col-lg-8 offset-lg-2">
            <form action="/admin/slide/{{$slide->id}}" method="POST" enctype="multipart/form-data">
            {{ method_field('PATCH') }}
                @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1">Tiêu đề slide : </label>
                    <input type="text" name="title" class="form-control" value="{{ $slide->title }}" placeholder="Nhập tiêu đề slide">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Link : </label>
                    <input type="text" name="link" class="form-control" value="{{ $slide->link }}" placeholder="Nhập liên kết cho slide">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Upload ảnh : </label>
                    <input type="file" name="image" class="form-control">
                </div>
                <div class="form-group">
                    <label for="description">Mô tả : </label>
                    <textarea type="text" name="description" rows="4" class="form-control">{{ $slide->describe }}</textarea>
                </div>
                <div class="form-group">
                <label for="slide">Trạng thái slide : </label>
                <select class="form-control" name="status" id="exampleFormControlSelect1">

                            <option value="0">Ẩn đi</option>
                            <option value="1" selected>Hiển thị</option>
                            </select>
                </div>
                <div class="form-group text-center">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-sync pr-1"></i>Cập nhật</button>
                </div>
            </form>
        </div>
    </div>
@endsection
