@extends('layouts.master')
@section('title','Customer')
@section('food ','menu-open')
@section('food.active ','active')
@section('category','active')
@section('content')

    <food_category :token="{ value: '{{ csrf_token() }}'}"></food_category>
    
@endsection 