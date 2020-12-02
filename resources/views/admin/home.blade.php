@section('category', 'Trang quản trị')
@section('title', 'Trang chủ')
@extends('admin.layouts.master')
@section('content')
    @if(Auth::user())
        {{Auth::user()}}
    @endif
@stop
