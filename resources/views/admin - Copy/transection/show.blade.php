@extends('admin.layouts.layout')
@section('admin_title_content')
    AHVision | Pay User
@endsection
@section('admin_css_content')
  
@endsection
@section('admin_content_header')
	<div class="col-sm-6">
		<h1 class="m-0">Pay User</h1>
	</div><!-- /.col -->
	@php 
	  $list = json_encode(['Home', 'Pay User']);
	@endphp
	<x-ad-breadcrumb :list="$list"/>
@endsection

@section('admin_main_content')

@endsection

@section('admin_js_content')
@endsection