<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Partner;
use App\Models\Post;
use Illuminate\Http\Request;
use Inertia\Inertia;
use PhpParser\Node\Expr\AssignOp\Pow;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Post/Index', [
            'posts' => Post::all(),
            'categories' => Category::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $post = Category::where('resource', 'post')->first();
        return Inertia::render('Post/Create', [
            'categories'=> Category::where('parent_id', $post ? $post->id : 0)->get()
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
        $this->validate($request, [
            'title'=> 'required',
            'short_desc'=> 'required',
            'is_active'=> 'required',
            'categories'=> 'required'
        ]);

        $post = Post::create([
            'title'=> $request->title,
            'description'=> $request->description,
            'short_desc'=> $request->short_desc,
            'image'=> $request->image,
            'link'=> $request->link,
            'is_active'=> $request->is_active,
            'user_id'=> Auth()->user()->id,
        ]);

        $post->categories()->attach($request->categories);

        return response()->json([
            'message'=> 'Запись сохранена!'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::with('categories')->find($id);
        $cat = Category::where('resource', 'post')->first();
        return Inertia::render('Post/Edit', [
            'categories' => Category::where('parent_id', $post ? $cat->id : 0)->get(),
            'post_data' => $post
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
        $this->validate($request, [
            'title'=> 'required',
            'short_desc'=> 'required',
            'is_active'=> 'required',
            'categories'=> 'required'
        ]);

        $post->update([
            'title'=> $request->title,
            'description'=> $request->description,
            'short_desc'=> $request->short_desc,
            'image'=> $request->image,
            'link'=> $request->link,
            'is_active'=> $request->is_active,
        ]);

        $post->categories()->sync($request->categories);

        return response()->json([
            'message' => 'Запись изменена!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Post $post)
    {

        try {
            $post->delete();
            return response()->json(['message' => 'Запись удалена!']);
        } catch (\Exception $e) {
            return response()->json($e);
        }

    }
}
