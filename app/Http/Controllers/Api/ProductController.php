<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\ProductSizeRequest;
use App\Models\Product;
use App\Models\ProductSize;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products=Product::from('products as products')->with('category','gender','color','season','orders','crudes','parent');
        if($request->has('pr_start') && $request->get('pr_start')>0){
            $products=$products->where('products.price','<=',$request->get('pr_start'));
        }
        if($request->has('pr_end') && $request->get('pr_end')>0){
            $products=$products->where('products.price','>=',$request->get('pr_end'));
        }
        if($request->has('order')){
            $products=$products->orderBy('products.'.$request->get('order'));
        }
        if($request->has('nalichi') && $request->get('nalichi')>0){
            $products=$products->where('products.quantity','=',$request->get('nalichi'));
        }
        if($request->has('shop') && $request->get('shop')>0){
            $products=$products->join('warehouse_product as wp','products.id','wp.product_id')->where('wp.warehouse_id','=',$request->get('shop'));
        }
        $products=$products->get();

        return response()->json($products, 200);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
//    public function create()
//    {
//        return view('product.create');
//    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        try{
            $product = Product::create($request->all());
            return response()->json($product, 201);
        }catch(\Exception $ex){
            return response()->json($ex.getMessage(),201);
        }
        return response()->json('Error to save',201);
    }

    public function show($id)
    {
        $product = Product::find($id);
        if(is_null($product)){
            return response()->json(["message" => "Record not found!"], 404);
        }
        return response()->json($product, 201);
    }
    public function quantity($id)
    {
        $quantity = ProductSize::selectRaw('size,sum(quantity) as quantity')
            ->where('product_id',$id)
            ->GroupBy('size')
            ->get();
        if(is_null($quantity)){
            return response()->json(["message" => "Record not found!"], 404);
        }
        return response()->json($quantity, 201);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getByArticul($articul)
    {
        $data = Product::where('articul', $articul)->get();

        if(is_null($data)){
            return response()->json(["message" => "Record not found!"], 404);
        }
        return response()->json($data, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
//    public function edit($id)
//    {
//        $product = Product::find($id);
//        return view('products.edit', compact('product'));
//    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $product = Product::find($id);
        if(is_null($product)){
            return response()->json(["message" => "Record not found!"], 404);
        }
        $product->update($request->all());

        return response()->json($product, 200);
    }
    public function addQuantity(ProductSizeRequest $request)
    {

        try{
            $product_size=DB::select('select quantity from product_sizes where product_id='.$request->product_id.' and size='.$request->size.' limit 1');
            if(count($product_size)>0){
                $update= DB::select('update product_sizes set quantity='.($product_size[0]->quantity+$request->quantity).' where product_id='.$request->product_id.' and size='.$request->size);
                $product_size=DB::select('select * from product_sizes where product_id='.$request->product_id.' and size='.$request->size.' limit 1');
                return response()->json($product_size, 201);
            }
            $product_size = ProductSize::create($request->all());
            return response()->json($product_size, 201);
        }catch(\Exception $ex){
            return response()->json($ex->getMessage(),201);
        }
        return response()->json('Error to save',201);
    }
    public function deleteQuantity(ProductSizeRequest $request)
    {
        try{
            $product_size=DB::select('select quantity from product_sizes where product_id='.$request->product_id.' and size='.$request->size.' limit 1');
            if(count($product_size)>0 && $product_size[0]->quantity>$request->quantity){
                $update= DB::select('update product_sizes set quantity='.($product_size[0]->quantity-$request->quantity).' where product_id='.$request->product_id.' and size='.$request->size);
                $product_size=DB::select('select * from product_sizes where product_id='.$request->product_id.' and size='.$request->size.' limit 1');
                return response()->json($product_size, 201);
            }
            return response()->json('В складе нет '.$request->quantity. ' товаров!!!',201);
        }catch(\Exception $ex){
            return response()->json($ex->getMessage(),201);
        }
        return response()->json('Error to save',201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        if(is_null($product)){
            return response()->json(["message" => "Record not found!"], 404);
        }
        $product->delete();
        return response()->json(null, 204);
    }

//    public function search($name)
//    {
//        $data = Product::where('name', 'like', '%'.$name.'%')->get();
//        if(is_null($data)){
//            return response()->json(["message" => "Record not found!"], 404);
//        }
//        return response()->json($data, 200);
//    }

    public function mostSoldProduct()
    {
        $data = DB::select('SELECT p.name, count(*) as total FROM order_product as op
            LEFT JOIN products as p on p.id = op.product_id
            group BY p.id order by total DESC');

        return response()->json($data);
    }
    public function saveImages(Request $request,$id)
    {
        $images=json_decode($request->images);
        try{
            $path = [];
            if ($request->has('images') && $images[0] != '') {
                foreach ($images as $image) {
                    // $image = $request->image;  // your base64 encoded
                    $pos  = strpos($image, ';');
                    $type = explode(':', substr($image, 0, $pos))[1];
                    $type1 = substr($type, 6, strlen($type));
                    $imageName = date('Y-m-d_H-i-s').'_'.Str::random(10) . '.' . $type1;
                    $image = str_replace('data:image/' . $type1 . ';base64,', '', $image);

                    Storage::disk('products')->put($imageName, base64_decode($image));
                    $path[] = 'images/products/' . $imageName;
                }
            }
            $product = Product::find($id);
            $product->image=$path;
            $product->update();
            return response()->json($product, 201);
        }catch(\Exception $ex){
            return response()->json($ex->getMessage(),201);
        }
        return response()->json('Error to save',201);
    }
    public function deleteImages(Request $request,$id)
    {
        try{
            $product = Product::find($id);
            $product->image="";
            $product->update();
            return response()->json($product, 201);
        }catch(\Exception $ex){
            return response()->json($ex->getMessage(),201);
        }
        return response()->json('Error to save',201);
    }
    public function crude(Request $request)
    {
        try{
            $crude_product=DB::select('select * from crude_product where product_id='.$request->product_id.' and crude_id='.$request->crude_id.' limit 1');
            if(count($crude_product)>0){
                $update= DB::select('update crude_product set crude_qty='.($request->crude_qty).', crude_price='.($request->crude_price).' where product_id='.$request->product_id.' and crude_id='.$request->crude_id);
                $crude_product=DB::select('select * from crude_product where product_id='.$request->product_id.' and crude_id='.$request->crude_id.' limit 1');
                return response()->json($crude_product, 201);
            }
            $update= DB::select('insert into crude_product VALUES('.$request->crude_id.','.$request->product_id.','.$request->crude_qty.','.$request->crude_price.',"'.Carbon::now().'", NULL)');
            $crude_product=DB::select('select * from crude_product where product_id='.$request->product_id.' and crude_id='.$request->crude_id.' limit 1');
            return response()->json($crude_product, 201);
        }catch(\Exception $ex){
            return response()->json($ex->getMessage(),201);
        }
        return response()->json('Error to save',201);
    }
}
