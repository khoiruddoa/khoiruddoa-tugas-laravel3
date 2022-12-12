<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
//menghubungkan controller ke model
class PostController extends Controller
{
    public function index()
    {
        $title = '';
        if (request('category')) {
            $category = Category::firstWhere('slug', request('category'));
            $title = ' in ' . $category->name;
        }
        if (request('author')) {
            $author = User::firstWhere('name', request('author'));
            $title = ' by' . $author->name;
        }
        return view('posts', [
            "title" => "All Posts" . $title,
            "active" => 'posts',
            //"posts" => Post::all() untuk all
            "posts" => Post::latest()->filter(request(['search', 'category', 'author']))->paginate(7)->withQueryString() //untuk menampilkan data paling akhir dan pagination
        ]);
    }
    //with(['user', 'category']) untuk mengatasi problem N+1. with juga bisa diletakkan di model

    public function show(Post $post) //method show yang menerima parameter slug dari route
    {

        return view('post', [
            "title" => "blog",
            "active" => 'posts',
            "post" => $post
        ]);
    }
}
