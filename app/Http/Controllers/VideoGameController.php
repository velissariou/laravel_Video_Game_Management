<?php

namespace App\Http\Controllers;

use App\Models\VideoGame;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class VideoGameController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $userId = Auth::id();
        $query = VideoGame::query();
        $genres = VideoGame::select('genre')->distinct()->pluck('genre')->filter()->values();

        // Filter by genre if a genre parameter is provided
        if ($request->has('genre')) {
            $genre = $request->input('genre');
            $query->where('genre', $genre);
        }
    
        // Determine the sorting order based on the 'sort' parameter
        $sortOrder = $request->input('sort', 'asc');
        if ($sortOrder === 'asc') {
            $query->orderBy('release_date');
        } elseif ($sortOrder === 'desc') {
            $query->orderByDesc('release_date');
        }
    
        $videoGames = $query->where('user_id', $userId)->latest()->paginate(5); 
        return view('video_games.index', compact('videoGames', 'genres'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('video_games.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'release_date' => 'required|date',
            'genre' => 'required|string'
        ]);
        $request['user_id'] = auth()->id();
        VideoGame::create($request->all());
        return redirect()->route('video_games.index')
                        ->with('success','Video Game created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(VideoGame $videoGame): View
    {
        return view('video_games.show', compact('videoGame')); 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(VideoGame $videoGame)
    {
        return view('video_games.edit', compact('videoGame')); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, VideoGame $videoGame)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'release_date' => 'required',
            'genre' => 'required'
        ]);
        $videoGame->update($request->all());
        return redirect()->route('video_games.index')
                        ->with('success','Video Game updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VideoGame $videoGame)
    {
        $videoGame->delete();
        return redirect()->route('video_games.index')->with('Success', 'Video Game deleted successfully');
    }
}
