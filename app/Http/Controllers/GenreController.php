<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Http\Requests\StoreGenreRequest;
use App\Http\Requests\UpdateGenreRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Genre = Genre::get();
        return $this->response(code: 200, data: $Genre);

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
    public function store(StoreGenreRequest $request)
    {
        $request = $request->validated();
        //insert
        $insert = Genre::create($request);
        //check if insert
        if ($insert) {
            return $this->response(code: 200, data: $insert);
        } else {
            return $this->response(code: 201);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Genre $genre)
    {
        $id = $genre->id;
        $genre = Genre::with('series', 'films')->find($id);
        return $this->response(code: 200, data: $genre);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Genre $genre)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGenreRequest $request, Genre $genre)
    {
        //validate
        $request = $request->validated();
        //genre_id
        $genre_id = Genre::all()->where('genre', $request['genre'])->first()->id;
        //update data
        $update = DB::table('genres')->where('id', $genre_id)->update([
            'genre' => $request['genre_new'],
        ]);
        //check if update
        if ($update) {
            return $this->response(code: 200, data: $update);
        } else {
            return $this->response(code: 201);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Genre $genre)
    {
        //
    }
    public function delete(Genre $genre)
    {
        $delete = $genre->delete();
        return $this->response(code: 202, data: $delete);

    }
    public function deleted(Genre $genre)
    {
        $deleted = $genre->onlyTrashed()->get();
        return $this->response(code: 302, data: $deleted);

    }
    public function restore($genre)
    {
        $genre = Genre::withTrashed()->where('id', $genre)->restore();
        return $this->response(code: 202, data: $genre);

    }
    public function delete_from_trash($genre)
    {
        $genre = Genre::where('id', $genre)->forceDelete();
        return $this->response(code: 202, data: $genre);

    }
}
