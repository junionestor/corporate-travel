<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTravelOrderRequest;
use App\Models\TravelOrder;
use App\Services\TravelOrderService;
use Illuminate\Http\Request;

class TravelOrderController extends Controller
{
    public function __construct(
        private readonly TravelOrderService $travelOrderService
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTravelOrderRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(TravelOrder $travelOrder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TravelOrder $travelOrder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TravelOrder $travelOrder)
    {
        //
    }
}
