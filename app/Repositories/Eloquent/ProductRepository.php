<?php

namespace App\Repositories\Eloquent;

use App\DTO\ProductDTO;
use App\Models\Product;
use App\Models\User;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;

class ProductRepository implements ProductRepositoryInterface
{

    public function all(Request $request): Paginator
    {

        $query = Product::query();

        if(!empty($request->title)) {
            $query->whereRaw("title", [$request->title]);
        }
        if(!empty($request->price)) {
            $query->whereRaw("price", [$request->price]);
        }
        if(!empty($request->description)) {
            $query->whereRaw("description", [$request->description]);
        }
        if(!empty($request->category)) {
            $query->whereRaw("category", [$request->category]);
        }
        if(!empty($request->image)) {
            $query->whereRaw("image", [$request->image]);
        }
        if(!empty($request->rate)) {
            $query->whereRaw("rate", [$request->rate]);
        }
        return Product::paginate($request->perPage)->through(fn(Product $u) => ProductDTO::InstancefromArray($u->toArray()));
    }

    public function show(int $id): object
    {
        return Product::find($id);
    }

    public function store(ProductDTO $dto): array
    {
        DB::beginTransaction();
        try {
            Product::create($dto->toArray());
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return [
                'status' => 500,
                'message' => "Erro ao cadastrar: {$e->getMessage()}",
            ];
        }
        return [
            'status' => 200,
            'message' => "Cadastrado com sucesso!",
        ];
    }

    public function update(int $id, ProductDTO $dto): array
    {
        DB::beginTransaction();
        try {
            $product = Product::find($id);
            $product->update($dto->toArray());
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return [
                'status' => 500,
                'message' => "Erro ao cadastrar:  {$e->getMessage()}",
            ];
        }
        return [
            'status' => 200,
            'message' => "Atualizado com sucesso!",
        ];
    }

    public function destroy(int $id): array
    {
        DB::beginTransaction();
        try {
            Product::destroy($id);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return [
                'status' => 500,
                'message' => "Erro ao cadastrar:  {$e->getMessage()}",
            ];
        }
        return [
            'status' => 200,
            'message' => "Deletado com sucesso!",
        ];
    }
}
