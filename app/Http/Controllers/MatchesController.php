<?php

namespace App\Http\Controllers;

use App\Models\Matches;
use App\Http\Requests\StoreMatchesRequest;
use App\Http\Requests\StoreWhereMatchRequest;
use App\Http\Requests\UpdateMatchesRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MatchesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function new()
    {
        $new = Matches::with('country')->select(['id', 'image', 'rate', 'top_10', 'quality', 'story', 'year_of_production', 'stadium', 'team_1', 'team_1_logo', 'team_2', 'team_2_logo', 'champion', 'result', 'country_id'])->orderBy('id', 'desc')->limit(15)->get();
        if (count($new) != 0) {
            return $this->response(code: 200, data: $new);
        } else {
            return $this->response(code: 404);
        }
    }
    public function top_10()
    {
        $top_10 = Matches::with('country')->select(['id', 'image', 'rate', 'top_10', 'quality', 'story', 'year_of_production', 'stadium', 'team_1', 'team_1_logo', 'team_2', 'team_2_logo', 'champion', 'result', 'country_id'])->get()
            ->where('top_10', true);
        if (count($top_10) != 0) {
            return $this->response(code: 200, data: $top_10);
        } else {
            return $this->response(code: 404);
        }
    }
    public function rate()
    {
        $matches = Matches::with('country')->select(['id', 'image', 'rate', 'top_10', 'quality', 'story', 'year_of_production', 'stadium', 'team_1', 'team_1_logo', 'team_2', 'team_2_logo', 'champion', 'result', 'country_id'])->get()
            ->where('rate', '>', '7.0');
        if (count($matches) != 0) {
            return $this->response(code: 200, data: $matches);
        } else {
            return $this->response(code: 404);
        }
    }
    public function champion($champion)
    {

        //get film where genre
        $matches = Matches::with('country')->select(['id', 'image', 'rate', 'top_10', 'quality', 'story', 'year_of_production', 'stadium', 'team_1', 'team_1_logo', 'team_2', 'team_2_logo', 'champion', 'result', 'country_id'])->get()
            ->where('champion', $champion);
        if ($matches) {
            return $this->response(code: 200, data: $matches);
        } else {
            return $this->response(code: 404);
        }
    }
    public function index()
    {
        $Matches = Matches::select(['id', 'image', 'rate', 'top_10', 'quality', 'story', 'year_of_production', 'stadium', 'team_1', 'team_1_logo', 'team_2', 'team_2_logo', 'champion', 'result', 'country_id'])
            ->with('country')->paginate(15);
        return $this->response(code: 200, data: $Matches);
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
    public function store(StoreMatchesRequest $request)
    {
        $request = $request->validated();
        //insert
        $insert = Matches::create($request);
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
    public function show(Matches $matches)
    {
        if ($this->Subscripe()) {
            $id = $matches->id;
            $matches = Matches::with('match_watchings', 'country')->find($id);
            return $this->response(code: 200, data: $matches);
        } else {
            return 'you can\'t watch this episode untill pay it';
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Matches $matches)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMatchesRequest $request, Matches $matches, StoreWhereMatchRequest $Match)
    {
        //validate
        $request = $request->validated();
        $Match = $Match->validated();
        //update data
        $update = DB::table('matches')->where([['match_url', $Match['match_url_old']], ['champion', $Match['champion_old']]])->update($request);
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
    public function destroy(Matches $matches)
    {
        //
    }
    public function delete(Matches $matches)
    {
        $delete = $matches->delete();
        return $this->response(code: 202, data: $delete);
    }
    public function deleted(Matches $matches)
    {
        $deleted = $matches->onlyTrashed()->get();
        return $this->response(code: 302, data: $deleted);
    }
    public function restore($matches)
    {
        $matches = Matches::withTrashed()->where('id', $matches)->restore();
        return $this->response(code: 202, data: $matches);
    }
    public function delete_from_trash($matches)
    {
        $matches = Matches::where('id', $matches)->forceDelete();
        return $this->response(code: 202, data: $matches);
    }
}
