@extends('layout.app')

@section('title','Home page')

@section('content')

    @include('components.homeBanner')
    @include('components.homeService')
    @include('components.homeCourse')

@endsection()