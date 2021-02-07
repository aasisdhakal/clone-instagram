<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class PostController extends Controller
{
   
    public function index(Post $post)
    {
		$posts = $post->paginate(getPerPage());
		
	    return $this->setPagination($posts)->respond(PostResource::collection($posts));
	
    }
    
    public function show(Post $post , $id)
    {
	    $post = $post->findorfail($id);
	
	    return $this->respond(new PostResource($post));
    }
	
	/**
	 * Store a newly created resource in storage.
	 *
	 * @param PostRequest $request
	 * @param Post $post
	 * @param User $user
	 *
	 * @return \Illuminate\Http\JsonResponse
	 * @throws \Illuminate\Auth\Access\AuthorizationException
	 */
    public function create(PostRequest $request , Post $post , User $user)
    {
	
	    $validated = $request->validated();
	
	    $validated['user_id'] = JWTAuth::user()->id;
	
	    $post = $post->create($validated);
	    
	    return $this->setMessage('Post successfully created')->created(new PostResource($post));
	    
	    $this->authorize('store', $post);
    
    }
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(PostRequest $request, Post $post , $id)
    {
	    $post = $post->findorfail($id);
	
	    $post->update($request->validated());
	
	    return $this->updated(new PostResource($post));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Post $post , $id)
    {
	    $post = $post->findOrFail($id);
	    $post->delete();
	    return $this->deleted();
	
    }
}
