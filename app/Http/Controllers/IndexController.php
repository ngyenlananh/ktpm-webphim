<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Genre;
use App\Models\Country;
use App\Models\Movie;
use App\Models\Episode;

class IndexController extends Controller
{
    public function home(Request $request)
    {
        $category = Category::orderBy('id', 'DESC')->get();
        $genre = Genre::orderBy('id', 'DESC')->get();
        $country = Country::orderBy('id', 'DESC')->get();
        return view('pages.home', compact('category', 'genre', 'country'));
    }

    public function category($slug)
    {
        return view('pages.category');
    }

    public function genre()
    {
        return view('pages.genre');
    }

    public function country()
    {
        return view('pages.country');
    }

    public function movie()
    {
        // Lấy danh sách phim để sử dụng
        $movies = Movie::orderBy('id', 'DESC')->take(12)->get();
        return view('pages.movie', compact('movies'));
    }

    public function watch()
    {
        return view('pages.watch');
    }

    public function episode()
    {
        // Lấy danh sách tập phim để sử dụng
        $episodes = Episode::all();
        return view('pages.episode', compact('episodes'));
    }
}