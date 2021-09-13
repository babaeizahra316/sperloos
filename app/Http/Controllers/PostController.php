<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    public function __construct()
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::all(['id','user_id','title','thumbnail','content']);
        return response(['status_code'=>200,'status_text'=>'success','data'=>$posts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(User $user)
    {
        if (Gate::forUser($user)->allows('create', Post::class))
        {
            return response(['status_code'=>200,'status_text'=>'success','data'=>null]);
        }
        abort(403);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(User $user, Request $request)
    {
        if (Gate::forUser($user)->allows('create', Post::class))
        {
            $data = $request->validate([
                'user_id'=>['required'],
                'title'=>['required'],
                'thumbnail'=>['required', 'image'],
                'content'=>['required']
            ]);
            $post = $user->posts()->create($data);
            return response(['status_code'=>200,'status_text'=>'success','data'=>$post]);
        }
        abort(403);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return response(['status_code'=>200,'status_text'=>'success','data'=>$post]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user, Post $post)
    {
        if (Gate::forUser($user)->allows('update', $post))
        {
            return response(['status_code'=>200,'status_text'=>'success','data'=>null]);
        }
        abort(403);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(User $user, Post $post, Request $request)
    {
        if (Gate::forUser($user)->allows('update', $post))
        {
            $post->update($request->all());
            return response(['status_code'=>200,'status_text'=>'success','data'=>$post]);
        }
        abort(403);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user, Post $post)
    {
        if (Gate::forUser($user)->allows('delete', $post))
        {
            $post->destroy();
            return response(['status_code'=>200,'status_text'=>'success','data'=>null]);
        }
        abort(403);
    }
}
