<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use App\Models\Expense;
use App\Http\Requests\SaveExpenseRequest;



class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $expenses = Expense::latest()->get();
        return response()->json($expenses, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SaveExpenseRequest $request): JsonResponse
    {
        $expense = Expense::Create($request->validated());
        return response()->json($expense, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $expense = Expense::findOrFail($id);

        return response()->json($expense, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SaveExpenseRequest $request, string $id): JsonResponse
    {
        $expense = Expense::findOrFail($id);
        $expense -> update($request->validated());
        return response()->json($expense, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        $expense = Expense::findOrFail($id);
        $expense ->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);

    }
}
