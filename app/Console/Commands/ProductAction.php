<?php

namespace App\Console\Commands;

//use App\Models\ImageProduct;
use App\DTO\ProductDTO;
use App\Models\Product;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductAction extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'product-action:import {--id=0}? {--offline}?';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Importar produtos da FakeStoreAPI';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $prod_id = $this->input->getOption('id');
        $offline = $this->input->getOption('offline');

        $this->info("Requisição iniciada...");

        if (!isset($prod_id)){
            $this->error("Nenhum produto encontrado!");
        }

        $record = !$offline ? $this->getApiData($prod_id) : $this->getDiskData($prod_id);

        $dto = ProductDTO::InstancefromArray($record);

        $validator = Validator::make($dto->toArray(), [
            "id" => "required|integer",
            "title" => "required",
            "price" => "required|decimal:0,2",
            "description" => "required",
            "category" => "required",
            "image" => "required|string",
            "rate" => "required",
            "count" => "required|integer",
        ],
            [
                "id.required" => "Id não encontrado!",
                "id.integer" => "O id precisa ser um inteiro!",
                "title.required" => "Titulo não encontrado!",
                "price.required" => "Preço não encontrado!",
                "price.decimal" => "Preço precisa um valor decimal!",
                "description.required" => "Descrição não encontrada!",
                "category.required" => "Categoria não encontrado!",
                "image.required" => "Imagem não encontrada!",
                "image.string" => "Imagem esperada como link(texto)!",
                "rate.required" => "Taxa não encontrada!",
                "count.required" => "Contagem não encontrado!",
                "count.integer" => "Contagem precisa ser um inteiro!",
            ]);

        if ($validator->fails()) {;
            $this->error("Erro ao importar os produtos!");
            foreach ($validator->errors()->all() as $key => $error) {
                $this->line("- $error");
            }
            exit;
        }


        if(Product::find($prod_id) != null){
            $this->error("Produto já importado!");
            exit;
        }

        //        $image = [
        //            "filepath" => Storage::disk('image_product')->path(''),
        //            "filename" => $response->object()->title,
        //            "file_extension" => $response->object()->price,
        //            "disk" => $response->object()->description,
        //        ];

        \DB::BeginTransaction();
        try {
            Product::create($record);
            //        $image = array_merge($image, ["product_id" => $product->id]);
            //        ImageProduct::create($image);
            DB::commit();
            $this->alert("Produtos importados com sucesso!");
        } catch (\Exception $e) {
            DB::rollBack();
            $this->error("Erro ao inserir os produtos inportados: " . $e->getMessage());
        }

    }

    private function getApiData (int $prod_id) {
        $response = Http::get("https://fakestoreapi.com/products/$prod_id");
        if ($response->clientError()) {
            $this->error("Erro de requisição! status: 400!");
        } else if ($response->serverError()) {
            $this->error("Erro do servidor! status: 500!");
        }
        return [
            "id" => $response->object()->id,
            "title" => $response->object()->title,
            "price" => $response->object()->price,
            "description" => $response->object()->description,
            "category" => $response->object()->category,
            "image" => $response->object()->image,
            "rate" => $response->object()->rating->rate,
            "count" => $response->object()->rating->count
        ];
    }
    private function getDiskData (int $prod_id) {
        $path = Storage::disk('products')->path('all_products.json');
        $json = file_get_contents($path);
        $response = json_decode(str_replace(["\r", "\n"], '', $json), true);

        if (!isset($response[$prod_id])) {
            $this->error("Produto com id $prod_id não econtrado!");
        }
        $response = (object)$response[$prod_id];
        return [
            "id" => $response->id,
            "title" => $response->title,
            "price" => $response->price,
            "description" => $response->description,
            "category" => $response->category,
            "image" => $response->image,
            "rate" => $response->rating['rate'],
            "count" => $response->rating['count']
        ];
    }


}
