<?php

namespace App\Http\Controllers\Admin;

use Sentinel;
use Session;
use App\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;
use App\Http\Requests\ExcelArticleRequest;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade as PDF;
use Maatwebsite\Excel\Facades\Excel;

class ArticlesController extends Controller
{
    /**
     * Article model instance
     */
    private $article;

    /**
     * Controller initiator
     */
    public function __construct(Article $article)
    {
        $this->article = $article;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $userId = Sentinel::getUser()['original']['id'];
        if ($request->ajax()) {
            if ($request->keywords) {
                $articles = Article::where('users_id', $userId)
                    ->where('title', 'like', '%' . $request->keywords . '%')
                    ->where('content', 'like', '%' . $request->keywords . '%')
                    ->paginate(10);
            } elseif ($request->direction) {
                $articles = Article::where('users_id', $userId)
                            ->orderBy('id', $request->direction)
                            ->paginate(10);
                $request->direction == 'asc' ? 
                        $direction = 'desc' : 
                        $direction = 'asc';
                $view = (string) view('articles._list')
                        ->with('articles', $articles)
                        ->render();

                return response()->json(['view' => $view, 'direction' => $direction]);
            } else {
                $articles = Article::where('users_id', $userId)->paginate(10);
            }

            $view = (string) view('articles._list')
                    ->with('articles', $articles)
                    ->render();
            return response()->json(['view' => $view]);
        } else {
            $articles = Article::where('users_id', $userId)->paginate(10);
            return view('articles.index')
                    ->with('articles', $articles);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $article = Article::all();
        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequest $request)
    {
        $data = [
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'users_id' =>  Sentinel::getUser()['original']['id']
        ];

        Article::create($data);
        Session::flash('notice', 'Article success created');
        return redirect()->route('articles.index');
    }

    /**
     * Storing via uploading excel file
     */
    public function storeExcel(ExcelArticleRequest $request)
    {
        $data = [];
        Excel::load($request->file('excel'), function ($reader) use (&$data) {
            foreach ($reader->toArray()[0] as $key => $value) {
                $data[$key] = str_replace('_', ' ', $value);
            }
        });

        $this->article->title = $data['title'];
        $this->article->content = $data['content'];
        $this->article->users_id = Sentinel::getUser()['original']['id'];
        $this->article->save();

        Session::flash('notice', 'Article success created');
        return redirect()->route('articles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = Article::find($id);
        $comment = Article::find($id)->comments->sortBy('Comment.created_at');

        return view('articles.show')
                ->with('article', $article)
                ->with('comments', $comment);
    }

    public function showExportExcel($id)
    {
        $article = Article::find($id);
        $comments = Article::find($id)->comments->sortBy('Comment.created_at');

        // Begin Excel
        $excelFilename = $article->title . '-id-' . $article->id;
        $excelFile = Excel::create('Article Export to Excel', function ($excel) use ($article, $comments) {
            $excel->sheet('Sheet 1', function ($sheet) use ($article, $comments) {
                $excelData = [
                    $article->id,
                    $article->title,
                    $article->content,
                ];
                $sheet->appendRow(1, $excelData);

                // set counter to get new line
                $counter = 1;
                foreach ($comments as $comment) {
                    $excelData = [
                        $article->id,
                        $article->title,
                        $article->content,
                        $comment->id,
                        $comment->content,
                        $comment->user,
                    ];

                    $sheet->appendRow($counter, $excelData);
                    $counter++;
                }
                $headings = array('Article Id', 'Article Title', 'Article Content', 'Comment Id', 'Comment Content', 'Comment User');
                $sheet->prependRow(1, $headings);
            });
        })->export('xls');
        // return response()->download($excelFile, $pdfFilename);
    }

    /**
     * Export specified resource to pdf
     */
    public function showExportPdf($id)
    {
        $article = Article::find($id);
        $comments = Article::find($id)->comments->sortBy('Comment.created_at');

        // Setup Content
        $content = "<div style='text-align:left;'><p><small>article id: {$article->id}</small></p><h2>Title: {$article->title}</h2><p>Content: {$article->content}</p><h4>Comment list</h4><ul>";

        foreach ($comments as $comment) {
            $content .= "<li>Id: " . $comment->id . "</li>";
            $content .= "<li>Content: " . $comment->content . "</li>";
            $content .= "<li>User: " . $comment->user . "</li><br/><br/>";
        }

        $content .= "</ul></div>";

        // Setup PDF
        $pdf = PDF::loadHTML($content);
        $pdfFilename = $article->title . '-id-' . $article->id . '.pdf';

        Storage::disk('pdf')->put($pdfFilename, $pdf->stream());

        return response()->download(public_path() . '/pdf/' . $pdfFilename, $pdfFilename, ['Content-Type' => 'application/pdf']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = Article::find($id);
        return view('articles.edit')->with('article', $article);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleRequest $request, $id)
    {
        Article::find($id)->update($request->all());
        Session::flash('notice', 'Article success updated');
        return redirect()->route('articles.show', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Article::destroy($id);
        Session::flash('notice', 'Article success deleted');
        return redirect()->route('articles.index');
    }
}
