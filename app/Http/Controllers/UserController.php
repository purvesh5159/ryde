<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller {
    public function index() {
        $users = User::all();
        return response()->json([
            'message' => 'Users retrieved successfully.',
            'data' => $users
        ], 200);
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users,email',
            'dob' => 'nullable|date',
            'address' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        $user = User::create($validated);

        return response()->json([
            'message' => 'User created successfully.',
            'data' => $user
        ], 201);
    }

    public function show(User $user) {
        return response()->json([
            'message' => 'User retrieved successfully.',
            'data' => $user
        ], 200);
    }

    public function update(Request $request, User $user) {
        $validated = $request->validate([
            'name' => 'sometimes|string',
            'dob' => 'nullable|date',
            'address' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        $user->update($validated);

        return response()->json([
            'message' => 'User updated successfully.',
            'data' => $user
        ], 200);
    }

    public function destroy(User $user) {
        $user->delete();

        return response()->json([
            'message' => 'User deleted successfully.'
        ], 200);
    }

    public function addFriend(Request $request, User $user)
    {
        $authUser = $request->user();

        $authUser->push('friends', $user->id);

        return response()->json(['message' => 'Friend added successfully.']);
    }

    public function removeFriend(Request $request, User $user)
    {
        $authUser = $request->user();

        $authUser->pull('friends', $user->id);

        return response()->json(['message' => 'Friend removed successfully.']);
    }

    public function nearbyFriends(Request $request, $username)
    {
        $user = User::where('name', $username)->first();

        if (!$user || empty($user->coordinates)) {
            return response()->json(['message' => 'User or coordinates not found.'], 404);
        }

        $nearbyFriends = User::whereNotNull('coordinates')
            ->where('friends', 'all', [$user->id])
            ->get()
            ->filter(function ($friend) use ($user) {
                return $this->calculateDistance($user->coordinates, $friend->coordinates) <= 10; // Within 10 km
            });

        return response()->json($nearbyFriends);
    }

    private function calculateDistance($coords1, $coords2)
    {
        [$lat1, $lon1] = $coords1;
        [$lat2, $lon2] = $coords2;

        $earthRadius = 6371; // Earth radius in km
        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);

        $a = sin($dLat / 2) ** 2 + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($dLon / 2) ** 2;
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return $earthRadius * $c;
    }
}
