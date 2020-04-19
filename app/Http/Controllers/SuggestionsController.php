<?php

namespace App\Http\Controllers;

use App\Suggestion;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Spatie\QueryBuilder\QueryBuilder;

class SuggestionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suggestions = QueryBuilder::for(Suggestion::where('question','LIKE','%'.request('search').'%'))
            ->allowedSorts('status', 'answer', 'question')
            ->allowedFilters('status', 'answer', 'question');
//            ->when(false, function($query) {
//                return $query->paginate(request('perPage'));
//            })
//            ->appends(request()->query())


        if(request('perPage') == -1) {
            return JsonResource::make($suggestions->get());
        }

        return $suggestions->paginate(request('perPage'));
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
     * @param  \App\Suggestion  $suggestion
     * @return Suggestion
     */
    public function show(Suggestion $suggestion)
    {
        return $suggestion;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Suggestion  $suggestions
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Suggestion $suggestions)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Suggestion  $suggestions
     * @return \Illuminate\Http\Response
     */
    public function destroy(Suggestion $suggestions)
    {
        //
    }
}
