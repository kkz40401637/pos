@extends('layouts.master')
@section('title','Customer')
@section('food ','menu-open')
@section('food.active ','active')
@section('product','active')
@section('content')

<food_product :category="{{ $category }}"></food_product>
@endsection 