<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function createPost(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        $post = new Post();
        $post->title = $request->title;
        $post->body = $request->body;
        $post->user_id = Auth::id();
        $post->save();

        return back()->with('success', 'Post created successfully!');
    }

    public function showEditForm($id)
    {
        $post = Post::findOrFail($id);
        
        // Check if user owns the post
        if ($post->user_id !== Auth::id()) {
            return back()->with('error', 'You are not authorized to edit this post.');
        }
        
        return view('edit-post', ['post' => $post]);
    }

    public function updatePost(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        
        // Check if user owns the post
        if ($post->user_id !== Auth::id()) {
            return back()->with('error', 'You are not authorized to update this post.');
        }
        
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);
        
        $post->title = $request->title;
        $post->body = $request->body;
        $post->save();
        
        return redirect('/')->with('success', 'Post updated successfully!');
    }

    public function deletePost($id)
    {
        $post = Post::findOrFail($id);
        
        // Check if user owns the post
        if ($post->user_id !== Auth::id()) {
            return back()->with('error', 'You are not authorized to delete this post.');
        }
        
        $post->delete();
        
        return back()->with('success', 'Post deleted successfully!');
    }

    public function showHome()
    {
        $posts = Post::with('user')->latest()->get();
        return view('home', ['posts' => $posts]);
    }
}