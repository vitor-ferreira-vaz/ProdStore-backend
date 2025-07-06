<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function __construct(protected Pro $service) { }


    public function show(int $id): JsonResponse
    {
        $obj = $this->service->show($id);
        return response()->json(['data' => $obj, 'message' => $obj['message']], $obj['status']);
    }


    public function store(StoreProductRequest $request): JsonResponse
    {
        $store = $this->service->store($request->all());
        return response()->json(['message' => $store['message']], $store['status']);
    }

    public function update(StoreProductRequest $request, string $id): JsonResponse
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
