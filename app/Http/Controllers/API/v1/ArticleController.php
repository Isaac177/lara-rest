<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\ArticleCollection;
use App\Http\Resources\V1\ArticleResource;
use App\Models\Article;
use http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ArticleController extends Controller
{

    public function index()
    {
        return ArticleResource::collection(Article::with('author')->get());
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            /*'title' => ['required', 'max:20', 'unique:articles, title'],
            'body' => ['required', 'min:5'],*/
            'title' => ['required', 'max:20', Rule::unique('articles', 'title')->ignore($request->id)],
            'body' => ['required', 'min:5'],
        ]);

        $article = Article::create([
            'title' => $request->input('title'),
            'body' => $request->input('body'),
            'slug' => Str::slug($request->input('title')),
            'author_id' => auth()->id() ?? 1,
        ]);

        return (new ArticleResource($article))
            ->response()
            ->setStatusCode(201);
    }


    public function show(Article $article)
    {
        return (new ArticleResource($article))->response()->setStatusCode(200);

    }
    public function update(Request $request, Article $article)
    {
        $this->validate($request, [
            'title' => ['sometimes', 'max:20', Rule::unique('articles')->ignore($article->title, 'title')],
            'body' => ['required', 'min:5'],
        ]);

        $article->update([
            'title' => $request->input('title'),
            'body' => $request->input('body'),
            'slug' => Str::slug($request->input('title')),
        ]);

        return (new ArticleResource($article))
            ->response()
            ->setStatusCode(200);
    }


    public function destroy(Article $article)
    {
        $article->delete();
        return response()->json(null, 204);
    }
}
