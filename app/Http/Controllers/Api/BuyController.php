<?php

namespace App\Http\Controllers\Api;

use App\Models\Racket;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class BuyController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('user');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'racket' => ['required','numeric'],
            'quantity' => ['required','numeric']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'code' => 422,
                'status' => 'error',
                'message' => 'data not match with our validation',
                'data' => $validator->errors()
            ], 422);
        }

        $validated = $validator->getData();

        $racket = Racket::where('id', $validated['racket'])->get()->first();

        if ($racket == null) {
            return response()->json([
                'code' => 404,
                'status' => 'error',
                'message' => 'data not found in our database'
            ], 404);
        }

        $transaction = Transaction::create([
            'buyer' => auth('sanctum')->user()->id,
            'purchase_date' => now()->format('Y-m-d'),
            'racket' => $racket->id,
            'quantity' => $validated['quantity']
        ]);

        return response()->json([
            'code' => 202,
            'status' => 'success',
            'message' => 'data created successfully',
            'data' => $transaction
        ], 202);
    }
}