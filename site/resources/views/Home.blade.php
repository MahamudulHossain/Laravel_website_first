@extends('Layout.app')

@section('title','Home')


@section('content')

@include('Components.HomeBanner')
@include('Components.HomeService')
@include('Components.HomeCourses')
@include('Components.HomeProjects')
@include('Components.HomeContact')
@include('Components.HomeReviews')


@endsection