<?php


namespace App\Repositories\Order;


use App\Abstracts\OrderRequest;
use App\Jobs\DiscountProcess;
use App\Models\Order;
use App\Traits\HasErrors;

class OrderRepository extends OrderRequest implements OrderInterface
{
    use HasErrors;

    protected $model;

    public function __construct(Order $order)
    {
        $this->model = $order;
    }


    public function all()
    {
        $orders = $this->model->all();
        return $orders;
    }

    public function create(array $data)
    {
        $message = [];
        foreach ($data as $item)
        {
            $this->stockControl($item['items']);
            if ($this->hasErrors()) {
                $message[$item['id']] = $this->getErrors();
            }

            $order = new $this->model;
            $order->customerId = $item['customerId'];
            $order->total = $item['total'];
            $order->items = json_encode($item['items']);
            $order->save();
            $message[$item['id']] = $order;
            dispatch(new DiscountProcess($item,$order->id));
        }
        return $message;
    }

    public function update(array $data)
    {

    }

    public function delete($id)
    {
        $order = $this->model->find($id);
        $order->delete();
    }

    public function find($id)
    {
        return $this->model->find($id);
    }
}
