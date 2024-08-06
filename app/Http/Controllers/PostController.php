<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function postIndex() {
        $posts = Post::with('user', 'category', 'views')->latest()->paginate(10);
        return view('posts.index', compact('posts'));
    }

    public function postShow(Post $post) {
        return view('posts.show', compact('post'));
    }

    public function postCreate() {
        return view('posts.create');
    }

    public function postStore(Request $request) {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'category_id' => 'required',
            'thumbnail' => 'required|image',
        ]);

        $thumbnail = $request->file('thumbnail')->store('thumbnails');

        $post = new Post($request->all());
        $post->user_id = auth()->id();
        $post->thumbnail = $thumbnail;
        $post->save();

        return redirect()->route('posts.index')->with('success', 'Post created successfully');
    }

    public function postEdit(Post $post) {
        return view('posts.edit', compact('post'));
    }

    public function postUpdate(Request $request, Post $post) {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'category_id' => 'required',
            'thumbnail' => 'sometimes|image',
        ]);

        if ($request->hasFile('thumbnail')) {
            $thumbnail = $request->file('thumbnail')->store('thumbnails');
            $post->thumbnail = $thumbnail;
        }

        $post->update($request->all());

        return redirect()->route('posts.index')->with('success', 'Post updated successfully');
    }

    public function postDestroy(Post $post) {
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Post deleted successfully');
    }
    
    public function commentDestroy(Comment $comment) {
    	$comment->delete();
    	return back()->with('success', 'Comment deleted successfully');
    }
    
}