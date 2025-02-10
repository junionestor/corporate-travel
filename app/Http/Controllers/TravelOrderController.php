<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTravelOrderRequest;
use App\Http\Requests\UpdateTravelOrderRequest;
use App\Services\TravelOrderService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TravelOrderController extends Controller
{
    public function __construct(
        private readonly TravelOrderService $travelOrderService
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $travelOrders = $this->travelOrderService->getOrders($request->toArray());

            return response()->json($travelOrders, Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(
                ['message' => 'Failed to get travel orders'],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTravelOrderRequest $request)
    {
        try {
            $this->travelOrderService->createOrder($request->validated());

            return response()->json(
                ['message' => 'Travel order created successfully'],
                Response::HTTP_CREATED
            );
        } catch (\Exception $e) {
            return response()->json(
                ['message' => 'Failed to create travel order'],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $travelOrder = $this->travelOrderService->showOrder($id);

            return response()->json($travelOrder, Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(
                ['message' => 'Failed to show travel order'],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTravelOrderRequest $request)
    {

        try {
            $this->travelOrderService->updateOrder($request->validated());

            return response()->json(
                ['message' => 'Travel order updated successfully'],
                Response::HTTP_OK
            );
        } catch (\Exception $e) {
            return response()->json(
                ['message' => 'Failed to update travel order'],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}
