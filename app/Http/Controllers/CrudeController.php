<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Inertia\Inertia;
use App\Models\Crude;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\CrudeRequest;

class CrudeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Crudes/Index', [
            'crudes' => Crude::with('unit')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Crudes/Create', [
            'units' => Unit::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CrudeRequest $request)
    {
        try {
            Crude::create($request->validated());
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
     * @param \App\Models\Crude $crude
     * @return \Illuminate\Http\Response
     */
    public function show(Crude $crude)
    {
        return Inertia::render('Crudes/Profile', [
            'crude' => $crude
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Crude $crude
     * @return \Illuminate\Http\Response
     */
    public function edit(Crude $crude)
    {
        return Inertia::render('Crudes/Edit', [
            'crude_data' => $crude,
            'units' => Unit::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Crude $crude
     * @return \Illuminate\Http\Response
     */
    public function update(CrudeRequest $request, Crude $crude)
    {
        try {
            $crude->update($request->validated());

            $sizes = $request->get('sizes');

            DB::table('crude_sizes')->where('crude_id', $crude->id)->delete();

            foreach ($sizes as $size) {
                DB::table('crude_sizes')->insert([
                        'crude_id' => $crude->id,
                        'size' => $size['name'],
                        'quantity' => $size['quantity'],
                    ]
                );
            }

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
     * @param \App\Models\Crude $crude
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Crude $crude)
    {

        try {
            $crude->delete();
            return response()->json(['message' => 'Запись удалена!']);
        } catch (\Exception $e) {
            return response()->json($e);
        }

    }


    /**
     * Upload image to storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function uploadFiles(Request $request)
    {

        if ($request->file('file')) {
            $file = $request->file('file')->store('users', ['disk' => 'public']);
        }
        return response()->json(['fileName' => $file]);
    }
}
