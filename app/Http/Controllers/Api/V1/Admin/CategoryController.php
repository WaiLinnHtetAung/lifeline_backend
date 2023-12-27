<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="Category",
 *     description="Operations about categories",
 * )
 */
class CategoryController extends Controller
{
    /**
     * Get List of Category
     * @OA\Get (
     *     path="/api/v1/categories",
     *     tags={"Category"},
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *     )
     * )
     */
    public function index()
    {

        $categories = Category::all();

        return response()->json([
            'categories' => $categories
        ]);
    }

}