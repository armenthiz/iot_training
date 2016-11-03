<?php

use App\Article;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ArticlesTest extends TestCase
{
    /**
     * This testing Controller Articles,
     * All action for Create, Update, Delete, Show
     */
    
    /**
     * Test Action Index
     */
    public function testArticleIndex()
    {
        $this->WithoutMiddleware();
        $this->call('GET', 'articles');
        $this->assertResponseOk(); // this equal with: $this->assertResponseStatus(200)
        $this->assertViewHas('articles');
    }

    /*
     * Test Action Create
     */
    public function testArticleCreate()
    {
        $this->call('GET', 'articles/create');
        $this->assertResponseStatus(302); // Redirect from middleware
    }

    /**
     * Test Action Store (With Fails Schema)
     */
    public function testArticleStoreFails()
    {
        $data = [
            'title' => '',
            'content' => 'Lorem ipsum dolor sit amet, consectetur adispicingi elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
            // 'author' => 'Ujang'
        ];
        $post = $this->action('POST', 'Admin\ArticlesController@store', $data);
        $this->assertRedirectedToRoute('articles.create');
    }

    /*
     * Test Action Store (With Success Schema)
     */
    public function testArticleStoreSuccess()
    {
        $data = [
            'title' => 'Testing Article title' . str_random(10),
            'content' => str_random(10) . ' Lorem ipsum dolor sit amet, consectetur adispicingi elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
            // 'author' => 'ujang',
        ];
        $post = $this->action('POST', 'Admin\ArticlesController@store', $data);
        $this->assertResponseStatus(302);
        $this->assertRedirectedToRoute('articles.index');
        $this->assertSessionHas('flash');
    }

    /**
     * Test Action Show
     */
    public function testArticleShow()
    {
        $article = Article::where('title', 'like', '%Testing Article title%')->first();
        if (empty($article)) {
            $data = [
                'title' => 'Testing Article title',
                'content' => 'Lorem ipsum dolor sit amet, consectetur adispicingi elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                // 'author' => 'ujang'
            ];

            $post = $this->action('POST', 'Admin\ArticlesController@store', $data);
        }

        $this->action('GET', 'Admin\ArticlesController@show', $article->first()->id);
        $this->assertResponseOk();
    }

    /*
     * Test Action Edit
     */
    public function testArticleEdit()
    {
        $article = Article::where('title', 'like', '%Testing Article title%')->first();
        if (empty($article)) {
            $data = [
                'title' => 'Testing Article title',
                'content' => 'Lorem ipsum dolor sit amet, consectetur adispicingi elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua',
                // 'author' => 'Ujang',
            ];

            $post = $this->action('POST', 'Admin\ArticlesController@store', $data);
        }

        $this->action('GET', 'Admin\ArticlesController@edit', $article->first()->id);
        $this->assertResponseOk();
    }

    /**
     * Test Action Update (With Fails Schema)
     */
    public function testArticleUpdateFails()
    {
        $data = [
            'title' => 'Testing Article title',
            'content' => 'Lorem ipsum dolor sit amet, consectetur adispicingi elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua',
            // 'author' => 'Ujang',
        ];
        $post = $this->action('POST', 'Admin\ArticlesController@store', $data);
        $article = Article::where('title', 'like', '%Testing Article title%')->first();
        $update_data = [
            'title' => '',
            'content' => 'Lorem ipsum dolor sit amet, consectetur adispicingi elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua',
            // 'author' =>  'Ujang',
        ];

        $this->call('PUT', 'articles/' . $article->first()->id, $update_data);
        $this->assertRedirectedToRoute('articles/' . $article->first()->id . '/edit');
    }

    /**
     * Test Action Update (With Success Schema)
     */
    public function testArticleUpdateSuccess()
    {
        $article = Article::where('title', 'like', '%Testing Article title%')->first();
        if (empty($article)) {
            $data = [
                'title' => 'Testing Article title',
                'content' => 'Lorem ipsum dolor sit amet, consectetur adispicingi elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua',
                // 'author' => 'Ujang',
            ];

            $post = $this->action('POST', 'Admin\ArticlesController@store', $data);
        }

        $update_data = [
            'title' => 'Edit Article testing' . str_random(10),
            'content' => str_random(10) . 'Lorem ipsum dolor sit amet, consectetur adispicingi elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua',
            // 'author' => 'Ujang',
        ];
        $this->call('PUT', 'articles/' . $article->first()->id, $update_data);
        $this->assertRedirectedToRoute('articles');
        $this->assertSessionHas('flash');
    }
}