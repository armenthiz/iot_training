<div class="row">
    <div class="col-lg-12" id="enrolls-list">
        <h1>Article Page</h1>
            <div>
                {!! link_to('articles/create', 'Write Article', ['class' => 'btn btn-success']) !!}
            </div>
            <div class="row">
                <div class="col-md-12 search">
                    <div class="col-md-6">
                        <div class="input-group input-group-sm">
                            {!! Form::text('search', null, ['id' => 'keywords', 'class' => 'form-control', 'placeholder' => 'Keywords']) !!}
                            <span class="input-group-btn"></span>
                            <button id="search" class="btn btn-info btn-flat" type="button">
                                Go!
                            </button>
                        </div> <!-- /input-group -->
                    </div>
                </div>
            </div>
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th class="text-center">
                        <a href="#" id="id">ID</a>
                        <i id="ic-direction"></i>
                    </th>
                    <th class="text-center">
                        Title
                    </th>
                    <th class="text-center">
                        Content
                    </th>
                    <th class="text-center">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($articles as $article)
                <tr>
                    <td>{!! $article->id !!}</td>
                    <td class="text-center">
                        {!! $article->title !!}
                    </td>
                    <td class="text-center">
                        {!! $article->content !!}
                    </td>
                    <td>
                        {!! link_to('articles/' . $article->id, 'Show', ['class' => 'btn btn-info']) !!}
                        {!! link_to('articles/' . $article->id . '/edit', 'Edit', ['class' => 'btn btn-warning']) !!}
                        {{-- {!! link_to('articles/' . $article->id, 'Delete', ['class' => 'btn btn-danger', 'method' => 'DELETE', "onclick" => "return confirm('are you sure?')"]) !!} --}}
                        {!! Form::open(['route' => ['articles.destroy', $article->id], 'method' => 'DELETE']) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger', "onclick" => "return confirm('are you sure')"]) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div>
            {!! $articles->render() !!}
        </div>
    </div>
    <input id="direction" type="hidden" value="asc" />
</div>


{{-- <article class="row">
    <h1>{!! $article->title !!}</h1>
    <p>
        {!! str_limit($article->content, 250) !!}
        {!! link_to(route('articles.show', $article->id), 'Read More') !!}
    </p>
</article> --}}