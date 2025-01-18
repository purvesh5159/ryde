<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller {
    public function index() {
        return response()->json(User::all());
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string',
            'dob' => 'nullable|date',
            'address' => 'nullable|string',
            'description' => 'nullable|string',
        ]);
        $user = User::create($validated);
        return response()->json($user, 201);
    }

    public function show(User $user) {
        return response()->json($user);
    }

    public function update(Request $request, User $user) {
        $validated = $request->validate([
            'name' => 'sometimes|string',
            'dob' => 'nullable|date',
            'address' => 'nullable|string',
            'description' => 'nullable|string',
        ]);
        $user->update($validated);
        return response()->json($user);
    }

    public function destroy(User $user) {
        $user->delete();
        return response()->json(null, 204);
    }
}

