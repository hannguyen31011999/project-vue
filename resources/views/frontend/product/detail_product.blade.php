@extends('frontend.master')

@section('title')
    Tin tức bán nhà đất
@endsection

@section('css')
<style>
.example-slide {
  align-items: center;
  background-color: #666;
  color: #999;
  display: flex;
  font-size: 1.5rem;
  justify-content: center;
  min-height: 10rem;
}

</style>
@endsection

@section('content')
<div id="app">
    <router-view></router-view>
</div>
@endsection

@section('js')
<script>
</script>
@endsection