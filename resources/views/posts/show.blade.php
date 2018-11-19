@extends('layouts.posts')
@section('header')
@include('posts.header')
@endsection
@section('content')

<section class="body-content ">
    <div class="page-content">
        <div class="container">
            <div class="row small_scr">
                <div class="col-md-4 hidden-xs">
                    <!--search widget-->
                    <div class="widget">
                        <form class="form-inline form" role="form" action="{{ route('home') }}">
                            <div class="search-row">
                                <button class="search-btn" type="submit" title="Search">
                                    <i class="fa fa-search"></i>
                                </button>
                                <input type="text" class="form-control" placeholder="Поиск…" name="keyword">
                            </div>
                        </form>
                    </div>
                    <!--search widget-->
                    <!--tags widget-->
                    @if(isset($alltags))
                        <div class="widget">
                            <div class="heading-title-alt text-left heading-border-bottom">
                                <h6 class="text-uppercase">Теги</h6>
                            </div>
                            <div class="widget-tags flex-container">
                                <a href="{{ route('home') }}">Все</a>
                                @foreach ($alltags as $tag)
                                    @if($tag->posts->count()) 
                                    <div class="flex-element">
                                        <a href="{{ route('posts.index', ['category' => $tag->id ]) }}" style="font-size: {{ 100 + $tag->posts->count() * 3 }}%; color: rgb({{ 131 - $tag->posts->count() * 2 }}, {{ 127 - $tag->posts->count() * 2 }}, {{126 - $tag->posts->count() * 2 }}); ">{{ $tag->name }}</a>
                                    </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endif
                    <!--tags widget-->
                    <!--latest post widget-->
                    @if(isset($lasts))
                    <div class="widget">
                        <div class="heading-title-alt text-left heading-border-bottom">
                            <h6 class="text-uppercase">Последние статьи</h6>
                        </div>
                        <ul class="widget-latest-post">
                            @foreach ($lasts as $last)
                            <li>
                                <div class="thumb">
                                    <a href="{{ route('posts.show', $last->alias) }}">
                                            <img src="{{ $last->img ? Croppa::url( asset('assets').'/img/post/'. $last->img, 76,56 ) : asset('assets') . '/img/post/no_image-76x56.png' }}" alt="post.img" />
                                        </a>
                                </div>
                                <div class="w-desk">
                                    <a href="{{ route('posts.show', $last->alias) }}">{{ str_limit($last->title, 100) }}</a>
                                    {{ Date::parse($last->created_at)->format('d F Y')  }}
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    @endif 
                    <!--latest post widget-->
                    <!--follow us widget-->
                           {{--  <div class="widget">
                                <div class="heading-title-alt text-left heading-border-bottom">
                                    <h6 class="text-uppercase">я в соцсетях</h6>
                                </div>
                                <div class="widget-social-link circle">
                                    <a href="javascript: void(0)"><i class="fa fa-facebook"></i></a>
                                    <a href="javascript: void(0)"><i class="fa fa-vk"></i></a>
                                    <a href="javascript: void(0)"><i class="fa fa-google-plus"></i></a>
                                </div>
                            </div> --}}
                            <!--follow us widget-->
                            <!--comments widget-->
                            @if (isset($lastcomments))
                            <div class="widget">
                                <div class="heading-title-alt text-left heading-border-bottom">
                                    <h6 class="text-uppercase">Последние комментарии </h6>
                                </div>
                                <ul class="widget-comments">
                                    @foreach ($lastcomments as $lastcomment)
                                        @php
                                            $lastpost = App\Post::find($lastcomment->item_id);
                                            $lastcomment_user = App\User::find($lastcomment->user_id);
                                        @endphp
                                        @if ($lastcomment_user)
                                            <li>{{ App\User::find($lastcomment->user_id)->name }}, {{ Date::parse($lastcomment->created_at)->format('d M Y, H:i')  }}<br />Статья: <a href="{{ route('posts.show', ['alias' => $lastpost->alias] ) }}" class="dark-link">"{{ $lastpost->title }}"</a> <br /> <a href="{{ route('posts.show', [ 'alias' => $lastpost->alias.'#post-comments' ] ) }}">{!! str_limit($lastcomment->comment, 100, '…') !!}</a>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                            <!--comments widget-->
                            
