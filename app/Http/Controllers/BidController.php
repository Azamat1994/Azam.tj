<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BidController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Bid/Index', [
            'bids'=> Bid::orderBy('id', 'desc')->get()
        ]);
    }
}
