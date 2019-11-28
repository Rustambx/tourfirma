@extends('layouts.site')

@section('navigation')
    {!! $navigation !!}
@endsection

@section('header')
    @include('admin.header')
@endsection

@section('breadcrumbs')
    @include('admin.breadcrumbs')
@endsection