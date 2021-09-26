@extends('layouts.main')

@section('MainContent')

<div class="w3l-homeblock2 w3l-homeblock5 py-5">
    <div class="container pt-md-4 pb-md-5">
        <!-- block -->
        @include('includes.AdminButton')
        <h3 class="category-title mb-3"> Edit Books</h3>
        <div class="row">
            @foreach ($books as $book)
            <div class="col-lg-6 my-3">
                <div class="bg-clr-white hover-box">
                    <div class="row">
                        <div class="col-sm-5 position-relative">
                            <a href="{{ URL('admin/edit_book/'. $book->id ) }}">
                                <img class="card-img-bottom d-block radius-image-full" src="{{ asset($book->image) }}" alt="Card image cap">
                            </a>
                        </div>
                        <div class="col-sm-7 card-body blog-details align-self">
                            <a href="{{ URL('admin/edit_book') }}" class="blog-desc">{{ $book->title }}</a>
                            {{-- <p class="mb-sm-5 mb-4 max-width">{{ $book->description }}</p> --}}
                            <div class="author align-items-center">
                                @if (!empty($book->books_author))
                                    @foreach ($book->books_author as $books_author)
                                        @if (!empty($books_author->author))
                                            <span>Author:</span>
                                            <span class="meta-value"><a href="#">{{ $books_author->author['name'] }}
                                        @endif
                                    @endforeach
                                </a></span>
                                @endif
                            </div>
                            <div class="author align-items-center">
                                @if (!empty($book->publisher))
                                    <span>Publisher:</span>
                                    <span class="meta-value"><a href="#">{{ $book->publisher['name'] }}</a></span>
                                @endif
                            </div>
                            <div class="author align-items-center">
                                @if (!empty($book->books_category))
                                    @foreach ($book->books_category as $books_category)
                                        @if (!empty($books_category->category))
                                            <span>Category:</span>
                                            <span class="meta-value"><a href="#">{{ $books_category->category['category'] }}
                                        @endif
                                    @endforeach
                                </a></span>
                                @endif
                            </div>
                            <div class="author align-items-center">
                                <span>Published</span>
                            </div>
                            <div class="author align-items-center">
                                
                                <span>Year:</span>
                                <span class="meta-value">{{ $book->published_year }}.</span>
                                {{-- <span>Published Year:</span> --}}
                            </div>
                            <div class="author align-items-center"> 
                                <span>Number:</span>
                                <span class="meta-value">{{ $book->published_number }}.</span>
                                
                            </div>
                            <div class="author align-items-center p-2"> 
                                <span></span>
                                <a class="btn btn-style btn-primary" href="{{URL('admin/book/edit/' . $book->id) }}" >Edit</a>
                            </div>
                            <div class="author align-items-center p-2"> 
                                <span></span>
                                <form action="{{URL('admin/book/restore/' . $book->id) }}" method="POST" id="delete-book-form">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <button type="button" class="btn btn-style btn-danger" onclick="Delete_button()">Restore</button>
                                </form>
                            </div>
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
