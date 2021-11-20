<?php

namespace App\Http\Controllers;

use App\Mail\ComplaintMail;
use App\Mail\ConfirmMail;
use App\Models\Bid;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Partner;
use App\Models\Post;
use App\Models\Shop;
use App\Models\Product;
use App\Models\Slider;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;
use PhpParser\Node\Expr\Cast\Object_;
use stdClass;

class HomeController extends Controller
{
    public function index()
    {
        $lastProducts = Product::where('is_active', true)->orderBy('id', 'desc')->limit(4)->get();
        $saleProducts = Product::where('is_active', true)->where('sale', '<>', '0')->orderBy('id', 'desc')->limit(4)->get();
        $patrtners = Partner::where('is_active', true)->get();
        $sliders = Slider::where('is_active', true)->orderBy('id', 'desc')->limit(3)->get();
        $catshoes = Category::where('resource', 'shoes')->first();
        return Inertia::render('Home/Index', [
            'lastProducts' => $lastProducts,
            'saleProducts' => $saleProducts,
            'patrtners' => $patrtners,
            'sliders' => $sliders,
            'shoes' => Post::whereHas('categories', function ($q) use ($catshoes) {
                $q->where('category_id', $catshoes->id);
            })->first(),
            'cartData' => session()->get('cart') ? session()->get('cart') : new stdClass()
        ]);
    }

    public function repairs()
    {
        return Inertia::render('Home/Repairs', [
            'cartData' => session()->get('cart') ? session()->get('cart') : new stdClass()
        ]);
    }

