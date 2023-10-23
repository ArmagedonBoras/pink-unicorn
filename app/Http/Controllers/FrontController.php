<?php

namespace App\Http\Controllers;

use App\Models\Link;
use App\Models\Article;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function show()
    {
        $articles = [];
        $list = Article::latest()->get();
        foreach ($list as $article) {
            if ($article->isAuthorized()) {
                $articles[] = $article;
            }
        }
        $links = Link::orderBy('sort_order')->get();
        return view('front', ['articles' => $articles, 'links' => $links]);
    }
}
