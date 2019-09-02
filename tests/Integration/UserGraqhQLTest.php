<?php

namespace Tests\Integration;

use Tests\TestCase;
use App\User;
use App\Article;

class UserGraphQLTest extends TestCase
{
    public function testCanGetUsers() {
        $users = factory(User::class, 2)->create();
        
        $this->query('users', ['id'])
            ->assertJsonFragment(['id' => (string)$users[0]->id])
            ->assertJsonFragment(['id' => (string)$users[1]->id]);
    }

    public function testCanGetUserWithArticles() {

        $user = factory(User::class)->create();
        $articles = factory(Article::class, 2)->create([
            'user_id' => $user->id
        ]);
        
        $this->query('user', ['id' => $user->id], ['id', 'name', 'articles' => ['id', 'title','content']])
            ->assertJsonFragment(['name' => $user->name])
            ->assertJsonFragment([
                'id' => (string) $articles[0]->id,
                'title' => $articles[0]->title,
                'content' => $articles[0]->content,
            ])
            ->assertJsonFragment([
                'id' => (string) $articles[1]->id,
                'title' => $articles[1]->title,
                'content' => $articles[1]->content,
            ]);
    }

    public function testCanCreateUser() {

        $password = 'secret123';

        $params =  [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'password' => $password,
        ];
        
        $this->mutation('createUser', $params, [ 'name', 'email'])
            ->assertJsonFragment([
                'name' => $params['name'],
                'email' => $params['email'],
            ]);
    }

    public function testCanUpdateUser(){
        $user = factory(User::class)->create();

        $params =  [
            'id' => $user->id,
            'name' => "Test User",
            'email' => $this->faker->email,
            'password' => $user->password
        ];
        
        $this->mutation('updateUser', $params, [ 'name', 'email'])
            ->assertJsonFragment([
                'name' => $params['name'],
                'email' => $params['email'],
            ]);
    }

    public function testCanDeleteUser(){
        $user = factory(User::class)->create();

        $params =  [
            'id' => $user->id
        ];
        
        $this->mutation('deleteUser', $params, [ 'name', 'email'])
            ->assertJsonFragment([
                'name' => $user->name,
                'email' => $user->email,
            ]);
    }



    
    
}