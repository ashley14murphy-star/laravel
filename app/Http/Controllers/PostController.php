<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // READ: Ipakita ang lahat ng posts
    public function index()
    {
        $posts = Post::latest()->get();
        return view('posts.index', compact('posts'));
    }

    // CREATE: Ipakita ang form para sa paggawa ng post
    public function create()
    {
        return view('posts.create');
    }

    // STORE: I-save ang bagong post sa database
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        Post::create($request->all());

        return redirect()->route('posts.index')->with('success', 'Post created successfully!');
    }

    // EDIT: Ipakita ang form para sa pag-edit
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    // UPDATE: I-save ang binagong data
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        $post->update($request->all());

        return redirect()->route('posts.index')->with('success', 'Post updated successfully!');
    }

    // DELETE: Burahin ang post sa database
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post deleted successfully!');
    }
}