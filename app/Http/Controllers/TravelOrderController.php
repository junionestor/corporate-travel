<?php

namespace App\Http\Controllers;

use App\Exceptions\CanceledOrderException;
use App\Http\Requests\IndexTravelOrderRequest;
use App\Http\Requests\StoreTravelOrderRequest;
use App\Http\Requests\UpdateTravelOrderRequest;
use App\Services\TravelOrderService;
use Symfony\Component\HttpFoundation\Response;

class TravelOrderController extends Controller
{
    public function __construct(
        private readonly TravelOrderService $travelOrderService
    ) {}

    /**
     * @OA\Get(
     *     path="/order",
     *     summary="Get a list of travel orders",
     *     tags={"Travel Orders"},
     *
     *     @OA\Parameter(
     *         name="order_status_id",
     *         in="query",
     *         description="Status ID of the travel order",
     *         required=false,
     *         example=1,
     *
     *         @OA\Schema(type="string")
     *     ),
     *
     *     @OA\Parameter(
     *         name="start_date",
     *         in="query",
     *         description="Start date of the travel order",
     *         required=false,
     *         example="2025-02-10",
     *
     *         @OA\Schema(type="string", format="date")
     *     ),
     *
     *     @OA\Parameter(
     *         name="end_date",
     *         in="query",
     *         description="End date of the travel order",
     *         required=false,
     *         example="2025-01-28",
     *
     *         @OA\Schema(type="string", format="date")
     *     ),
     *
     *     @OA\Parameter(
     *       name="destination",
     *       in="query",
     *       description="Destination of the travel order",
     *       required=false,
     *       example="Belo Horizonte",
     *
     *       @OA\Schema(type="string")
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *
     *         @OA\JsonContent(
     *             type="array",
     *
     *             @OA\Items(ref="#/components/schemas/IndexTravelOrderRequest")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=500,
     *         description="Failed to get travel orders"
     *     )
     * )
     */
    public function index(IndexTravelOrderRequest $request)
    {
        try {
            $travelOrders = $this->travelOrderService->getOrders($request->validated());

            return response()->json($travelOrders, Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(
                ['message' => 'Failed to get travel orders'],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    /**
     * @OA\Post(
     *     path="/order",
     *     summary="Store a newly created travel order",
     *     tags={"Travel Orders"},
     *
     *     @OA\RequestBody(
     *         required=true,
     *
     *         @OA\JsonContent(ref="#/components/schemas/StoreTravelOrderRequest")
     *     ),
     *
     *     @OA\Response(
     *         response=201,
     *         description="Travel order created successfully",
     *
     *         @OA\JsonContent(
     *             type="object",
     *
     *             @OA\Property(property="message", type="string", example="Travel order created successfully")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=500,
     *         description="Failed to create travel order"
     *     )
     * )
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
     * @OA\Get(
     *     path="/order/{id}",
     *     summary="Display the specified travel order",
     *     tags={"Travel Orders"},
     *
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the travel order",
     *         required=true,
     *
     *         @OA\Schema(type="string")
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *
     *         @OA\JsonContent(
     *
     *           @OA\Property(property="id", type="integer", example=1),
     *           @OA\Property(property="travel_order_id", type="string", example=1),
     *           @OA\Property(property="name", type="string", example="Reyna"),
     *           @OA\Property(property="destination", type="string", example="Los Angeles"),
     *           @OA\Property(property="start_date", type="string", example="2025-02-10"),
     *           @OA\Property(property="end_date", type="string", example="2022-02-28"),
     *           @OA\Property(property="order_status_id", type="integer", example=1),
     *           @OA\Property(property="created_at", type="string", example="2025-02-10T12:00:00Z"),
     *           @OA\Property(property="updated_at", type="string", example="2025-02-28T12:00:00Z"),
     *           @OA\Property(property="user_id", type="integer", example="1")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=500,
     *         description="Failed to show travel order"
     *     )
     * )
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
     * @OA\Patch(
     *     path="/order",
     *     summary="Update the specified travel order",
     *     tags={"Travel Orders"},
     *
     *     @OA\RequestBody(
     *         required=true,
     *
     *         @OA\JsonContent(ref="#/components/schemas/UpdateTravelOrderRequest")
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Travel order updated successfully",
     *
     *         @OA\JsonContent(
     *             type="object",
     *
     *             @OA\Property(property="message", type="string", example="Travel order updated successfully")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=500,
     *         description="Failed to update travel order"
     *     )
     * )
     */
    public function update(UpdateTravelOrderRequest $request)
    {
        try {
            $this->travelOrderService->updateOrder($request->validated());

            return response()->json(
                ['message' => 'Travel order updated successfully'],
                Response::HTTP_OK
            );
        } catch (CanceledOrderException $e) {
            return response()->json(
                ['message' => $e->getMessage()],
                $e->getCode()
            );
        } catch (\Exception $e) {
            return response()->json(
                ['message' => 'Failed to update travel order'],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}
