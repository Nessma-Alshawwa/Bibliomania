@extends('layouts.main')

@section('MainContent')
@include('includes.BookButton')
<!-- //header -->
<div class="w3l-homeblock2 py-5">
    <div class="container pt-md-4 pb-md-5">
        <!-- block -->
        <h3 class="category-title mb-3">Biblomonia Authors ♥</h3>
        @foreach ($authors as $author)
        <div class="align-items-center my-3">
            <a href="{{URL('/book/author/'.$author->id)}}">
                <p class="category-title mb-3">{{ $author->name }}</p>
            </a>
        </div>
        @endforeach
    </div>
</div>
@stop
