@extends('layout.app')

@section('title','Admin | Home')

@section('content')

    <div class="container">

        <div class="row mt-5">

            <div class="col-md-3 my-3">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{$projectCount}}</h4>
                        <p class="h4">Total Project</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3  my-3">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{$courseCount}}</h4>
                        <p class="h4">Total Course</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3  my-3">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{$reviewCount}}</h4>
                        <p class="h4">Total Review</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3  my-3">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{$serviceCount}}</h4>
                        <p class="h4">Total Service</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 my-3">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{$visitorCount}}</h4>
                        <p class="h4">Total Visitor</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 my-3">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{$contactCount}}</h4>
                        <p class="h4">Total Contact</p>
                    </div>
                </div>
            </div>

        </div>

    </div>

@endsection()