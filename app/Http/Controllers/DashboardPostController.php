<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class DashboardPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.posts.index', [
            'posts' => Post::where('user_id', auth()->user()->id)->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.posts.create', [
            'categories' => Category::all()
        ]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //untuk menyimpan file secara sederhana
        // return $request->file('image')->store('post-images');
        //agar bisa diakses public. maka harus disetting dulu folder storage ke public di env dan confignya dan gunakan simbolic link



        //untuk validasi gambar

        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required', 'unique:posts',
            'category_id' => 'required',
            'image' => 'image|file|max:1024',
            'body' => 'required'
        ]);
        $validatedData['image'] = $request->file("image")->hashName();
        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['excerpt'] = Str::limit(strip_tags($request->body), 70);
        $file = $request->file("image");
        $file->move("image",  $validatedData['image']);
        Post::create($validatedData);
        return redirect('/dashboard/posts')->with('success', 'New Post has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        if ($post->user->id !== auth()->user()->id) {
            abort(403);
        }
        return view('dashboard.posts.show', [
            'post' => $post
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        if ($post->user->id !== auth()->user()->id) {
            abort(403);
        }
        return view('dashboard.posts.edit', [
            'post' => $post,
            'categories' => Category::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $rules = [
            'title' => 'required|max:255',
            'category_id' => 'required',
            'body' => 'required'

        ];
        if ($request->slug != $post->slug) {
            $rules['slug'] = 'required|unique:posts';
        }



        $validatedData = $request->validate($rules);
        if ($request->file('image')) {
            $validatedData['image'] = $request->file("image")->hashName();
        }
        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['excerpt'] = Str::limit(strip_tags($request->body), 70);
        if (null !== $request->file("image")) {
            $file = $request->file("image");
            $filename = $file->hashName();
            $file->move("image", $filename);
            $photo = $request->input("hidden");
            File::delete('image/' . $photo);
        }

        Post::where('id', $post->id)->update($validatedData);
        return redirect('/dashboard/posts')->with('success', 'Post has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {

        Post::destroy($post->id);
        return redirect('/dashboard/posts')->with('success', 'Post deleted!!');
    }


    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Post::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }
}
