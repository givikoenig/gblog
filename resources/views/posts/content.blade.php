<section class="body-content ">
    <div class="page-content">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <!--author widget-->
                    @if(isset($abouts))
                    @foreach ($abouts as $about)
                    @if ($about->active)
                    <div class="widget">
                        <div class="heading-title-alt text-left heading-border-bottom">
                            <h6 class="text-uppercase">{{ $about->title }}</h6>
                        </div>
                        <div class="full-width m-bot-30">
                            <img src="{{ asset('assets') }}/img/post/{{ $about->img }}" alt="about_image" />
                        </div>
                        <p>{!! $about->text !!}</p>

                        <span class="">{{ $about->sig }}</span>
                    </div>
                    @endif
                    @endforeach
                    @endif
                    <!--author widget-->
                    <!--tags widget-->
                    @if(isset($alltags))
                    <div class="widget">
                        <div class="heading-title-alt text-left heading-border-bottom">
                            <h6 class="text-uppercase">Теги</h6>
                        </div>
                        <div class="widget-tags">
                            <a href="{{ route('home') }}">Все</a>
                            @foreach ($alltags as $tag)
                            @if($tag->posts->count()) 
                            <a href="{{ route('posts.index', ['category' => $tag->id ]) }}" style="font-size: {{ 100 + $tag->posts->count() * 3 }}%; color: rgb({{ 131 - $tag->posts->count() * 2 }}, {{ 127 - $tag->posts->count() * 2 }}, {{126 - $tag->posts->count() * 2 }}); ">{{ $tag->name }}</a>
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
                            @if ($last->active)
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
                            @endif
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <!--latest post widget-->
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
                            @endphp
                            <li>{{ App\User::find($lastcomment->user_id)  ? App\User::find($lastcomment->user_id)->name : '' }}, {{ Date::parse($lastcomment->created_at)->format('d M Y, H:i')  }}<br />Статья: <a href="{{ route('posts.show', ['alias' => $lastpost->alias] ) }}" class="dark-link">"{{ $lastpost->title }}"</a> <br /> <a href="{{ route('posts.show', [ 'alias' => $lastpost->alias.'#post-comments' ] ) }}">{{ str_limit($lastcomment->comment, 100, '…') }}</a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <!--comments widget-->
                </div>

                <div class="col-md-8">
                    @foreach ($posts as $post)
                    @if ($post->active)
                    <div class="blog-classic">
                        <div class="date right">
                            {{ $post->created_at->format('d') }}
                            <span class="postdate">{{ Date::parse($post->created_at)->format('M Y')  }}</span>
                        </div>
                        <div class="blog-post">
                            @if ( $post->posttype->name == 'image' || $post->posttype->name =='gallery' )
                            <div class="full-width">
                                @if ( $post->posttype->name == 'image' )
                                <a href="{{ route('posts.show', $post->alias) }}"><img src="{{ asset('assets') }}/img/post/{{ $post->img }}" alt="Image for Post '{{ $post->title }}'" /></a>
                                @elseif ( $post->posttype->name =='gallery' )
                                @if (isset($slides[$post->id]))
                                <div class="{{-- post-slider --}} flexslider post-img text-center relative">
                                    <ul class="slides">
                                        @foreach ($slides[$post->id] as $slide)
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
                            <h4 class=""><a href="{{ route('posts.show', $post->alias) }}">{{ $post->title }}</a></h4>
                            <p>{!! $post->desc !!}</p>
                            @elseif( $post->posttype->name == 'quote' )
                            <blockquote class="quote-post">
                                <a href="{{ route('posts.show', $post->alias) }}">
                                    {!! $post->desc !!}
                                </a>
                            </blockquote>
                            <span class="m-bot-30">{!! $post->quoteauthor !!}</span>
                            @elseif ( $post->posttype->name == 'audio')
                            <p class="audio-fit m-bot-50">
                                <iframe src="{{ $post->audiolink }}"></iframe>
                            </p>
                            <h4 class="xs-m-top"><a href="{{ route('posts.show', $post->alias) }}">{{ $post->title }}</a></h4>
                            <p>{!! $post->desc !!}</p>
                            @elseif ( $post->posttype->name == 'video')
                            <p class="video-fit m-bot-50">
                                <iframe width="560" height="315" src="{{ $post->videolink }}" allowfullscreen></iframe>
                            </p>
                            <h4 class=""><a href="{{ route('posts.show', $post->alias) }}">{{ $post->title }}</a></h4>
                            <p>{!! $post->desc !!}</p>
                            @else
                            <h4 class=""><a href="{{ route('posts.show', $post->alias) }}">{{ $post->title }}</a></h4>
                            <p>{!! $post->desc !!}</p>
                            @endif
                        </div>
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
                            <li><i class="fa fa-comments"></i>  <a href="{{ route('posts.show', ['alias' => $post->alias]) }}#post-comments"> Комментарии ({{ risul\LaravelLikeComment\Models\Comment::where('item_id', $post->id)->count()  }})</a>
                            </li>
                        </ul>
                    </div>
                    @endif
                    @endforeach
                    <!--pagination-->
                    <div class="text-center" id="custompagination">
                        {{ $posts->links() }}
                    </div>
                    <!--pagination-->
                </div>
            </div>
        </div>
    </div>
</section>