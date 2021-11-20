<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Status;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use App\Http\Requests\OrderRequest;
use Illuminate\Support\Facades\Auth;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Orders/Index', [
//            'orders'=> Order::with('client')->with('status')->with('products')->with('delivery')->get()
            'orders'=> Order::with('client','status','products','delivery')->where('status_id', '!=', 7)->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Orders/Create', [
            'clients' => User::all(),
            'statuses' => Status::all(),
        ]);
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderRequest $request)
    {
        try {
            Order::create($request->validated());
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
     * @param  \App\Models\Order $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return \Inertia\Inertia::render('Orders/Show', [
            'order' => $order->where('id', $order->id)->with('client', 'products', 'status')->first()
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        return Inertia::render('Orders/Edit', [
            'order' => $order,
            'clients' => User::all(),
            'statuses' => Status::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order $order
     * @return \Illuminate\Http\Response
     */
    public function update(OrderRequest $request, Order $order)
    {
        $status = $request->status_id;
        if($status === 7)
        {
            return $this->completed($order);
        }
        try {
            $order->update($request->validated());
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
     * @param  \App\Models\Order $order
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Order $order)
    {

        try {
            $order->delete();
            return response()->json(['message' => 'Запись удалена!']);
        } catch (\Exception $e) {
            return response()->json($e);
        }

    }

    /**
     * Update status of the specified resource in storage.
     *
     * @param  \App\Models\Order $order
     * @return \Illuminate\Http\Response
     */
    public function completed(Order $order)
    {
        $status=Status::where('id',7)->first();
        try {
            $order->update(['status_id' => 7]);
            // $user = Order::where('client_id', Auth::user()->id);
            $user = User::find($order->client_id);
            $total = $order->total;
            $ordersTotal = Order::with('products')->where('status_id','=',7)->where('client_id', Auth::user()->id)->get()->sum('total');

            
            if ($ordersTotal < 1000) {
                $active_bonus = json_decode(Auth::user()->bonus)[0];
                $cashback = $total * ($active_bonus/100);
            } else if ($ordersTotal < 2000) {
                $active_bonus = json_decode(Auth::user()->bonus)[1];
                $cashback = $total * ($active_bonus/100);
            } else if ($ordersTotal < 3000) {
                $active_bonus = json_decode(Auth::user()->bonus)[2];
                $cashback = $total * ($active_bonus/100);
            } else if ($ordersTotal < 10000) {
                $active_bonus = json_decode(Auth::user()->bonus)[3];
                $cashback = $total * ($active_bonus/100);
            } else if ($ordersTotal < 20000) {
                $active_bonus = json_decode(Auth::user()->bonus)[4];
                $cashback = $total * ($active_bonus/100);
            } else {
                $active_bonus = json_decode(Auth::user()->bonus)[4];
                $cashback = $total * ($active_bonus/100);
            };
            $user->update([
                'active_bonus' => $active_bonus,
                'cashback' => $user->cashback + $cashback
            ]);
            return response()->json([
                'message' => 'Заказ завершен!',
                'status' => $status
            ]);
        } catch (\Exception $e) {
            return response()->json($e);
        }

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function archive()
    {
        return Inertia::render('Orders/Archive', [
            'orders'=> Order::with('client','status','products','delivery')->where('status_id', 7)->get()
        ]);
    }

}
