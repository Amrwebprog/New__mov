<?php

namespace App\Http\Controllers;

use App\Models\EpisodeWatching;
use App\Http\Requests\StoreEpisodeWatchingRequest;
use App\Http\Requests\UpdateEpisodeWatchingRequest;
use App\Models\Episode;
use App\Models\SubscriptionDetails;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class EpisodeWatchingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $EpisodeWatching = EpisodeWatching::paginate(30);
        return $this->response(code: 200, data: $EpisodeWatching);
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
    public function store(StoreEpisodeWatchingRequest $request)
    {
        if ($this->Subscripe()) {
            //validate
            $request = $request->validated();
            //user_id
            $user_id = Auth::user()->id;
            $request['user_id'] = $user_id;
            //insert data
            $insert = EpisodeWatching::create($request);
            return $this->response(code: 201, data: $insert);
        } else {
            return $this->response(code: 500, msg: 'not payment');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(EpisodeWatching $episodeWatching)
    {
        $id = $episodeWatching->id;
        $episodeWatching = EpisodeWatching::with('user', 'episode')->find($id);
        return $this->response(code: 200, data: $episodeWatching);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EpisodeWatching $episodeWatching)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEpisodeWatchingRequest $request, EpisodeWatching $episodeWatching)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EpisodeWatching $episodeWatching)
    {
        //
    }
    public function delete(EpisodeWatching $episodeWatching)
    {
        $delete = $episodeWatching->delete();
        return $this->response(code: 202, data: $delete);
    }
    public function deleted(EpisodeWatching $episodeWatching)
    {
        $deleted = $episodeWatching->onlyTrashed()->get();
        return $this->response(code: 302, data: $deleted);
    }
    public function restore($episodeWatching)
    {
        $episodeWatching = EpisodeWatching::withTrashed()->where('id', $episodeWatching)->restore();
        return $this->response(code: 202, data: $episodeWatching);
    }
    public function delete_from_trash($episodeWatching)
    {
        $episodeWatching = EpisodeWatching::where('id', $episodeWatching)->forceDelete();
        return $this->response(code: 202, data: $episodeWatching);
    }
}