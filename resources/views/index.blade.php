@extends('layouts.app')

@section('navigation')
    {!! $navigation !!}
@endsection

@section('sliders')
    {!! $sliderIndex !!}
@endsection

@section('tourIndex')
    {!! $tourIndex !!}
@endsection

@section('countryIndex')
    {!! $countryIndex !!}
@endsection

@section('content')
    @include('content')
@endsection

@section('newsIndex')
    {!! $newsIndex !!}
@endsection

@section('footer')
    @include('footer')
@endsection