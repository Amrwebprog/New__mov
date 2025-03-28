<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEpisodeWhereSeriesRequest;
use App\Http\Requests\StoreWhereSeason_idRequest;
use App\Models\Episode;
use App\Http\Requests\StoreEpisodeRequest;
use App\Http\Requests\StoreWhereSeriesRequest;
use App\Http\Requests\UpdateEpisodeRequest;
use App\Http\Requests\UpdateWhereEpisodeRequest;
use App\Models\Season;
use App\Models\Series;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EpisodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Episode = Episode::select(['id', 'image', 'episode_number', 'description', 'season_id'])->with('season')->paginate(30);
        return $this->response(code: 200, data: $Episode);
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
    public function store(StoreEpisodeRequest $request, StoreWhereSeason_idRequest $Season, StoreWhereSeriesRequest $Series)
    {
        //validate
        $request = $request->validated();
        $Season = $Season->validated();
        $Series = $Series->validated();
        //uplode image
        $fileName = time() . '.' . $request['image']->getClientOriginalName();
        $image_path = $request['image']->storeAs('episode_images', $fileName, 'public');
        $request['image'] = $image_path;
        
        //uplode episode
        $episodename = time() . '.' . $request['episode_url']->getClientOriginalName();
        $video_path = $request['episode_url']->storeAs('episodes', $episodename, 'public');
        
        $request['episode_url'] = $video_path;
        //Series_id
        $Series_id = Series::all()->where('series_name', $Series['series_name'])->first()->id;
        //seasons_id
        $season_id = Season::where([
            ['series_id', $Series_id],
            ['season_number', $Season['season_number']],
        ])->first()->id;
        $request['season_id'] = $season_id;
        //insert data   
        $insert = Episode::create([
            'episode_number' => $request['episode_number'],
            'description' => $request['description'],
            'episode_url' => $request['episode_url'],
            'season_id' => $request['season_id'],
            'image' => $request['image']
        ]);
        //add num_of_seasons in table series
        $num_of_episodes = Season::all()->where('id', $insert['season_id'])->first()->num_of_episodes;
        $num_of_episodes = $num_of_episodes + 1;
        $update_num_of_seasons = DB::table('seasons')->where('id', $insert['season_id'])->update([
            'num_of_episodes' => $num_of_episodes
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
    public function show(Episode $episode)
    {
        if ($this->Subscripe()) {
            $id = $episode->id;
            $episode = Episode::with('season', 'episode_watchings')->find($id);
            return $this->response(code: 200, data: $episode);
        } else {
            return 'you can\'t watch this episode untill pay it';
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Episode $episode)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEpisodeRequest $request, Episode $episode, StoreWhereSeason_idRequest $Season, StoreWhereSeriesRequest $Series, UpdateWhereEpisodeRequest $episode_old)
    {
        //validate
        $Season = $Season->validated();
        $Series = $Series->validated();
        $request = $request->validated();
        $episode_old = $episode_old->validated();
        //Series_id_new
        $Series_id_new = Series::all()->where('series_name', $Series['series_name'])->first()->id;
        //seasons_id_new
        $season_id_new = Season::where([
            ['series_id', $Series_id_new],
            ['season_number', $Season['season_number']],
        ])->first()->id;
        $request['season_id'] = $season_id_new;
        //seasons_id_old
        //Series_id_old
        $Series_id_old = Series::all()->where('series_name', $episode_old['series_name_old'])->first()->id;
        //seasons_id_old
        $season_id_old = Season::where([
            ['series_id', $Series_id_old],
            ['season_number', $episode_old['season_number_old']],
        ])->first()->id;
        //update data
        $update = DB::table('episodes')->where([['episode_number', $episode_old['episode_number_old']], ['season_id', $season_id_old]])->update($request);
        if ($update) {
            return $this->response(code: 201, data: $update);
        } else {
            return $this->response(code: 400, data: 'Can\'t update ');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Episode $episode)
    {
        //
    }
    public function delete(Episode $episode)
    {
        $delete = $episode->delete();
        return $this->response(code: 202, data: $delete);
    }
    public function deleted(Episode $episode)
    {
        $deleted = $episode->onlyTrashed()->get();
        return $this->response(code: 302, data: $deleted);
    }
    public function restore($episode)
    {
        $episode = Episode::withTrashed()->where('id', $episode)->restore();
        return $this->response(code: 202, data: $episode);
    }
    public function delete_from_trash($episode)
    {
        $episode = Episode::where('id', $episode)->forceDelete();
        return $this->response(code: 202, data: $episode);
    }
}