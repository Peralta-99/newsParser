<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Modules\parser\ParserStarter;

class ArticlesController extends Controller
{
    public function index() {
        $requestData = request()->only(['siteUrl', 'articleSelector', 'countOfArticles', 'lazyLoadOfArticles']);
        $starterInstance = new ParserStarter(...array_values($requestData));
        return response()->json(['jsonFileName' => $starterInstance->fileName]);
    }

    public function getScrapedArticles(Request $request, $fileName) {
        return view('articles.index')
            ->with('articles', Article::where('pulled_from_the_file', $fileName . '.json')->get());
    }

    public function getFullArticle(Request $request, $ArticleId) {
        return view('articles.show')
            ->with('articleData', Article::find($ArticleId));
    }
}
