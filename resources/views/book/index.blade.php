@extends('layouts.main')

@section('MainContent')

@include('includes.BookButton')

<section class="w3l-testimonials" id="testimonials">
    <!-- main-slider -->
    <div class="testimonials pt-2 pb-5">
        <div class="container pb-lg-5">
            <div class="owl-testimonial owl-carousel owl-theme mb-md-0 mb-sm-5 mb-4">
                @foreach ($books as $book)
                <div class="item">
                    <div class="row slider-info">
                        <div class="col-lg-8 message-info align-self">
                            <span class="label-blue mb-sm-4 mb-3">Book</span>
                            <h3 class="title-big mb-4"><a href="{{ URL('/book/'.$book->id) }}">{{ $book->title }}</a>
                            </h3>
                            <p class="message">{{ $book->description }}<br><small><a href="{{ URL('/book/'.$book->id) }}" id="readMore">Read More</a></small></p>
                        </div>
                        <div class="col-lg-4 col-md-8 img-circle mt-lg-0 mt-4">
                            <img src="{{ asset($book->image) }}" class="img-fluid radius-image-full" alt="client image">
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
   
    <!-- /main-slider -->
</section>


<div class="w3l-homeblock2 py-5">
    <div class="container py-lg-5 py-md-4">
        <h3 class="section-title-left mb-4"> Top Pick's of this month </h3>
        <div class="row top-pics">
            @foreach ($books as $book)
            <div class="col-lg-4 col-md-6 mt-md-0 mt-4">
                <div class="w3l-homeblock3" style="border-radius: var(--border-radius-full);">
                    <div class="top-pic1" style="background: url({{ asset($book->image) }}); no-repeat 0px 0px;
                        background-size: cover;
                        padding: 20px;
                        border-radius: var(--border-radius-full);
                        height: 450px;
                        display: grid;
                        align-items: flex-end;
                        position: relative;
                        z-index: 1;">
                        <div class="card-body blog-details">
                            <a href="#blog-single.html" class="blog-desc text-light">{{ $book->title }}</a>
                            <div class="author align-items-center">
                                <span></span>
                                <ul>
                                    <li style="color: #eee">
                                        @if (!empty($book->books_author))
                                        @foreach ($book->books_author as $books_author)
                                            @if (!empty($books_author->author))
                                                <span>Author:</span>
                                                <span>{{ $books_author->author['name'] }}</span>
                                            @endif
                                        @endforeach
                                        @endif
                                    </li>
                                    <li style="color: #eee"> 
                                        <span><span class="fa fa-clock-o"></span> Published Year:</span>
                                        <span> {{ $book->published_year }}. </span>.
                                    </li>
                                </ul>
                            </div>
                    </div>
                </div>
            </div>
            </div>
            @endforeach
        </div>
    </div>
</div>


@stop
