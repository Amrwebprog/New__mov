<?php

namespace App\Http\Controllers;

use App\Models\Series;
use App\Http\Requests\StoreSeriesRequest;
use App\Http\Requests\StoreWhereGenreRequest;
use App\Http\Requests\StoreWhereSeriesRequest;
use App\Http\Requests\UpdateSeriesRequest;
use App\Models\Genre;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SeriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function new()
    {
        $new = Series::with('genre', 'country')->orderBy('id', 'desc')->limit(15)->get();
        if (count($new) != 0) {
            return $this->response(code: 200, data: $new);
        } else {
            return $this->response(code: 404);
        }
    }
    public function top_10()
    {
        $top_10 = Series::with('genre', 'country')->get()->where('top_10', true);
        if (count($top_10) != 0) {
            return $this->response(code: 200, data: $top_10);
        } else {
            return $this->response(code: 404);
        }
    }
    public function rate()
    {
        $series = Series::with('genre', 'country')->get()->where('rate', '>', '7.0');
        if (count($series) != 0) {
            return $this->response(code: 200, data: $series);
        } else {
            return $this->response(code: 404);
        }
    }
    public function genre($genre)
    {
        //get genre id
        $genre_id = Genre::get()->where('genre', $genre)->first()->id;
        //get serires where genre
        $series = Series::with('genre', 'country')->get()->where('genre_id', $genre_id);
        if ($series) {
            return $this->response(code: 200, data: $series);
        } else {
            return $this->response(code: 404);
        }
    }
    public function index()
    {
        $Series = Series::with('genre', 'country')->paginate(15);
        return $this->response(code: 200, data: $Series);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSeriesRequest $request, StoreWhereGenreRequest $genre)
    {
        //validate
        $request = $request->validated();
        $request['num_of_seasons'] = 0;
        //genre_id
        $genre = $genre->validated();
        $genre_id = Genre::all()->where('genre', $genre['genre'])->first()->id;
        $request['genre_id'] = $genre_id;
        //insert data
        $insert = Series::create($request);
        if ($insert) {
            return $this->response(code: 201, data: $insert);
        } else {
            return $this->response(code: 400, data: 'Can\'t create ');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Series $series)
    {
        $id = $series->id;
        $series = series::with('genre', 'seasons', 'country')->find($id);
        return $this->response(code: 200, data: $series);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Series $series)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSeriesRequest $request, StoreWhereSeriesRequest $Series, StoreWhereGenreRequest $genre)
    {
        //validate
        $request = $request->validated();
        $genre = $genre->validated();
        $Series = $Series->validated();
        //genre_id
        $genre_id = Genre::all()->where('genre', $genre['genre'])->first()->id;
        $request['genre_id'] = $genre_id;
        //Series_id
        $Series_id = Series::all()->where('series_name', $Series['series_name'])->first()->id;
        //update data
        $update = DB::table('series')->where('id', $Series_id)->update($request);
        //check if update
        if ($update) {
            return $this->response(code: 201, data: $update);
        } else {
            return $this->response(code: 201);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Series $series)
    {
        //
    }
    public function delete(Series $series)
    {
        $delete = $series->delete();
        return $this->response(code: 202, data: $delete);
    }
    public function deleted(Series $series)
    {
        $deleted = $series->onlyTrashed()->get();
        return $this->response(code: 302, data: $deleted);
    }
    public function restore($series)
    {
        $series = Series::withTrashed()->where('id', $series)->restore();
        return $this->response(code: 202, data: $series);
    }
    public function delete_from_trash($series)
    {
        $series = Series::where('id', $series)->forceDelete();
        return $this->response(code: 202, data: $series);
    }
}
