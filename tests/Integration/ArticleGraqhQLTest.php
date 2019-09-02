<?php

namespace Tests\Integration;

use Tests\TestCase;
use App\User;
use App\Article;

class ArticleGraphQLTest extends TestCase
{

    
    public function testCanGetArticles() {
        $user = factory(User::class)->create();
        $articles = factory(Article::class, 2)->create([
            'user_id' => $user->id
        ]);
        
        $this->query('articles', ['id','title'])
            ->assertJsonFragment(['id' => (string)$articles[0]->id,'title' => (string)$articles[0]->title])
            ->assertJsonFragment(['id' => (string)$articles[1]->id,'title' => (string)$articles[1]->title]);
    }

    public function testCanGetArticleWithAuthor() {

        $user = factory(User::class)->create();
        $article = factory(Article::class)->create([
            'user_id' => $user->id
        ]);
        
        $this->query('article', ['id' => $article->id], ['id', 'title','content', 'author' => ['id', 'name','email']])
            ->assertJsonFragment(['title' => $article->title])
            ->assertJsonFragment([
                'id' => (string) $user->id,
                'name' => $user->name,
                'email' => $user->email,
            ]);
    }

    public function testCanCreateArticle() {

        $user = factory(User::class)->create();

        $params =  [
            'user_id' => $user->id,
            'title' => $this->faker->sentence,
            'content' => $this->faker->paragraphs(1,true),
        ];
        
        $this->mutation('createArticle', $params, [ 'title', 'content'])
            ->assertJsonFragment([
                'title' => $params['title'],
                'content' => $params['content'],
            ]);
    }

    public function testCanUpdateArticle()
    {

        $user = factory(User::class)->create();
        $article = factory(Article::class)->create([
            'user_id' => $user->id
        ]);

        $params =  [
            'id' => $article->id,
            'title' => "Test",
            'content' => $article->content
        ];
        
        $this->mutation('updateArticle', $params, [ 'title', 'content'])
            ->assertJsonFragment([
                'title' => $params['title'],
                'content' => $params['content'],
            ]);
    }

    public function testCanDeleteArticle()
    {

        $user = factory(User::class)->create();
        $article = factory(Article::class)->create([
            'user_id' => $user->id
        ]);

        $params =  [
            'id' => $article->id
        ];
        
        $this->mutation('deleteArticle', $params, [ 'title', 'content'])
            ->assertJsonFragment([
                'title' => $article->title,
                'content' => $article->content,
            ]);
    }



    
    
}