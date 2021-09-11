<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\News;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;

class NewsController extends Controller
{
    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        $qb = DB::table('news');
        $qb->where('is_favorite', true);
        $qb->orderBy('created_at', 'desc');
        $favoriteNews = $qb->get();

        $favoriteClientNewsIdArray = $request->cookie('favoriteNews');
        $favoriteClientNewsArray = [];
        if (is_array($favoriteClientNewsIdArray) && count($favoriteClientNewsIdArray) > 0) {
            foreach ($favoriteClientNewsIdArray as $key => $value) {
                $favoriteClientNewsArray[] = News::query()->findOrFail($key);
            }
        }

        return view('news.index', [
            'favoriteNews' => $favoriteNews,
            'favoriteClientNews' => $favoriteClientNewsArray,
        ]);
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function list(Request $request)
    {
        $cityId = $request->input('cityId');
        $search = $request->input('search');

        $qb = DB::table('news');

        if ($search !== null) {
            $qb->where('title', 'like',  '%' . $search . '%');
        }
        if ($cityId !== null) {
            $qb->orWhere('city_id', $cityId);
        }
        $qb->orderBy('created_at', 'desc');

        $city = $cityId !== null ? City::query()->find($cityId) : null;

        return view('news.list', [
            'cities' => City::all(),
            'news' => $qb->get(),
            'selectCity' => $city,
            'favoriteClientNewsIdArray' => $request->cookie('favoriteNews') ?? [],
        ]);
    }

    /**
     * @param int $id
     * @return Application|Factory|View
     */
    public function show(int $id)
    {
        $news = News::query()->findOrFail($id);

        $qb = DB::table('news');
        $qb->where('city_id', $news->city_id);
        $qb->where('id', '!=', $news->id);

        return view('news.show', [
            'news' => $news,
            'similarNews' => $qb->get(),
        ]);
    }

    /**
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function addFavorite(Request $request)
    {
        $favoriteNewsId = $request->input('favoriteNewsId');
        $cookie = cookie('favoriteNews[' . $favoriteNewsId . ']', null, 3600*30);

        return redirect("/news")->cookie($cookie);
    }

    /**
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function delFavorite(Request $request)
    {
        $favoriteNewsId = $request->input('favoriteNewsId');
        $cookie = cookie('favoriteNews[' . $favoriteNewsId . ']', null, -3600*30);

        return redirect("/")->cookie($cookie);
    }
}
