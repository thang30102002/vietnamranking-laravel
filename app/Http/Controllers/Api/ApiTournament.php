<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

class ApiTournament
{
    public function index()
    {
        // Logic to retrieve and return a list of tournaments
    }

    public function postBracket($id, Request $request)
    {
        $tournament = \App\Models\Tournament::findOrFail($id);
        $tournament->bracket = json_encode($request->all()); // ✅ Đúng
        $tournament->save();
        return response()->json(['message' => 'Bracket updated successfully'], 200);
    }

    public function deleteBracket($id)
    {
        $tournament = \App\Models\Tournament::findOrFail($id);
        $tournament->bracket = null;
        $tournament->save();
        return response()->json(['message' => 'Bracket updated successfully'], 200);
    }
}
