<?php


namespace App\Repositories\Product;

use App\Models\Product;

class ProductRepository implements ProductInterface
{
    protected $model;

    public function __construct(Product $product)
    {
        $this->model = $product;
    }

    public function all()
    {
        $product = $this->model->all();
        return $product;
    }

    public function create(array $data)
    {
        $x = [];
        foreach ($data as $item) {
            if (isset($item['id'])) {
                $x[] = $this->update($data);
            }else
            {
                $product = new $this->model;
                $product->name = $item['name'];
                $product->category = $item['category'];
                $product->price = $item['price'];
                $product->stock = $item['stock'];
                $x[] = $product->save();
            }
        }

        return $x;
    }

    public function update(array $data)
    {
        $product = $this->model::find($data['id']);
        $product->name = $data->name;
        $product->category = $data->category;
        $product->price = $data->price;
        $product->stock = $data->stock;
        $product->save();
        return $product;
    }

    public function delete($id)
    {
        $product = $this->model::find($id);
        $product->delete();
    }

    public function find($id)
    {
        return $this->model::find($id);
    }
}
