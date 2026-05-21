<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ministry;
use Illuminate\Http\JsonResponse;

class MinistryApiController extends Controller
{
    public function index(): JsonResponse
    {
        $ministries = Ministry::active()->ordered()->get();
        return response()->json($ministries);
    }

    public function show(string $slug): JsonResponse
    {
        $ministry = Ministry::active()->where('slug', $slug)->firstOrFail();
        return response()->json($ministry);
    }
}
