<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Crude;
use App\Models\Product;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use App\Http\Requests\ProductRequest;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Products/Index', [
            'products' => Product::with('category', 'gender')->with('crudes')->orderBy('articul')->get(),
            'child' => Category::where('parent_id', 2)->get(),
            'man' => Category::where('parent_id', 4)->get(),
            'woman' => Category::where('parent_id', 3)->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sizes = array();

        for ($i = 1; $i <= 100; $i++) {
            //            $sizes[0]['id'] = "1";
            $sizes[$i - 1]['size'] = $i;
        }
        return Inertia::render('Products/Create', [
            'parents' => Product::where('parent_id', 0)->get(),
            'categories' => Category::with('subcategories')->whereNull('parent_id')->where('resource', '<>', 'post')->get(),
            'crudes' => Crude::select(Crude::raw("*, '20' as crude_qty"))->with('unit')->get(),
            'child' => Category::where('parent_id', 2)->get(),
            'man' => Category::where('parent_id', 4)->get(),
            'sizes' => $sizes,
            'woman' => Category::where('parent_id', 3)->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $product = Product::create($request->validated() + ['parent_id' => $request->id || 0]);
        $crudes = $request->get('crudes');

        foreach ($crudes as $crude) {
            $product->crudes()->attach($crude['id'], [
                'crude_qty' => $crude['crude_qty'],
                'crude_price' => $crude['price'],
            ]);
        }
        $sizes = $request->get('sizes');
        $color = $request->get('color');
            DB::table('product_sizes')->where('product_id', $product->id)->delete();

            foreach ($sizes as $size) {
                DB::table('product_sizes')->insert(
                    [
                        'product_id' => $product->id,
                        'size' => $size['size'],
                        'quantity' => $size['quantity'],
                        'color' => $color,
                    ]
                );
            }
        return response()->json([
            'message' => 'Запись сохранена!'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return \Inertia\Inertia::render('Products/Show', [
            'product' => $product->where('id', $product->id)->with('category', 'crudes')->first(),
            'units' => Unit::all()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Product $product
     * @return \Inertia\Response
     */
    public function edit($id)
    {
        $sizes = array();

        for ($i = 1; $i <= 100; $i++) {
            //            $sizes[0]['id'] = "1";
            $sizes[$i - 1]['size'] = $i;
        }

        $product = Product::with('parent', 'crudes')->find($id);
        $product['sizes'] = DB::select("SELECT size, quantity FROM product_sizes where product_id=" . $id);

        return Inertia::render('Products/Edit', [
            'product_data' => $product,
            'parents' => Product::where('parent_id', 0)->get(),
            'categories' => Category::with('subcategories')->whereNull('parent_id')->where('resource', '<>', 'post')->get(),
            'crudes' => Crude::select(Crude::raw("*, '20' as crude_qty"))->with('unit')->get(),
            'sizes' => $sizes,
            'child' => Category::where('parent_id', 2)->get(),
            'man' => Category::where('parent_id', 4)->get(),
            'woman' => Category::where('parent_id', 3)->get(),
            //            'currentSizes' => DB::select("SELECT size, quantity FROM product_sizes where product_id=" . $id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product)
    {
        try {
            $product->update($request->validated());
            $crudes = $request->get('crudes');

            DB::table('crude_product')->where('product_id', $product->id)->delete();

            foreach ($crudes as $crude) {
                $product->crudes()->attach($crude['id'], [
                    'crude_qty' => $crude['quantity'],
                    'crude_price' => $crude['price'],
                ]);
            }

            $sizes = $request->get('sizes');

            DB::table('product_sizes')->where('product_id', $product->id)->delete();

            foreach ($sizes as $size) {
                DB::table('product_sizes')->insert(
                    [
                        'product_id' => $product->id,
                        'size' => $size['size'],
                        'quantity' => $size['quantity'],
                    ]
                );
            }

            return response()->json([
                'message' => 'Данные обновлены',
                //            'description' => $request->description,
            ]);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {

        try {
            $product->delete();
            return response()->json(['message' => 'Запись удалена!']);
        } catch (\Exception $e) {
            return response()->json($e);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getProductsQuantity(Request $request)
    {
        return response()->json([
            'products' => DB::table('products')->select('*')->whereIn('id', $request)->get(),
        ]);
    }
}
