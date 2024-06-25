@extends('layout.app')
@section('content')
<main class="main">
    <div class="page-header text-center" style="background-image: url('{{url('assets/images/page-header-bg.jpg')}}')">
        <div class="container">
            <h1 class="page-title">{{$getBlog->title}}</h1>
        </div>
    </div>
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-3">
        <div class="container">
            @include('layout._message')

            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('')}}">Home</a></li>
                <li class="breadcrumb-item "><a href="{{url('blog')}}">Blog</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$getBlog->title}}</li>
            </ol>
        </div>
    </nav>

    <div class="page-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <article class="entry single-entry">
                        <figure class="entry-media">
                            <img src="{{$getBlog->getImage()}}" alt="{{$getBlog->title}}">
                        </figure>

                        <div class="entry-body">
                            <div class="entry-meta">

                                <a href="#">{{date('M d, Y',strtotime($getBlog->created_at))}}</a>
                                <span class="meta-separator">|</span>
                                <a href="#">{{$getBlog->getBlogCommentCount()}} Comments</a>
                                <span class="meta-separator">|</span>
                                @if (!empty($getBlog->getBlogCategory))
                                <a
                                    href="{{url('blog/category/'.$getBlog->getBlogCategory->slug)}}">{{$getBlog->getBlogCategory->name}}</a>

                                @endif
                            </div>


                            <br />
                            <div class="entry-content editor-content">
                                {!! $getBlog->description !!}


                            </div>
                        </div>

                        {{-- <div class="entry-footer row no-gutters flex-column flex-md-row">
                            <div class="col-md">
                                <div class="entry-tags">
                                    <span>Tags:</span> <a href="#">photography</a> <a href="#">style</a>
                                </div>
                            </div>

                            <div class="col-md-auto mt-2 mt-md-0">
                                <div class="social-icons social-icons-color">
                                    <span class="social-label">Share this post:</span>
                                    <a href="#" class="social-icon social-facebook" title="Facebook" target="_blank"><i
                                            class="icon-facebook-f"></i></a>
                                    <a href="#" class="social-icon social-twitter" title="Twitter" target="_blank"><i
                                            class="icon-twitter"></i></a>
                                    <a href="#" class="social-icon social-pinterest" title="Pinterest"
                                        target="_blank"><i class="icon-pinterest"></i></a>
                                    <a href="#" class="social-icon social-linkedin" title="Linkedin" target="_blank"><i
                                            class="icon-linkedin"></i></a>
                                </div>
                            </div>
                        </div> --}}



                    </article>


                    <div class="related-posts">
                        <h3 class="title">Related Posts</h3>

                        <div class="owl-carousel owl-simple" data-toggle="owl" data-owl-options='{
                                "nav": false, 
                                "dots": true,
                                "margin": 20,
                                "loop": false,
                                "responsive": {
                                    "0": {
                                        "items":1
                                    },
                                    "480": {
                                        "items":2
                                    },
                                    "768": {
                                        "items":3
                                    }
                                }
                            }'>
                            @foreach ($getRelatedPost as $related)
                            <article class="entry entry-grid">
                                <figure class="entry-media">
                                    <a href="{{url('blog/'.$related->slug)}}">{{$related->title}}">
                                        <img src="{{$related->getImage()}}" alt="{{$related->title}}">
                                    </a>
                                </figure>

                                <div class="entry-body">
                                    <div class="entry-meta">
                                        <a href="#">{{date('M d, Y',strtotime($related->created_at))}}</a>
                                        <span class="meta-separator">|</span>
                                        <a href="#">{{$related->getBlogCommentCount()}} Comments</a>
                                    </div>

                                    <h2 class="entry-title">
                                        <a href=" {{url('blog/'.$related->slug)}}">Cras ornare tristique elit.</a>
                                    </h2>

                                    @if (!empty($related->getBlogCategory))
                                    <div class="entry-cats">

                                        <a
                                            href="{{url('blog/category/'.$related->getBlogCategory->slug)}}">{{$related->getBlogCategory->name}}</a>
                                    </div>

                                    @endif


                                </div>
                            </article>
                            @endforeach


                        </div>
                    </div>


                    <div class="comments">
                        <h3 class="title">{{$getBlog->getBlogCommentCount()}} Comments</h3>

                        <ul>

                            @foreach ($getBlog->getBlogComment as $comment)
                            <li>
                                <div class="comment">

                                    <div class="comment-body">
                                        <div class="comment-user">
                                            <h4><a href="#">{{$comment->getUser->name}}</a></h4>
                                            <span class="comment-date">{{date('M d,
                                                Y',strtotime($comment->created_at))}} at {{date('h:i
                                                A',strtotime($comment->created_at))}}</span>
                                        </div>

                                        <div class="comment-content">
                                            <p>{{$comment->comment}}</p>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            @endforeach

                        </ul>
                    </div>
                    <div class="reply">
                        <div class="heading">
                            <h3 class="title">Leave A Comment</h3>
                            <p class="title-desc">Your email address will not be published. Required fields are marked *
                            </p>
                        </div>

                        <form action="{{url('blog/submit_comment')}}" method="POST">
                            {{ csrf_field() }}
                            <input type="hidden" name="blog_id" value="{{$getBlog->id}}">
                            <label for="reply-message" class="sr-only">Comment</label>
                            <textarea name="comment" id="reply-message" cols="30" rows="4" class="form-control" required
                                placeholder="Comment *"></textarea>


                            @if (!empty(Auth::check()))
                            <button type="submit" class="btn btn-outline-primary-2">
                                <span>POST COMMENT</span>
                                <i class="icon-long-arrow-right"></i>
                            </button>
                            @else
                            <a href="#signin-modal" data-toggle="modal" class="btn btn-outline-primary-2">
                                <span>POST COMMENT</span>
                                <i class="icon-long-arrow-right"></i>
                            </a>
                            @endif

                        </form>
                    </div>
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