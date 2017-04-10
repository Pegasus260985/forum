<?php

namespace App\Http\Controllers;

use App\Tread;
use Illuminate\Http\Request;

class TreadsController extends Controller {
    
    
    public function __construct() {
        $this->middleware('auth')->only('store');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $treads = Tread::latest()->get();

        return view('treads.index', compact('treads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //

       $tread =  Tread::create([
            'user_id' => auth()->id(),
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
    public function show(Tread $tread) {
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

}
