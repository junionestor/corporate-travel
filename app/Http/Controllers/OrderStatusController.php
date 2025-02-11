<?php

namespace App\Http\Controllers;

use App\Services\OrderStatusService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OrderStatusController extends Controller
{
    public function __construct(private readonly OrderStatusService $orderStatusService) {}

    /**
     * @OA\Get(
     *     path="/order-status",
     *     summary="Get order statuses",
     *     tags={"Order Status"},
     *     @OA\Parameter(
     *         name="id",
     *         in="query",
     *         required=false,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Parameter(
     *         name="name",
     *         in="query",
     *         required=false,
     *         @OA\Schema(type="string", example="Solicitado")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *           @OA\Property(property="id", type="integer", example=1),
     *           @OA\Property(property="name", type="string", example="Solicitado"),
     *           @OA\Property(property="created_at", type="string", example="2025-02-10T00:00:00.000000Z"),
     *           @OA\Property(property="updated_at", type="string", example="2025-02-11T00:00:00.000000Z")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Failed to get order statuses"
     *     )
     * )
     */
    public function index(Request $request)
    {
        try {
            $orderStatuses = $this->orderStatusService->getOrderStatus($request->all());

            return response()->json($orderStatuses, Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(
                ['message' => 'Failed to get order statuses'],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}
