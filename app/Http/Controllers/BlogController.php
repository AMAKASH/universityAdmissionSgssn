<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function discussion_index()
    {
        $blogs =  Blog::where('type', 'discussion')->get();


        return view('discussion.index', ['blogs' => $blogs]);
    }

    public function discussion_show(Blog $blog)
    {

        return view('discussion.show', ['blog' => $blog]);
    }

    public function discussion_delete(Blog $blog)
    {
        if ($blog->user_id != auth()->user()->id) {
            abort(403, "You do not have permission to modify this resource");
        }

        $blog->delete();

        return redirect()->route('discussion.index');
    }

    public function discussion_create()
    {
        $blog = new Blog();
        $blog->title = request('title');
        $blog->category = request('category');
        $blog->content = request('content');
        $blog->user_id = auth()->user()->id;
        $blog->type = "discussion";
        //dd($blog);
        $blog->save();
        return redirect()->route('discussion.index');
    }
}
