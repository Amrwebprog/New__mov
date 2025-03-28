<?php

namespace App\Http\Controllers;

use App\Models\Season;
use App\Http\Requests\StoreSeasonRequest;
use App\Http\Requests\StoreWhereSeriesRequest;
use App\Http\Requests\UpdateSeasonRequest;
use App\Models\Series;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SeasonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Season = Season::paginate(30);
        return $this->response(code: 200, data: $Season);
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
    public function store(StoreSeasonRequest $request, StoreWhereSeriesRequest $Series)
    {
        //validate
        $request = $request->validated();
        $request['num_of_episodes'] = 0;
        //Series_id
        $Series = $Series->validated();
        $Series_id = Series::all()->where('series_name', $Series['series_name'])->first()->id;
        $request['series_id'] = $Series_id;
        //insert data
        $insert = Season::create($request);
        //add num_of_seasons in table series
        $num_of_seasons = Series::all()->where('id', $insert['series_id'])->first()->num_of_seasons;
        $num_of_seasons = $num_of_seasons + 1;
        $update_num_of_seasons = DB::table('series')->where('id', $insert['series_id'])->update([
            'num_of_seasons' => $num_of_seasons
        ]);
        if ($insert) {
            return $this->response(code: 201, data: $insert);
        } else {
            return $this->response(code: 400, data: 'Can\'t create ');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Season $season)
    {
        $id = $season->id;
        $season = Season::with('series', 'episdes')->find($id);
        return $this->response(code: 200, data: $season);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Season $season)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSeasonRequest $request, Season $season)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Season $season)
    {
        //
    }
    public function delete(Season $season)
    {
        $delete = $season->delete();
        return $this->response(code: 202, data: $delete);
    }
    public function deleted(Season $season)
    {
        $deleted = $season->onlyTrashed()->get();
        return $this->response(code: 302, data: $deleted);
    }
    public function restore($season)
    {
        $season = Season::withTrashed()->where('id', $season)->restore();
        return $this->response(code: 202, data: $season);
    }
    public function delete_from_trash($season)
    {
        $season = Season::where('id', $season)->forceDelete();
        return $this->response(code: 202, data: $season);
    }
}