<!--                            <div id="prop">
                                <prop-component :urldata="{{ json_encode($url_data) }}"></prop-component>
                            </div>-->
                                
                            
                        </div><!--./col-md-4-->
                        <div class="col-md-8">
                            <!--classic image post-->
                            @if (isset($post))
                            <div class="blog-classic post-page">
                                <div class="blog-post">
                                    @if ( $post->posttype->name == 'image' || $post->posttype->name =='gallery' || $post->posttype->name =='quote' || $post->posttype->name =='text' )
                                    <div class="full-width">
                                        @if ( $post->posttype->name == 'image' || $post->posttype->name =='quote' || $post->posttype->name =='text')
                                            @if( $post->img && $post->img != 'images/no_image.png')
                                                <img src="{{ asset('assets') }}/img/post/{{ $post->img }}" alt="post.jpg" />
                                            @endif
                                        @elseif ( $post->posttype->name =='gallery' )
                                        @if (isset($slides))
                                        <div class="flexslider post-img text-center relative">
                                            <ul class="slides">
                                                @foreach ($slides as $slide)
                                                <li>
                                                    <a href="{{ route('posts.show', $post->alias) }}" title="Slide for Post '{{ $post->title }}'">
                                                        <img src="{{ asset('assets') }}/img/post/{{ $slide }}" alt="">
                                                    </a>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        @endif
                                        @endif
                                    </div>
                                    @elseif ($post->posttype->name == 'audio')
                                    <p class="audio-fit m-bot-50">
                                        <iframe src="{{ $post->audiolink }}"></iframe>
                                    </p>
                                    @elseif ($post->posttype->name == 'video')
                                    <p class="video-fit m-bot-50">
                                        <iframe width="560" height="315" src="{{ $post->videolink }}" allowfullscreen></iframe>
                                    </p>
                                    @endif
                                    <h4 class=""><a href="javascript: void(0)">{{ $post->title }}</a></h4>
                                    <ul class="post-meta">
                                        <li><i class="fa fa-user"></i>Автор: <a href="#">{{ $post->user->name }}</a>
                                        </li>
                                        @if(count($post->tags))
                                            <li><i class="fa fa-folder-open"></i>  
                                                @foreach($post->tags as $key => $tag)
                                                <a href="{{ route('posts.index', ['category' => $tag->id ]) }}">{{ $tag->name }}</a>{{ $key == ($post->tags->count() -1) ? '' : ',' }}
                                                @endforeach
                                            </li>
                                        @endif
                                        <li><i class="fa fa-comments"></i>  <a href="#post-comments"> Комментарии ({{ $commentcount  }})</a>
                                        </li>
                                        <li>
                                            @include('laravelLikeComment::like', ['like_item_id' => $post->id ])
                                        </li>
                                    </ul>
                                    @if ( $post->posttype->name != 'quote' )
                                    <p>{!! $post->desc !!}</p>
                                    @else
                                    <div class="blog-post">
                                        <blockquote class="quote-post">
                                            {!! $post->desc !!}
                                        </blockquote>
                                    </div>
                                    @endif
                                    <div class="textbody">
                                            {!! htmlspecialchars_decode($post->body) !!}
                                    </div>
                                    {{-- share widget --}}
                                    <div class="clearfix inline-block m-top-50 m-bot-50">
                                        <h6 class="text-uppercase">Поделиться </h6>
                                        <div class="ya-share2" data-services="vkontakte,facebook,odnoklassniki,gplus,twitter" data-image="{{ asset('assets')  . '/img/post/' .  $post->img }}" data-title="{{ $post->title }}"  data-description="{!! $post->desc !!}" data-limit="3" data-counter></div>
                                    </div>
                                    {{-- ./share widget --}}
                                    {{-- posts simple pagination --}}
                                    <div class="pagination-row post-page">
                                        <div class="pagination-post">
                                            <div class="prev-post">
                                                @if($previous)
                                                <a href="{{ URL::to( 'posts/' .  App\Post::find($previous)->alias ) }}">
                                                    <div class="arrow">
                                                        <i class="fa fa-angle-double-left"></i>
                                                    </div>
                                                    <div class="pagination-txt">
                                                        <span>Предыдущая статья</span>
                                                    </div>
                                                </a>
                                                @else
                                                    <div class="pagination-txt">
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="post-list-link">
                                                <a href="{{ route('home') }}">
                                                    <i class="fa fa-home"></i>
                                                </a>
                                            </div>
                                            @if($next)
                                            <div class="next-post">
                                                <a href="{{ URL::to( 'posts/' .  App\Post::find($next)->alias ) }}">
                                                    <div class="arrow">
                                                        <i class="fa fa-angle-double-right"></i>
                                                    </div>
                                                    <div class="pagination-txt">
                                                        <span>Следующая статья</span>
                                                    </div>
                                                </a>
                                            </div>
                                            @else
                                                <div class="pagination-txt">
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <!-- /posts simple pagination -->
                                </div><!--/blog-post-->
                            </div><!--/blog-classic post-page-->
                            <div id="post-comments" class="heading-title-alt text-left heading-border-bottom">
                                <h4>КОММЕНТАРИИ ({{ $commentcount}})</h4>
                            </div >
                            @include('laravelLikeComment::comment', ['comment_item_id' => $post->id ])
                            @endif
                            <!--classic image post-->
                        </div><!--/col-md-8-->
                    </div><!--/row-->
                </div><!--/container-->
            </div><!--/page-content -->
        </section>
        @endsection
        @section('footer')
        @include('posts.footer')
        @endsection