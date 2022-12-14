<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\OrderRequest;
use App\Repositories\Order\OrderInterface;
use App\Service\Translator;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController as BaseController;
use Validator;
use App\Http\Resources\OrderResource;

class OrderController extends BaseController
{
    use ApiResponse;

    private OrderInterface $orderRepository;

    public function __construct(OrderInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function index()
    {
        $order = $this->orderRepository->all();
        return $this->success([
            $order
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->json()->all();
        if ($data == []) {
            return response()->json([
                'message' => 'Your request json object is empty. This probably means your json is invalid',
                'success' => false,
            ]);
        }

        $validator = new OrderRequest($data);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'success' => false,
                'errors' => $validator->errors(),
            ]);
        }
        $data = $validator->validated();
        $order = $this->orderRepository->create($data);

        return $this->success([$order],'Order Message');

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Order $Order
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = $this->orderRepository->find($id);

        if (is_null($order)) {
            return $this->error('Error','200',[
                Translator::ORDER_NOT_FOUND
            ]);
        }
        return $this->success([
            new OrderResource($order)
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Order $Order
     * @return \Illuminate\Http\Response
     */
    public function update(OrderRequest $request, $id)
    {

       //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Order $Order
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $order = $this->orderRepository->delete($id);
        return $this->success('Success',[
            new OrderResource($order)
        ],200);
    }
}
