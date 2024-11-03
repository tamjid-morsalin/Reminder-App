<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EventsController extends Controller
{
    public function index()
    {
        $events = Event::all();

        return view('events.index', compact('events'));
    }

    public function create()
    {

        $registrants = User::all()->pluck('name', 'id');

        return view('events.create', compact('registrants'));
    }

    public function store(StoreEventRequest $request)
    {
        $event = Event::create($request->all());
        $event->registrants()->sync($request->input('registrants', []));

        return redirect()->route('app.events.index');

    }

    public function edit(Event $event)
    {

        $registrants = User::all()->pluck('name', 'id');

        $event->load('registrants');

        return view('events.edit', compact('registrants', 'event'));
    }

    public function update(UpdateEventRequest $request, Event $event)
    {
        $event->update($request->all());
        $event->registrants()->sync($request->input('registrants', []));

        return redirect()->route('app.events.index');

    }

    public function show(Event $event)
    {

        $event->load('registrants');

        return view('events.show', compact('event'));
    }

    public function destroy(Event $event)
    {

        $event->delete();

        return back();

    }
}
