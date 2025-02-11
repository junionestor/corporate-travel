<?php

namespace App\Http\Controllers;

/**
 * @OA\OpenApi(
 *
 *   @OA\Info(
 *     version="1.0",
 *     title="Corporate Travel API",
 *   ),
 *
 *   @OA\Server(
 *      url="/api"
 *   ),
 *
 *  @OA\Components(
 *
 *   @OA\SecurityScheme(
 *     securityScheme="bearerAuth",
 *     type="http",
 *     scheme="bearer",
 *     bearerFormat="JWT"
 *   )
 *  ),
 *   security={
 *       {"bearerAuth": {}}
 *   },
 *
 *   @OA\PathItem(path="/api")
 * )
 */
abstract class Controller
{
    //
}
