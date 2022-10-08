<?php


namespace App\Repositories\Category;


use App\Models\Category;

class CategoryRepository implements CategoryInterface
{
    protected $model;

    public function __construct(Category $category)
    {
        $this->model = $category;
    }

    public function all()
    {
        $category = $this->model->all();
        return $category;
    }

    public function create(array $data)
    {
        foreach ($data as $item) {
            if (isset($item['id'])) {
                $this->update($item);
            } else {
                $category = new $this->model;
                $category->name = $item['name'];
                $category->save();
            }
        }

        return $category;
    }

    public function update(array $data)
    {
        $category = $this->model->find($data['id']);
        $category->name = $data->name;
        $category->save();
        return $category;
    }

    public function delete($id)
    {
        $category = $this->model->find($id);
        $category->delete();
    }

    public function find($id)
    {
        return $this->model->find($id);
    }
}
