                <div id="article-list">
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
                    @foreach ($articles as $article)
                        <div>
                            <h1>
                                {!! $article->title !!}
                            </h1>
                            <p>
                                {!! $article->content !!}
                            </p>
                            <i>
                                By {!! $article->author !!}
                            </i>
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
                </div>