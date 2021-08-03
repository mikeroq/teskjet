<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Http\Requests\CustomerValidationRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('customers.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //return view("customers.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(CustomerValidationRequest $request)
    {
        $taxable = $request->get('taxable') == "true" ? 1 : 0;
        try {
            $phone = phone($request->get('phone'), $country = ['AUTO'], $format = 'E164');
            $customer = new Customer([
                'name' => $request->get('name'),
                'phone'=> $phone,
                'type'=> $request->get('type'),
                'taxable'=> $taxable
            ]);
            $customer->save();
            return response()->json([
                'success' => true,
                'insert' => $customer->id
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Customer $customer
     * @return Application|Factory|View|void
     */
    public function show(Customer $customer)
    {
        // dd($customer->type);
        return view('customers.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(CustomerValidationRequest $request, int $id)
    {
        $customer = Customer::find($id);
        try {
            $customer->name = $request->get('name');
            $customer->phone = $request->get('phone');
            $customer->type = $request->get('type');
            $customer->taxable = $request->has('taxable');
            $customer->save();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id)
    {
        $customer = Customer::find($id);
        try {
            $customer->delete();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e]);
        }
    }
}
