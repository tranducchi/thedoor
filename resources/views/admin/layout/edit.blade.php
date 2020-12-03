@extends('admin.layouts.master')
@section('category', 'Giao diện')
@section('title', 'Sửa')
@section('content')
    <div class="row">
        <div class="col-lg-8 offset-lg-2">
        <form action="/admin/layout/{{$layout->id}}" method="POST" enctype="multipart/form-data">
                {{ method_field('PATCH') }}
                @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1">Giao diện</label>
                    <select name="offset" id="" class="form-control">
                    <option value="{{$layout->offset}}">Trang {{$layout->offset}}</option>
                    </select>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <img width="300" src="{{asset('storage/img/'.$layout->link)}}" alt="">
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="exampleInputPassword1">Ảnh : </label>
                            <input type="file" name="img" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="form-group text-center">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-sync pr-1"></i>Cập nhật</button>
                </div>
            </form>
        </div>
    </div>
@stop

