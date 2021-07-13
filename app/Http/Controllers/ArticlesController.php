<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Modules\parser\ParserStarter;

class ArticlesController extends Controller
{
    public function index() {
        $requestData = request()->only(['siteUrl', 'articleSelector', 'countOfArticles', 'lazyLoadOfArticles']);
        $starterInstance = new ParserStarter(...array_values($requestData));
        return response()->json(['jsonFileName' => $starterInstance->fileName]);
    }
}
