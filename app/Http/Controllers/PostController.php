<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function create() 
    {

        $posts = Post::latest()->get();
        return view('post.index', compact(''));
        return vew('post.create');
    }

    public function store (Request $request)
    {
        $this ->validate($request, [
            'title' => 'required',
            'content' => 'required',
            ]);

            $posts = Post::create([
                'title' => $request->title,
                'content' => $request->content,
                'status' => $request->status,
                'slug' => Str::slug($request->title)
                ]);
                
            if ($posts) {
                return redirect()
                ->route('post.index')
                ->with([
                    'succes' => 'New post has been created successfully'
                ]);
            }else {
                return redirect()
                ->back()
                ->withInput()
                ->with([
                    'error' => 'Some problem occoured, please try again'
                    ]);
            }

           
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('post.edit', compact('post'));
    }
}
