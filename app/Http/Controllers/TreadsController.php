<?php

namespace App\Http\Controllers;

use App\Channel;
use App\Filters\TreadsFilters;
use App\Tread;
use function dd;
use Illuminate\Http\Request;

class TreadsController extends Controller {

    /**
     * TreadsController constructor.
     */
    public function __construct() {
        $this->middleware('auth')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Channel $channel
     * @param TreadsFilters $filters
     * @return \Illuminate\Http\Response
     */
    public function index(Channel $channel, TreadsFilters $filters) {

        $treads = $this->getTreads($channel, $filters);

       if (request()->wantsJson()){
            return $treads;
        }

        return view('treads.index', compact('treads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('treads.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //

        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'channel_id' => 'required|exists:channels,id'
        ]);

        $tread = Tread::create([
                    'user_id' => auth()->id(),
                    'channel_id' => request('channel_id'),
                    'title' => request('title'),
                    'body' => request('body'),
        ]);

        return redirect($tread->path());
    }

    /**
     * Display the specified resource.
     *
     * @param  string     $channelId
     * @param  \App\Tread $tread
     * @return \Illuminate\Http\Response
     */
    public function show($channelId, Tread $tread) {


        return view('treads.show', [
            'tread' => $tread,
            'replies' => $tread->replies()->paginate(25)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tread  $tread
     * @return \Illuminate\Http\Response
     */
    public function edit(Tread $tread) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tread  $tread
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tread $tread) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tread  $tread
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tread $tread) {
        //
    }

    /**
     * @param Channel       $channel
     * @param TreadsFilters $filters
     * @return mixed
     */
    protected function getTreads(Channel $channel, TreadsFilters $filters)
    {
        $treads = Tread::latest()->filter($filters);

        if ($channel->exists) {
            $treads->where('channel_id', $channel->id);
        }

//        dd($treads->toSql());
        $treads = $treads->get();
        return $treads;
    }


}
