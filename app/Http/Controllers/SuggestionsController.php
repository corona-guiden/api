<?php

namespace App\Http\Controllers;

use App\Suggestion;
use Illuminate\Http\Request;

class SuggestionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Suggestion::select([
            'id',
            'question',
            'source',
            'question_id',
            'status',
            'source_updated_at',
        ])->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Suggestion $suggestion
     * @return Suggestion
     */
    public function show(Suggestion $suggestion)
    {
        return $suggestion;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Suggestion $suggestions
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Suggestion $suggestions)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Suggestion $suggestions
     * @return \Illuminate\Http\Response
     */
    public function destroy(Suggestion $suggestions)
    {
        //
    }
}
