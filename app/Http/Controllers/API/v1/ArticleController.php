<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\ArticleCollection;
use App\Http\Resources\V1\ArticleResource;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{

    public function index()
    {
        return ArticleResource::collection(Article::with('author')->get());
    }

    public function store(Request $request)
    {
        //
    }


    public function show(Article $article)
    {
        return (new ArticleResource($article))->response()->setStatusCode(200);

    }
    public function update(Request $request, Article $article)
    {
        //
    }


    public function destroy(Article $article)
    {
        //
    }
}
