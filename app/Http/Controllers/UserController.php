<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;


class UserController extends Controller
{

    public function __construct(protected UserService $service)
    {
    }


    public function show(int $id): JsonResponse
    {
        $obj = $this->service->show($id);
        return response()->json(['data' => $obj, 'message' => $obj['message']], $obj['status']);
    }


    public function store(StoreUserRequest $request): JsonResponse
    {
        $store = $this->service->store($request->all());
        return response()->json(['message' => $store['message']], $store['status']);
    }

    public function update(UpdateUserRequest $request, string $id): JsonResponse
    {
        $update = $this->service->update($id, $request->all());
        return response()->json(['message' => $update['message']], $update['status']);
    }


    public function destroy(string $id): JsonResponse
    {
        $destroy = $this->service->destroy($id);
        return response()->json(['message' => $destroy['message']], $destroy['status']);
    }
}
