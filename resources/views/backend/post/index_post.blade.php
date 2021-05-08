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
<script src="{{asset('ckeditor\ckeditor.js') }}"></script>
<script src="{{asset('ckfinder\ckfinder.js') }}"></script>
<script>
    var options = {
        filebrowserImageBrowseUrl: '../../ckfinder/ckfinder.html?type=Images',
        filebrowserFlashBrowseUrl: '../../ckfinder/ckfinder.html?type=Flash',
        filebrowserImageUploadUrl: '../../ckfinder/core/connector/connector.php?command=QuickUpload&type=Images',
        filebrowserBrowseUrl: '../../..laravel-filemanager?type=Files',
        filebrowserFlashUploadUrl: '../../public/ckfinder/core/connector/connector.php?command=QuickUpload&type=Images',
    };
    CKEDITOR.replace('ckeditor', options);
    CKEDITOR.replace('ckeditorEdit', options);
</script>
@endsection