<?php

namespace App\Controllers\API;

use CodeIgniter\RESTful\ResourceController;
use OpenApi\Annotations as OA;

/**
 * @OA\Info(
 *     title="PoinMarket API Documentation",
 *     version="1.0.0",
 *     description="API Documentation for PoinMarket Application"
 * )
 */
class ProductController extends ResourceController
{
    /**
     * @OA\Get(
     *     path="/api/products",
     *     tags={"Products"},
     *     summary="Get list of products",
     *     @OA\Parameter(
     *         name="page",
     *         in="query",
     *         description="Page number",
     *         required=false,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Product")
     *         )
     *     )
     * )
     */
    public function index()
    {
        // Implementation
    }

    /**
     * @OA\Post(
     *     path="/api/products",
     *     tags={"Products"},
     *     summary="Create a new product",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Product")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Product created successfully"
     *     )
     * )
     */
    public function create()
    {
        // Implementation
    }
}

/**
 * @OA\Schema(
 *     schema="Product",
 *     required={"name", "price"},
 *     @OA\Property(property="id", type="integer"),
 *     @OA\Property(property="name", type="string"),
 *     @OA\Property(property="price", type="number"),
 *     @OA\Property(property="description", type="string")
 * )
 */
