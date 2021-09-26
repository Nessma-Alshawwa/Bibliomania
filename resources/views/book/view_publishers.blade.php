@extends('layouts.main')

@section('MainContent')
@include('includes.BookButton')
<!-- //header -->
<div class="w3l-homeblock2 py-5">
    <div class="container pt-md-4 pb-md-5">
        <!-- block -->
        <h3 class="category-title mb-3">Biblomonia Publishers ♥</h3>
        @foreach ($publishers as $publisher)
        <div class="align-items-center my-3">
            <a href="{{URL('/book/author/'.$publisher->id)}}">
                <p class="category-title mb-3">{{ $publisher->name }}</p>
            </a>
        </div>
        @endforeach
    </div>
</div>
@stop
