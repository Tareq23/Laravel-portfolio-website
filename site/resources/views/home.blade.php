@extends('layout.app')

@section('title','Home page')

@section('content')

    @include('components.homeBanner')
    @include('components.homeService')
    @include('components.homeCourse')
    @include('components.homeProject')
    @include('components.homeContact')

@endsection()