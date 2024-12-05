<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;

class PublicController extends Controller
{


    public function index(User $user)
    {
        // On récupère les articles publiés de l'utilisateur
        $articles = Article::where('user_id', $user->id)->where('draft', 0)->get();
    
        // On retourne la vue
        return view('public.index', [
            'articles' => $articles,
            'user' => $user
        ]);
    }

    public function show(User $user, Article $article)
{
    // $user est l'utilisateur de l'article
    // $article est l'article à afficher

    // Je vous laisse faire le code
    // N'oubliez pas de vérifier que l'article est publié (draft == 0)
    if ($article -> draft == 0)
    {
         return redirect()->route('dashboard')->with('error', 'cet article est privé !');
    }
    //si aucun article renvoyer au dashboard avec message d'erreur.
     else if ($article === null)
     {
        return redirect()->route('dashboard')->with('error', 'aucun article pour cet utilisateur');
     }
    return view('public.show', [
        'article' => $article
    ]);
}

}
