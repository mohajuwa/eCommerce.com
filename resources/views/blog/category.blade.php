@extends('layout.app')
@section('title', 'Home')
@section('content')
<main class="main">
    {{-- <div class="page-header text-center" style="background-image: url('{{ $getPage->getImage() }}')"> --}}
        <div class="page-header text-center"
            style="background-image: url('{{url('assets/images/page-header-bg.jpg')}}')">

            <div class="container">
                <h1 class="page-title">{{$getCategory->title}}</h1>
            </div>
        </div>
        <nav aria-label="breadcrumb" class="breadcrumb-nav mb-3">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('')}}">Home</a></li>
                    <li class="breadcrumb-item "><a href="{{url('blog')}}">Blog</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{$getCategory->title}}</li>

                </ol>
            </div>
        </nav>

        <div class="page-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="entry-container max-col-2" data-layout="fitRows">
                            @foreach ($getBlog as $blog )
                            <div class="entry-item col-sm-6">
                                <article class="entry entry-grid">
                                    <figure class="entry-media">
                                        <a href="{{url('blog/'.$blog->slug)}}">
                                            <img src="{{$blog->getImage()}}"
                                                style="height: 300px;width:100%;object-fit:cover"
                                                alt="{{$blog->title}}">
                                        </a>
                                    </figure>

                                    <div class="entry-body">
                                        <div class="entry-meta">

                                            <span class="meta-separator">|</span>
                                            <a href="#">{{date('M d, Y',strtotime($blog->created_at))}}</a>
                                            <span class="meta-separator">|</span>
                                            <a href="#">{{$blog->getBlogCommentCount()}} Comments</a>
                                        </div>

                                        <h2 class="entry-title">
                                            <a href="{{url('blog/'.$blog->slug)}}">{{$blog->title}}</a>
                                        </h2>
                                        @if (!empty($blog->getBlogCategory))
                                        <div class="entry-cats">
                                            in <a
                                                href="{{url('blog/category/'.$blog->getBlogCategory->slug)}}">{{$getCategory->name}}</a>,
                                        </div>
                                        @endif

                                        <div class="entry-content">
                                            <p>{{$blog->short_description}}</p>
                                            <a href="{{url('blog/'.$blog->slug)}}" class="read-more">Continue
                                                Reading</a>
                                        </div>



                                    </div>
                                </article>
                            </div>
                            @endforeach


                        </div>

                        <nav aria-label="Page navigation">

                            <ul class="pagination justify-content-center">

                                <!-- Previous Page Link -->
                                @if ($getBlog->previousPageUrl())
                                <li class="page-item">
                                    <a class="page-link page-link-prev" href="{{ $getBlog->previousPageUrl() }}"
                                        aria-label="Previous">
                                        <span aria-hidden="true"><i class="icon-long-arrow-left"></i></span> Prev
                                    </a>
                                </li>
                                @else
                                <li class="page-item disabled">
                                    <span class="page-link page-link-prev" aria-hidden="true">
                                        <span aria-hidden="true"><i class="icon-long-arrow-left"></i></span> Prev
                                    </span>
                                </li>
                                @endif

                                <!-- Pagination Elements -->
                                {!! $getBlog->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}


                                <!-- Next Page Link -->
                                @if ($getBlog->nextPageUrl())
                                <li class="page-item">
                                    <a class="page-link page-link-next" href="{{ $getBlog->nextPageUrl() }}"
                                        aria-label="Next">
                                        Next <span aria-hidden="true"><i class="icon-long-arrow-right"></i></span>
                                    </a>
                                </li>
                                @else
                                <li class="page-item disabled">
                                    <span class="page-link page-link-next" aria-hidden="true">
                                        Next <span aria-hidden="true"><i class="icon-long-arrow-right"></i></span>
                                    </span>
                                </li>
                                @endif
                            </ul>
                        </nav>
                    </div>
                    <aside class="col-lg-3">

                        @include('blog._sidbar')
                    </aside>
                </div>
            </div>
        </div>
</main>
@endsection

@section('script')

<script type="text/javascript">

</script>
@endsection