<?php

namespace App\Http\Controllers;

use App\Models\Delivery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use App\Http\Requests\DeliveryRequest;


class DeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Deliveries/Index', [
            'deliveries' => Delivery::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Deliveries/Create');
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(DeliveryRequest $request)
    {

        try {
            Delivery::create($request->validated());
            return response()->json([
                'message' => 'Запись сохранена!'
            ]);
        } catch (\Exception $e) {
            return response()->json($e);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Delivery $delivery
     * @return \Illuminate\Http\Response
     */
    public function show(Delivery $delivery)
    {
        //
        return \Inertia\Inertia::render('Deliveries/Profile', [
            'delivery' => $delivery
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Delivery $delivery
     * @return \Illuminate\Http\Response
     */
    public function edit(Delivery $delivery)
    {
        return Inertia::render('Deliveries/Edit', [
            'delivery' => $delivery
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Delivery $delivery
     * @return \Illuminate\Http\Response
     */
    public function update(DeliveryRequest $request, Delivery $delivery)
    {

        try {
            $delivery->update($request->validated());
            return response()->json([
                'message' => 'Запись изменена!'
            ]);
        } catch (\Exception $e) {
            return response()->json($e);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Delivery $delivery
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Delivery $delivery)
    {

        try {
            $delivery->delete();
            return response()->json(['message' => 'Запись удалена!']);
        } catch (\Exception $e) {
            return response()->json($e);
        }

    }
}
