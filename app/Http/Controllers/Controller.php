<?php

namespace App\Http\Controllers;

/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="MTC App Api",
 *      description="MTC Application OpenApi Documentation",
 *      @OA\Contact(
 *          email="aminetemadifar.w@gmail.com"
 *      ),
 * )
 * @OA\SecurityScheme(
 *      scheme="bearer",
 *      securityScheme="bearerAuth",
 *      type="http",
 *      description="Enter your Bearer token",
 *      in="header",
 *      bearerFormat="JWT",
 *  )
 * @OA\Server(
 *      url="https://api.honarisho.com/api",
 *      description="localhost"
 * )
 *
 */
abstract class Controller
{
    //
}
