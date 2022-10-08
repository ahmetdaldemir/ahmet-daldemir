<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\CustomerRequest;
use App\Repositories\Customer\CustomerInterface;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController as BaseController;
use App\Http\Resources\CustomerResource;

class CustomerController extends BaseController
{
    use ApiResponse;

    private CustomerInterface $customerRepository;

    public function __construct(CustomerInterface $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    public function index()
    {
        $customer = $this->customerRepository->all();
        return $this->success([
            $customer
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
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

        $validator = new CustomerRequest($data);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'success' => false,
                'errors' => $validator->errors(),
            ]);
        }
        $data = $validator->validated();
        $customer = $this->customerRepository->create($data);

        return $this->success([
            new CustomerResource($customer)
        ],'Customer Saved');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Customer $Customer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer = $this->customerRepository->find($id);
        if (is_null($customer)) {
            return $this->error('Error','404',[
                'Customer not found.'
            ]);
        }
        return $this->success([
            $customer
        ]);
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Customer $Customer
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $customer = $this->customerRepository->delete($id);
        return $this->success([
            new CustomerResource($customer)
        ],'Customer Deleted.');
    }
}
