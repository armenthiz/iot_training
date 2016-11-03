<div class="navbar navbar-fixed-top navbar-default" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar" />
                <span class="icon-bar" />
                <span class="icon-bar" />
            </button>
            <a href="/" class="navbar-brand">Task4</a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <li>
                    {!! link_to(route('root'), 'Home') !!}
                </li>
                @if (Sentinel::check())
                    {{-- <li>{!! link_to(route('articles.index'), 'Article') !!}</li> --}}
                    <li><a href="/articles" class="article_link">Article</a></li>
                    <li>{!! link_to(route('logout'), 'Logout') !!}</li>
                @else
                    <li>{!! link_to(route('signup'), 'Sign up') !!}</li>
                    <li>{!! link_to(route('login'), 'Login') !!}</li>
                @endif
            </ul>
        </div>
    </div>
</div>