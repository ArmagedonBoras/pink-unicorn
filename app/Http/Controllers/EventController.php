<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $event = new Event();
        $event->starts_at = Carbon::now();
        $event->ends_at = Carbon::now()->addHours(6);
        $min = Carbon::tomorrow('Europe/Stockholm');
        $max = Carbon::tomorrow('Europe/Stockholm')->addMonth();
        if (Gate::allows('book-longer-than-month')) {
            $max->addMonth();
        }
        if (Gate::allows('book-longer-than-two-months')) {
            $max->addMonths(8);
        }
        $default = Carbon::tomorrow('Europe/Stockholm');
        return view('events.create')
            ->with(['event' => $event, 'min' => $min, 'max' => $max, 'default' => $default]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        return view('events.create')
            ->with(['event' => $event]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        //
    }
}
