<div id="article-list">
    <h1>Article Page</h1>
        <div>
            {!! link_to('articles/create', 'Write Article', ['class' => 'btn btn-success']) !!}
        </div>
    @foreach ($articles as $article)
        <div>
            <h1>
                {!! $article->title !!}
            </h1>
            <p>
                {!! $article->content !!}
            </p>
            <div>
            {!! link_to('articles/' . $article->id, 'Show', ['class' => 'btn btn-info']) !!}
            {!! link_to('articles/' . $article->id . '/edit', 'Edit', ['class' => 'btn btn-warning']) !!}
            {{-- {!! link_to('articles/' . $article->id, 'Delete', ['class' => 'btn btn-danger', 'method' => 'DELETE', "onclick" => "return confirm('are you sure?')"]) !!} --}}
            {!! Form::open(['route' => ['articles.destroy', $article->id], 'method' => 'DELETE']) !!}
                {!! Form::submit('Delete', ['class' => 'btn btn-danger', "onclick" => "return confirm('are you sure')"]) !!}
            {!! Form::close() !!}
            </div>
        </div>
    @endforeach
    {!! $articles->render() !!}
</div>

{{-- <article class="row">
    <h1>{!! $article->title !!}</h1>
    <p>
        {!! str_limit($article->content, 250) !!}
        {!! link_to(route('articles.show', $article->id), 'Read More') !!}
    </p>
</article> --}}