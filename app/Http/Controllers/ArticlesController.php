<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Modules\parser\ParserStarter;

class ArticlesController extends Controller
{
    public function index() {
        $requestData = request()->only(['siteUrl', 'articleSelector', 'countOfArticles', 'lazyLoadOfArticles']);
        new ParserStarter(...array_values($requestData));
        return view('articles.index')
            ->with('articles', (Article::query())->limit($requestData['countOfArticles']));
    }
}
