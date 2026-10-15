<?php

namespace App\Http\Controllers;

use App\Models\events;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Events = events::latest()->paginate(10);
        return view('admin.event.index', compact('Events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.event.create'); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'concert_name' => 'required|string|max:255',
            'category' => 'required|in:Musik,Festival,Seminar',
            'ticket_price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();  
            $request->image->move(public_path('images'), $imageName);
        } else {
            $imageName = null; // Jika tidak ada gambar yang diunggah
        }
    
        events::create([
            'concert_name' => $request->concert_name,
            'category' => $request->category,
            'ticket_price' => $request->ticket_price,
            'description' => $request->description,
            'image' => $imageName,
        ]);

        return redirect()->route('events.index')
                        ->with('success','Event created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(events $events)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(events $events, string $id)
    {
            $event =   events::findOrFail($id);

        return view('admin.event.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, events $events, string $id)
    {
            $event =   events::findOrFail($id);

    
        $validatedData = $request->validate([
            'concert_name' => 'required|string|max:255',
            'category' => 'required|in:Musik,Festival,Seminar',
            'ticket_price' => 'required|numeric|min:0',
            'description' => 'nullable|string', 
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();  
            $request->image->move(public_path('images'), $imageName);
        } else {
            $imageName = null; // Jika tidak ada gambar yang diunggah
        }

        $validatedData['image'] = $imageName;

        $event->update($validatedData);

        return redirect()->route('events.index')
                        ->with('success','Event updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(events $events, string $id)
    {
        $events =   events::findOrFail($id);
        Events::destroy($events->id);

        return redirect()->route('events.index')
                        ->with('success','Event deleted successfully.');
    }
}
