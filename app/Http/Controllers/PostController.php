<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Phone;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();

        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'surname' => 'required|max:255',
        ]);

        $post = new Post([
            'name' => $request->get('name'),
            'surname' => $request->get('surname'),
           //'number' => implode('|', $request->get('phone')),

        ]);

        $post->save();
        foreach ($request->get('phone') as $phone) {


                $post->phones()->insert(['number' => $phone, 'post_id' => $post->id]);

        }



        return redirect('/posts')->with('success', 'Запись добавлена');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);

        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);

        return view('posts.edit', compact('post'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
            'surname' => 'required|max:255',
            'phone' => 'required',
        ]);

        $post = Post::find($id);
        $post->name = $request->get('name');

        $post->surname = $request->get('surname');



          $post->fill($request->only('name'));
          $post->phones()->delete();
          foreach ($request->get('phone') as $phone) {

              Phone::create([
                  'post_id' => $post->id,
                  'number' => $phone
              ]);
          }
           $post->save();

        return redirect('/posts')->with('success', 'Запись отредактирована');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();

        return redirect('/posts')->with('success'. 'Запись удалена');
    }
}
