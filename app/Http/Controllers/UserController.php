<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * @OA\Info(
 *     title="User Management API",
 *     version="1.0.0",
 *     description="API for managing users, friends, and nearby locations"
 * )
 *
 * @OA\Schema(
 *     schema="UserResponse",
 *     title="User Response",
 *     @OA\Property(property="message", type="string", example="Operation successful"),
 *     @OA\Property(
 *         property="data",
 *         type="object",
 *         allOf={
 *             @OA\Schema(
 *                 @OA\Property(property="id", type="string", example="507f1f77bcf86cd799439011"),
 *                 @OA\Property(property="name", type="string", example="John Doe"),
 *                 @OA\Property(property="email", type="string", example="john@example.com"),
 *                 @OA\Property(property="dob", type="string", format="date", example="1990-01-01"),
 *                 @OA\Property(property="address", type="string", example="123 Main St"),
 *                 @OA\Property(property="description", type="string", example="A brief description"),
 *                 @OA\Property(property="coordinates", type="array", @OA\Items(type="number"), example={40.7128, -74.0060}),
 *                 @OA\Property(property="created_at", type="string", format="date-time"),
 *                 @OA\Property(property="updated_at", type="string", format="date-time")
 *             )
 *         }
 *     )
 * )
 */
class UserController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/users",
     *     tags={"Users"},
     *     summary="Get all users",
     *     description="Retrieve a list of all users",
     *     @OA\Response(
     *         response=200,
     *         description="Users retrieved successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Users retrieved successfully."),
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(ref="#/components/schemas/UserResponse/properties/data")
     *             )
     *         )
     *     )
     * )
     */
    public function index()
    {
        $users = User::all();
        return response()->json([
            'message' => 'Users retrieved successfully.',
            'data' => $users
        ], 200);
    }

    /**
     * @OA\Post(
     *     path="/api/users",
     *     tags={"Users"},
     *     summary="Create a new user",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name", "email"},
     *             @OA\Property(property="name", type="string", example="John Doe"),
     *             @OA\Property(property="email", type="string", format="email", example="john@example.com"),
     *             @OA\Property(property="dob", type="string", format="date", example="1990-01-01"),
     *             @OA\Property(property="address", type="string", example="123 Main St"),
     *             @OA\Property(property="description", type="string", example="A brief description")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="User created successfully",
     *         @OA\JsonContent(ref="#/components/schemas/UserResponse")
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation errors",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="The given data was invalid."),
     *             @OA\Property(
     *                 property="errors",
     *                 type="object",
     *                 @OA\Property(property="email", type="array", @OA\Items(type="string", example="The email field is required."))
     *             )
     *         )
     *     )
     * )
     */
    public function store(Request $request)
    {
        // Existing implementation
    }

    /**
     * @OA\Get(
     *     path="/api/users/{user}",
     *     tags={"Users"},
     *     summary="Get user details",
     *     @OA\Parameter(
     *         name="user",
     *         in="path",
     *         required=true,
     *         description="User ID",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="User details retrieved successfully",
     *         @OA\JsonContent(ref="#/components/schemas/UserResponse")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="User not found"
     *     )
     * )
     */
    public function show(User $user)
    {
        // Existing implementation
    }

    /**
     * @OA\Put(
     *     path="/api/users/{user}",
     *     tags={"Users"},
     *     summary="Update user details",
     *     @OA\Parameter(
     *         name="user",
     *         in="path",
     *         required=true,
     *         description="User ID",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="name", type="string", example="John Doe"),
     *             @OA\Property(property="dob", type="string", format="date", example="1990-01-01"),
     *             @OA\Property(property="address", type="string", example="123 Main St"),
     *             @OA\Property(property="description", type="string", example="Updated description")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="User updated successfully",
     *         @OA\JsonContent(ref="#/components/schemas/UserResponse")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="User not found"
     *     )
     * )
     */
    public function update(Request $request, User $user)
    {
        // Existing implementation
    }

    /**
     * @OA\Delete(
     *     path="/api/users/{user}",
     *     tags={"Users"},
     *     summary="Delete a user",
     *     @OA\Parameter(
     *         name="user",
     *         in="path",
     *         required=true,
     *         description="User ID",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="User deleted successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="User deleted successfully.")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="User not found"
     *     )
     * )
     */
    public function destroy(User $user)
    {
        // Existing implementation
    }

    /**
     * @OA\Post(
     *     path="/api/users/{user}/friends",
     *     tags={"Friends"},
     *     summary="Add a friend",
     *     security={{"bearerAuth": {}}},
     *     @OA\Parameter(
     *         name="user",
     *         in="path",
     *         required=true,
     *         description="User ID of friend to add",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Friend added successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Friend added successfully.")
     *         )
     *     )
     * )
     */
    public function addFriend(Request $request, User $user)
    {
        // Existing implementation
    }

    /**
     * @OA\Delete(
     *     path="/api/users/{user}/friends",
     *     tags={"Friends"},
     *     summary="Remove a friend",
     *     security={{"bearerAuth": {}}},
     *     @OA\Parameter(
     *         name="user",
     *         in="path",
     *         required=true,
     *         description="User ID of friend to remove",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Friend removed successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Friend removed successfully.")
     *         )
     *     )
     * )
     */
    public function removeFriend(Request $request, User $user)
    {
        // Existing implementation
    }

    /**
     * @OA\Get(
     *     path="/api/users/{username}/nearby-friends",
     *     tags={"Friends"},
     *     summary="Get nearby friends",
     *     description="Returns friends within 10km radius",
     *     @OA\Parameter(
     *         name="username",
     *         in="path",
     *         required=true,
     *         description="Username to search for nearby friends",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="List of nearby friends",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/UserResponse/properties/data")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="User or coordinates not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="User or coordinates not found.")
     *         )
     *     )
     * )
     */
    public function nearbyFriends(Request $request, $username)
    {
        // Existing implementation
    }
}

/**
 * @OA\SecurityScheme(
 *     securityScheme="bearerAuth",
 *     type="http",
 *     scheme="bearer",
 *     bearerFormat="JWT"
 * )
 */