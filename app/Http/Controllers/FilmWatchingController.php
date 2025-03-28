<?php

namespace App\Http\Controllers;

use App\Models\FilmWatching;
use App\Http\Requests\StoreFilmWatchingRequest;
use App\Http\Requests\UpdateFilmWatchingRequest;
use Illuminate\Support\Facades\Auth;

class FilmWatchingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $FilmWatching = FilmWatching::paginate(30);
        return $this->response(code: 200, data: $FilmWatching);
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
    public function store(StoreFilmWatchingRequest $request)
    {
        if ($this->Subscripe()) {
            //validate
            $request = $request->validated();
            //user_id
            $user_id = Auth::user()->id;
            $request['user_id'] = $user_id;
            //insert data
            $insert = FilmWatching::create($request);
            return $this->response(code: 201, data: $insert);
        } else {
            return $this->response(code: 500, msg: 'not payment');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(FilmWatching $filmWatching)
    {
        $id = $filmWatching->id;
        $filmWatching = FilmWatching::with('user', 'film')->find($id);
        return $this->response(code: 200, data: $filmWatching);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FilmWatching $filmWatching)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFilmWatchingRequest $request, FilmWatching $filmWatching)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FilmWatching $filmWatching)
    {
        //
    }
    public function delete(FilmWatching $filmWatching)
    {
        $delete = $filmWatching->delete();
        return $this->response(code: 202, data: $delete);
    }
    public function deleted(FilmWatching $filmWatching)
    {
        $deleted = $filmWatching->onlyTrashed()->get();
        return $this->response(code: 302, data: $deleted);
    }
    public function restore($filmWatching)
    {
        $filmWatching = FilmWatching::withTrashed()->where('id', $filmWatching)->restore();
        return $this->response(code: 202, data: $filmWatching);
    }
    public function delete_from_trash($filmWatching)
    {
        $filmWatching = FilmWatching::where('id', $filmWatching)->forceDelete();
        return $this->response(code: 202, data: $filmWatching);
    }
}
