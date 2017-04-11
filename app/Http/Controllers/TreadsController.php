<?php

namespace App\Http\Controllers;

use App\Channel;
use App\Tread;
use Illuminate\Http\Request;

class TreadsController extends Controller {

    public function __construct() {
        $this->middleware('auth')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Channel $channel) {


        $treads = $this->getTreads($channel);

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
     * @param  \App\Tread  $tread
     * @return \Illuminate\Http\Response
     */
    public function show($channelId, Tread $tread) {
        return view('treads.show', compact('tread'));
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
     * @param Channel $channel
     * @return mixed
     */
    protected function getTreads(Channel $channel)
    {
        if ($channel->exists) {
            //Treads by channel
            $treads = $channel->treads()->latest();
        } else {
            //All treads
            $treads = Tread::latest();
        }

        //If request('by'), we ahould filter by the user name
        if ($username = request('by')) {

            $user = \App\User::where('name', $username)->firstOrFail();

            $treads->where('user_id', $user->id);
        }

        $treads = $treads->get();
        return $treads;
    }

}
