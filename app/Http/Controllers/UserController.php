<?php

namespace App\Http\Controllers;

use App\Events\Models\User\UserCreated;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * @group User Management
 *
 * APIs to manage the user resource
 */
class UserController extends Controller
{
    /**
     * Display a listing of the users.
     *
     * Gets a list of users
     *
     * @queryParam page_size int Size per page. Defaults to Example: 5
     * @queryParam page int Page to view. Example: 1
     * @apiResourceCollection App\Http\Resources\UserResource
     * @apiResourceModel App\Models\User
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $users = User::query()->paginate($request->page_size ?? 20);

        return UserResource::collection($users);
    }

    /**
     * Store a newly created resource in storage.
     * @bodyParam name string required Name of the user. Example: John Doe
     * @bodyParam email string required Email of the user. Example: john.doe@example.com
     * @apiResource App\Http\Resources\UserResource
     * @apiResourceModel App\Models\User
     */
    public function store(Request $request, UserRepository $userRepository): UserResource
    {
        $created = $userRepository->create($request->only([
            'name',
            'email',
        ]));

        return new UserResource($created);
    }

    /**
     * Display the specified resource.
     *
     * @urlParam id int required user id
     * @apiResource App\Http\Resources\UserResource
     * @apiResourceModel App\Models\User
     */
    public function show(User $user): UserResource
    {
       return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     * @bodyParam name string Name of the user. Example: John Doe
     * @bodyParam email string Email of the user. Example: john.doe@example.com
     * @apiResource App\Http\Resources\UserResource
     * @apiResourceModel App\Models\User
     */
    public function update(Request $request, User $user, UserRepository $userRepository): UserResource
    {
        $user = $userRepository->update($user, $request->only([
            'name',
            'email',
        ]));

        return new UserResource($user);
    }

    /**
     * Remove the specified resource from storage.
     * @urlParam id int required user id
     * @response  200 {"data": "success"}
     */
    public function destroy(User $user, UserRepository $userRepository): JsonResponse
    {
        $deleted = $userRepository->forceDelete($user);
        return new JsonResponse([
            'data' => 'success',
        ]);
    }
}
