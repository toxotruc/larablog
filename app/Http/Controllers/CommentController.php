<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function storeComm(Request $request) 
    {
        if(!Auth::check())
        {
            return redirect()->back()->with('error', 'Vous devez être connecté !');
        }
        if($request->input('commentaire') == null && $request->input('articleId') == null)
        {
            return redirect()->back()->with('error', 'commentaire non conforme !');
        }
        Comment::create([
            'content' => $request->input('commentaire'),
            'article_id' => $request->input('articleId'),
            'user_id' => Auth::user()->id
        ]);
        return redirect()->back();

    }
}