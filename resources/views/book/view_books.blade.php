@extends('layouts.main')

@section('MainContent')
@include('includes.BookButton')
<!-- //header -->
<div class="w3l-homeblock2 py-5">
    <div class="container pt-md-4 pb-md-5">
        <!-- block -->
        <h3 class="category-title mb-3">Biblomonia Books ♥</h3>
        <div class="row">
            @foreach ($books as $book)
            <div class="col-lg-4 col-md-6 item">
                <div class="card">
                    <div class="card-header p-0 position-relative">
                        <a href="#blog-single.html">
                            <img class="card-img-bottom d-block radius-image-full" src="{{ asset($book->image) }}"
                                alt="Card image cap">
                        </a>
                    </div>
                    <div class="card-body blog-details">
                        <a href="{{URL('/book/'.$book->id)}}" class="blog-desc">{{ $book->title }}</a>
                        <p>{{ $book->description }}</p>
                        <div class="author align-items-center mt-3 mb-1">
                            <img src="assets/images/a1.jpg" alt="" class="img-fluid rounded-circle" />
                            <ul class="blog-meta">
                                <li>
                                    @if (!empty($book->books_author))
                                        @foreach ($book->books_author as $books_author)
                                            @if (!empty($books_author->author))
                                                <span>Author:</span>
                                                <span>{{ $books_author->author['name'] }}</span>
                                            @endif
                                        @endforeach
                                        @endif
                                </li>
                                <li class="meta-item blog-lesson">
                                    <span><span class="fa fa-clock-o"></span> Published Year:</span>
                                        <span> {{ $book->published_year }}. </span>.
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <ul class="site-pagination text-center mt-md-5 mt-4">
            <li><span aria-current="page" class="page-numbers current">{{ $books->links() }}</span></li>
        </ul>
    </div>
</div>
@stop
