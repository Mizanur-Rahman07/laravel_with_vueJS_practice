<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Notifications\PostCreated;
use Flasher\Prime\FlasherInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('post.post', [
            'posts' => $posts,
        ]);
    }

    public function addPost(Request $request, FlasherInterface $flasher)
    {
        $request->validate(
            [
                'title' => 'required',
                'content' => 'required'
            ],
            [
                'title.required' => 'Please fill in the Title',
                'content.required' => 'Please fill in the Content'
            ]
        );

        $post = new Post();
        $post->title = $request->title;
        $post->date = now();
        $post->content = $request->content;
        $post->save();

        $user = Auth::user();
        $user->notify(new PostCreated($post));



        flash()->addSuccess('Your Post has been submitted.');

        return redirect()->route(route: 'dashboard');
    }

    public function editPost($id, FlasherInterface $flasher)
    {
        $post = Post::find($id);
        if (empty($post)) {
            $flasher()->addError('Post Not Found');
            return redirect()->route(route: 'dashboard');
        }
        return view('post.edit-post', [
            'post' => Post::find($id)
        ]);
    }

    public function updatePost(Request $request, FlasherInterface $flasher)
    {
        $request->validate(
            [
                'title' => 'required',
                'content' => 'required'
            ],
            [
                'title.required' => 'Please fill in the Title',
                'content.required' => 'Please fill in the Content'
            ]
        );
        $post = Post::find($request->post_id);

        $post->title = $request->title;
        $post->content = $request->content;
        $post->save();

        flash()->addSuccess('Your Post has been Updated.');
        return redirect()->route(route: 'dashboard');
    }

    public function deletePost(Request $request, FlasherInterface $flasher)
    {
        $post = Post::find($request->post_id);
        $post->delete();
        flash()->addSuccess('Your Post has been Deleted.');
        return redirect()->route(route: 'dashboard');
    }
}