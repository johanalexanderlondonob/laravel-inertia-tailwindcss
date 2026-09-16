<?php

namespace App\Http\Controllers;

use App\Arketops\Customer\CustomerRepository;
use App\Http\Resources\CustomerResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    protected CustomerRepository $customerRepo;

    public function __construct(CustomerRepository $customerRepository)
    {
        $this->customerRepo = $customerRepository;
    }

    public function all(): JsonResponse
    {
        return (CustomerResource::collection($this->customerRepo->getAll()))->response();
    }

    public function search(int $customer, Request $request)
    {
        if ($request->wantsJson()) {
            return (new CustomerResource($this->customerRepo->find($customer)))->response();
        }
    }
}
