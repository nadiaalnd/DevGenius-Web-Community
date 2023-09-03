<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Forum;
use Illuminate\Support\Str;
use App\Models\ForumThread;

class IndexController extends Controller
{
    public function index()
    {
        return view('home.pages.index');
    }

    public function about()
    {
        return view('home.pages.about');
    }

    public function forum()
    {
        $data = Forum::all()->sortByDesc('created_at');
        return view('home.pages.forum', compact('data'));
    }

    public function forumCreate()
    {
        return view('home.pages.forum-create');
    }

    public function forumStore(Request $request)
    {
        if (auth()->guest()) {
            return redirect()->route('login');
        }
        $request->validate([
            'title' => 'required',
            'content' => 'required'
        ]);

        Forum::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title) . '-' . time(),
            'user_id' => auth()->user()->id,
            'content' => $request->content
        ]);

        return redirect()->route('forum');
    }

    public function ckeditorUpload(Request $request)
    {
        if (auth()->guest()) {
            return redirect()->route('login');
        }
        $request->validate([
            'upload' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $imageName = time() . '.' . $request->upload->extension();

        $request->upload->move(public_path('images'), $imageName);

        $CKEditorFuncNum = $request->input('CKEditorFuncNum');
        $url = asset('images/' . $imageName);
        $msg = 'Image uploaded successfully';
        $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";

        @header('Content-type: text/html; charset=utf-8');
        echo $response;
    }

    public function forumShow($slug)
    {
        $forum = Forum::where('slug', $slug)->first();
        return view('home.pages.forum-show', compact('forum'));
    }

    public function forumReply($slug, Request $request)
    {
        if (auth()->guest()) {
            return redirect()->route('login');
        }
        $checkIfForumExist = Forum::where('slug', $slug)->first();
        if (!$checkIfForumExist) {
            return redirect()->route('forum');
        }
        $request->validate([
            'content' => 'required'
        ]);
        ForumThread::create([
            'forum_id' => Forum::where('slug', $slug)->first()->id,
            'user_id' => auth()->user()->id,
            'content' => $request->content
        ]);

        return redirect()->back();
    }
}
