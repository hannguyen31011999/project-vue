@extends('backend.master')

@section('title')
    Trang quản lý bài viết
@endsection

@section('css')
    <style>
        
    </style>
@endsection

@section('content')
<div id="app">
    <router-view></router-view>
    <!-- <textarea name=ckeditor id="ckeditor" cols="30" rows="10"></textarea> -->
</div>
@endsection
@section('js')
<script src="{{ asset('/js/helper.js') }}"></script>
@endsection