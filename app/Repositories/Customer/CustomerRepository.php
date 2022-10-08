<?php


namespace App\Repositories\Customer;


use App\Models\Customer;

class CustomerRepository implements CustomerInterface
{
    protected $model;

    public function __construct(Customer $customer)
    {
        $this->model = $customer;
    }


    public function all()
    {
        $customer = $this->model->all();
        return $customer;
    }

    public function create(array $data)
    {
        $x = [];
        foreach ($data as $item) {
            if (isset($item['id'])){
               $x[] = $this->update($data);
            }
            {
                $request = new $this->model;
                $request->name = $item['name'];
                $request->since = $item['since'];
                $request->revenue = $item['revenue'];
                $x[] = $request->save();
            }
        }

        return $x;
    }

    public function update(array $data)
    {
        $customer = $this->model::find($data['id']);
        $customer->name = $data['name'];
        $customer->since = $data['since'];
        $customer->revenue = $data['revenue'];
        $customer->save();
        return $customer;
    }

    public function delete($id)
    {
        $customer = $this->model->find($id);
        $customer->delete();
    }

    public function find($id)
    {
        return $this->model::find($id);
    }
}
