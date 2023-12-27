<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *             title="API Documentation",
 *             version="1.0",
 *             description="Lifeline API Documentation"
 * )
 *
 * @OA\Server(url="http://localhost:8000")
 */
class Controller extends BaseController
{

    use AuthorizesRequests, ValidatesRequests;
}