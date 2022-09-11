<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Play;
use App\Models\Set;
use App\Models\Movie;
use App\Http\Resources\PlayResource;

class MainController extends Controller
{
  
    public function player() {
      $movies = Movie::get();
      return view('play', [
        "movies" => $movies,
      ]);
    }
    
    public function enquiry() {
      return response()->json([
        "now" => ceil(microtime(true)*1000),
        "plays" => PlayResource::collection(Play::where('play_time', '>', ceil(microtime(true)*1000))->get()),
      ]);
    }
    
    public function control() {
      $movies = Movie::get();
      $sets = Set::get();
      return view('control', [
        "sets" => $sets,
        "movies" => $movies,
      ]);
    }
    
    public function play(Request $request) {
      $request->validate([
        'titleA' => 'string|nullable',
        'titleB' => 'string|nullable',
        'titleC' => 'string|nullable',
      ]);
      
      $play_time = ceil(microtime(true)*1000) + 2000;
      
      if ($request->titleA) 
        Play::create([
          'name' => $request->titleA,
          'play_time' => $play_time,
          'player_id' => 'A',
        ]);
        
      if ($request->titleB) 
        Play::create([
          'name' => $request->titleB,
          'play_time' => $play_time,
          'player_id' => 'B',
        ]);
        
      if ($request->titleC) 
        Play::create([
          'name' => $request->titleC,
          'play_time' => $play_time,
          'player_id' => 'C',
        ]);
      
      return redirect()->route('control');
    }
    
    public function register(Request $request) {
      $request->validate([
        'titleA' => 'string|nullable',
        'titleB' => 'string|nullable',
        'titleC' => 'string|nullable',
      ]);
      
      Set::create([
        'name_a' => $request->titleA ?? "",
        'name_b' => $request->titleB ?? "",
        'name_c' => $request->titleC ?? "",
      ]);
      
      return redirect()->route('control');
    }
    
    public function deleteSets(Request $request) {
      $request->validate([
        'id' => 'required',
      ]);
      
      Set::find($request->id)->delete();
      
      return redirect()->route('control');
    }
    
    public function add() {
      $movies = Movie::get();
      return view('add', [
        "movies" => $movies,
      ]);
    }
      
    public function add_post(Request $request) {
      $request->validate([
        'title' => 'required|string',
        'upload_file' => 'required',
      ]);
      
      $path = $request->upload_file->store('movies', 'public');
      
      Movie::create([
        'title' => $request->title,
        'path' => $path,
      ]);
      
      return redirect()->route('add');
    }
    
    public function delete(Request $request) {
      $request->validate([
        'id' => 'required|integer',
      ]);
      
      Movie::find($request->id)->delete();
      
      return redirect()->route('add');
    }
    
    
}
