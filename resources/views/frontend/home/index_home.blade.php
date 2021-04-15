@extends('frontend.master')

@section('title')
    Kênh thông tin bất động sản quận 9
@endsection

@section('css')
    <style>
        .form-control{
            background-color:gray;
        }
    </style>
@endsection

@section('content')
<div id="app">
    <router-view></router-view>
</div>
@endsection

@section('js')

@endsection