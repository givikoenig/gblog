@section('content')
<section class="body-content ">
    <div class="page-content">
        <div class="container">
            <div class="row">
                <div class="col-md-4">

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
                            <li>
                                <div class="thumb">
                                    <a href="{{ route('posts.show', $last->alias) }}">
                                        <img src="{{ Croppa::url( asset('assets').'/img/post/'. $last->img, 76,56 ) }}" alt="Post.img" />
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
					<!--comments widget-->
                    {{-- @if (isset($lastcomments))
                    <div class="widget">
                    	<div class="heading-title-alt text-left heading-border-bottom">
                    		<h6 class="text-uppercase">Последние комментарии </h6>
                    	</div>
                    	<ul class="widget-comments">
                    		@foreach ($lastcomments as $lastcomment)
                    		@php
                    		$lastpost = App\Post::find($lastcomment->item_id);
                    		@endphp
                    		<li>{{ App\User::find($lastcomment->user_id)->name }}, {{ Date::parse($lastcomment->created_at)->format('d M Y, H:i')  }}<br />Статья: <a href="{{ route('posts.show', ['alias' => $lastpost->alias] ) }}" class="dark-link">"{{ $lastpost->title }}"</a> <br /> <a href="{{ route('posts.show', [ 'alias' => $lastpost->alias.'#post-comments' ] ) }}">{{ str_limit($lastcomment->comment, 100, '…') }}</a>
                    		</li>
                    		@endforeach
                    	</ul>
                    </div>
                    @endif --}}
                    <!--comments widget-->
                </div>
                <div class="col-md-8 m-top-50">
                    	
                                	{{-- <div class="heading-title">
						            <img src="{{asset('assets')}}/img/post/avatar.jpg" style="float:left; margin-right:25px;">
						            <h3 class="stext-uppercase">Профиль  {{ $user->name }}</h3>
						            <form enctype="multipart/form-data" action="/profile" method="POST">
						                <label>Update Profile Image</label>
						                <input type="file" name="avatar">
						                <input type="hidden" name="_token" value="{{ csrf_token() }}">
						                <input type="submit" class="pull-right btn btn-sm btn-primary">
						            </form>
						            </div> --}}
						<h3 class="text-center">{{ $user->name }}</h3>
						<div class="login slogin-bg">
							
                            <div class="login-box btn-rounded slogin-bg-input border-less-input text-uppercase">
                                <p>Дата регистрации:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ Date::parse($user->created_at)->format('d-m-Y')  }}</p>
                                <p>Количество комментариев:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $commentscount ? $commentscount : 'Нет' }}</p>
                                <p>Количество лайков:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $likescount ? $likescount : 'Нет' }}</p>
                            </div>
							<div class="login-logo text-center">
				                <a href="javascript: void(0)">
				                	@if ( $user->avatar)
				                    <img class="retina" src="{{asset('assets')}}/img/post/{{ $user->avatar }}" alt="" / style="width: 250px;">
				                    @else
				                    <img class="retina" src="{{asset('assets')}}/img/post/a1.png" alt="" / style="width: 100px;">
				                    @endif
				                </a>
				            </div>
							<div class="login-box btn-rounded slogin-bg-input border-less-input">
								<form enctype="multipart/form-data" action="{{ route('update_profile') }}" method="POST">
									{{ csrf_field() }}
									<div class="form-group text-uppercase text-center">
							        	<label >Обновить изображение профиля</label>
							        </div>
							        <div class="form-group text-uppercase text-center">
							            <input type="file" name="avatar" style="margin-left: auto;margin-right: auto;" class="btn btn-small btn-dark-solid full-width btn-rounded">
							        </div>
							        <div class="form-group text-center">
							            <input type="submit" class="btn btn-small btn-dark-solid full-width btn-rounded">
							        </div>	
							    </form>
							</div>
						</div>
                    </div>
            </div>
        </div>
    </div>
</section>
@endsection	