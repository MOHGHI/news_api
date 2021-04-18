<?php


namespace App\Http\Controllers\Api;


use App\Http\Paginate\Paginate;
use App\Http\Requests\Api\CreateNews;
use App\Http\Requests\Api\DeleteNews;
use App\Http\Requests\Api\UpdateNews;
use App\Http\Transformers\NewsTransformer;
use App\Models\News;

class NewsController extends ApiController
{
    /**
     * NewsController constructor.
     *
     * @param NewsTransformer $transformer
     */
    public function __construct(NewsTransformer $transformer)
    {
        $this->transformer = $transformer;

        $this->middleware('auth.api')->except(['index', 'show']);
        $this->middleware('auth.api:optional')->only(['index', 'show']);
    }

    /**
     * Get all the newss.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $news = new Paginate(News::where('id', '>', 0));

        return $this->respondWithPagination($news);
    }

    /**
     * Create a new news and return the news if successful.
     *
     * @param CreateNews $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateNews $request)
    {
        $user = auth()->user();

        $news = $user->news()->create([
            'title' => $request->input('news.title'),
            'body' => $request->input('news.body'),
        ]);

        return $this->respondWithTransformer($news);
    }

    /**
     * Get the news given by its slug.
     *
     * @param News $news
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(News $news)
    {

        return $this->respondWithTransformer($news);
    }

    /**
     * Update the news given by its slug and return the news if successful.
     *
     * @param UpdateNews $request
     * @param News $news
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateNews $request,News $news)
    {
        if ($request->has('news')) {
            $news->update($request->get('news'));
        }

        return $this->respondWithTransformer($news);
    }

    /**
     * Delete the news given by its slug.
     *
     * @param DeleteNews $request
     * @param News $news
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(DeleteNews $request, News $news)
    {
        $news->delete();

        return $this->respondSuccess();
    }
}