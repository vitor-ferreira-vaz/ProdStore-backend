<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{

    public function __construct(protected ProductService $service) { }

    public function index(Request $request): JsonResponse
    {
        $result = $this->service->list($request);
        return response()->json($result);
    }


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
