<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Acara;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AcaraController extends Controller
{
    public function index()
    {
        $events = Acara::all();
        foreach ($events as $event) {
            $event->start_time = Carbon::parse($event->start_time)->format('H:i');
            $event->end_time = Carbon::parse($event->end_time)->format('H:i');
        }
        return view('events.index', compact('events'));
    }

    public function create()
    {
        return view('events.createacara');
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'tanggal' => 'required|date',
            'judul' => 'required|string|max:255',
            'start_time' => 'required',
            'end_time' => 'required',
            'presenter' => 'required|string|max:255',
        ]);

         if ($validate->fails()) {
            return redirect()->back()->withInput()->withErrors($validate);
        }

        
        $event = $request->only(['tanggal', 'judul','start_time', 'end_time','presenter']);
        Acara::create($event);
        return redirect()->route('acara');
    }

    public function edit($id)
    {
         $event = Acara::find($id);
        return view('events.editacara', compact('event'));
    }

    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'tanggal' => 'required|date',
            'judul' => 'required|string|max:255',
            'start_time' => 'required',
            'end_time' => 'required',
            'presenter' => 'required|string|max:255',
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withInput()->withErrors($validate);
        }

        $event = $request->only(['tanggal', 'judul','start_time', 'end_time','presenter']);

        $event = Acara::find($id);
        $event->update($request->all());

        return redirect()->route('acara')->with('success', 'Event updated successfully.');
    }


    public function destroy(Request $request, $id)
    {
        $event = Acara::find($id);

        if ($event->delete()) {
    }
    return redirect()->route('acara')->with('success', 'Event deleted successfully.');
    }
}