    public function repairsBid(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'type' => 'required',
            'phone' => 'required',
            'image' => 'required',
        ]);

        if ($request->file('image')) {
            $file = $request->file('image')->store('posts', ['disk' => 'public']);
        }

        Bid::create([
            'name' => $request->name,
            'type' => $request->type,
            'phone' => $request->phone,
            'image' => $file,
        ]);

        return response()->json([
            'message' => 'Ваша заявка принята'
        ]);
    }

    public function partnerBid(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'phone' => 'required',
            'city' => 'required',
        ]);


        Bid::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'city' => $request->city,
            'type' => 2,
        ]);

        return response()->json([
            'message' => 'Ваша заявка принята'
        ]);
    }

    public function about()
    {
        $category = Category::where('resource', 'about')->first();
        return Inertia::render('Home/About', [
            'about' => Post::whereHas('categories', function ($q) use ($category) {
                $q->where('category_id', $category->id);
            })->where('is_active', true)->latest()->first(),
            'cartData' => session()->get('cart') ? session()->get('cart') : new stdClass()
        ]);
    }

    public function massMedia()
    {
        $category = Category::where('resource', 'mass')->first();
        return Inertia::render('Home/MassMedia', [
            'news' => Post::whereHas('categories', function ($q) use ($category) {
                $q->where('category_id', $category->id);
            })->where('is_active', true)->latest()->get(),
            'cartData' => session()->get('cart') ? session()->get('cart') : new stdClass()
        ]);
    }


    public function filterByCategoryId(Request $request, $id)
    {
        $products = Product::where('is_active', 1);
        return Inertia::render('Home/Filter', [
            'productsData' => $products->latest()->get(),
            // 'categories' => Category::with('subcategories')->whereNull('parent_id')->where('resource', '<>', 'post')->get(),
            'categories' => Category::with('subcategories')->whereIn('parent_id', array(2, 3, 4))->get(),
            'cartData' => session()->get('cart') ? session()->get('cart') : new stdClass(),
            'categoryId' => $id,
        ]);
    }


    public function filter(Request $request)
    {
        $products = Product::where('is_active', 1);
        if ($request->q) {
            $products->where('name', 'like', "%$request->q%");
        }
        if ($request->ajax) {
            if ($request->price) {
                $products->whereBetween('price', [0, $request->price]);
            }
            if ($request->color) {
                $products->where('color', $request->color);
            }
            if ($request->category) {
                $products->where('category_id', $request->category);
            }
            if ($request->size) {
                $products->whereHas('sizes', function($q) use($request) {$q->where('size', $request->size);});
                //$products->where('size', $request->size);
            }
            if ($request->season) {
                $products->whereIn('season', explode(",", $request->season));
            }
            if ($request->gender_id) {
                $products->where('gender_id', $request->gender_id);
            }
            return response()->json([
                'products' => $products->latest()->get(),
            ]);
        }
        return Inertia::render('Home/Filter', [
            'productsData' => $products->latest()->get(),
            'categories' => Category::with('subcategories')->whereNull('parent_id')->where('resource', '<>', 'post')->get(),
            'cartData' => session()->get('cart') ? session()->get('cart') : new stdClass(),
            'q' => $request->q
        ]);
    }

    public function contacts()
    {
        $cat = Category::where('resource', 'about')->first();
        return Inertia::render('Home/Contacts', [
            'abouts' => Post::whereHas('categories', function ($q) use ($cat) {
                $q->where('category_id', $cat->id);
            })->get(),
            'cartData' => session()->get('cart') ? session()->get('cart') : new stdClass(),
            'shops'=> Shop::all(),
        ]);
    }

    public function showProduct($slug)
    {
        $product = Product::with('parent', 'category', 'color', 'season', 'sizes')->where('is_active', 1)->where('slug', $slug)->first();
        $recomended = Product::where('parent_id', '<', $product->id)->where('is_active', 1)->orderBy('parent_id')->limit(4)->get();
        return Inertia::render('Home/Product', [
            'product' => $product,
            'comments' => Comment::with('user')->where('product_id', $product->id)->orderBy('created_at', 'DESC')->get(),
            'recomended' => $recomended,
            'cartData' => session()->get('cart') ? session()->get('cart') : new stdClass()
        ])->withViewData(['meta' => [
            'image' => '/storage/' . $product->image[0]['fileName'],
        ]]);
    }

    public function news()
    {
        return Inertia::render('Home/Contacts', [
            'cartData' => session()->get('cart') ? session()->get('cart') : new stdClass()
        ]);
    }

    public function addToCart(Request $request, $id)
    {
        try {
            $product = Product::find($id);
            if (!$product) {
                abort(404);
            }
            $cart = session()->get('cart') ? session()->get('cart') : [];

            $temp_size_quantity = [];

            if (isset($cart[$id])) {
                $temp_size_quantity = $cart[$id]['size_quantity'];
            }


            $temp['size'] = $request->size;
            $temp['quantity'] = $request->quantity;

            $temp_size_quantity[] = $temp;

            $cart[$id] = [
                "id" => $product->id,
                "slug" => $product->slug,
                "name" => $product->name,
                "price" => $product->price * (1 - $product->sale / 100),
                "image" => $product->image,
                // "quantity" => $request->quantity ? $request->quantity : 3,
                // "size" => $request->size,
                'size_quantity' => $temp_size_quantity,
            ];
            session()->put('cart', $cart);
            return response()->json([
                'cart' => $cart,
            ]);
        } catch (\Exception $e) {
            return response()->json($e);
        }
    }

    public function removeCart(Request $request)
    {
        if ($request->clear) {
            $cart = session()->put('cart', []);
        } else {
            $cart = session()->get('cart') ? session()->get('cart') : [];
            // unset($cart[$request->id]);

            if (count($cart[$request->productId]['size_quantity']) == 1) {
                unset($cart[$request->productId]);
            } else {
                array_splice($cart[$request->productId]['size_quantity'], $request->indexSize, 1);
                // unset($cart[$request->productId]['size_quantity'][$request->indexSize]);
            }

            session()->put('cart', $cart);
        }
        return response()->json([
            'cart' => $cart ? $cart : new stdClass(),
            // 'cartProductsCount' => count($cart[$request->productId]['size_quantity']),
            // 'productId' => $request->productId,
            // 'indexSize' => $request->indexSize,
            // 'productToDelete' => $cart[$request->productId],
            // 'sizeQuantityToDelete' => $cart[$request->productId]['size_quantity'][$request->indexSize],
        ]);
    }

    public function setQuantity(Request $request, $type)
    {
        // $product = Product::find($request->id);
        // if(!$product) {
        //     abort(404);
        // }
        $cart = session()->get('cart') ? session()->get('cart') : [];
        if (!is_null($cart)) {
            if ($type === 'minus') {
                // $cart[$request->id]['size_quantity']['quantity'] =  ? $request->quantity - 1 : $request->quantity + 1;
                $cart[$request->id]['size_quantity'][$request->indexsize]['quantity'] = $cart[$request->id]['size_quantity'][$request->indexsize]['quantity'] - 1;
            } else {
                $cart[$request->id]['size_quantity'][$request->indexsize]['quantity'] = $cart[$request->id]['size_quantity'][$request->indexsize]['quantity'] + 1;
            }
        }
        session()->put('cart', $cart);
        return response()->json([
            'cart' => $cart ? $cart : new stdClass()
        ]);
    }

    public function sendComplaint(Request $request)
    {
        //        Mail::to($request->email)->send(new ComplaintMail($request->name, $request->email, $request->text));
        if (filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            Mail::to('islomifaridun@gmail.com')->send(new ComplaintMail($request->name, $request->email, $request->text));
            return response()->json([
                'name2' => $request->name,
                'email' => $request->email,
                'text' => $request->text
            ]);
        }
    }

    public function sizeTable()
    {
        return Inertia::render('Home/SizeTable', [
            'cartData' => session()->get('cart') ? session()->get('cart') : new stdClass()
        ]);
    }

    public function help()
    {
        return Inertia::render('Home/Help', [
            'cartData' => session()->get('cart') ? session()->get('cart') : new stdClass()
        ]);
    }

    public function delivery()
    {
        return Inertia::render('Home/Delivery', [
            'cartData' => session()->get('cart') ? session()->get('cart') : new stdClass()
        ]);
    }

    public function return()
    {
        return Inertia::render('Home/Return', [
            'cartData' => session()->get('cart') ? session()->get('cart') : new stdClass()
        ]);
    }

    public function thankYou()
    {
        return Inertia::render('Home/ThankYou', [
            'cartData' => session()->get('cart') ? session()->get('cart') : new stdClass()
        ]);
    }
}
