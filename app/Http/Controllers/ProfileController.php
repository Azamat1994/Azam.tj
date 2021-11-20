<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use stdClass;

class ProfileController extends Controller
{
    public function profile()
    {
        return Inertia::render('Home/Profile/Index', [
            'cartData' => session()->get('cart') ? session()->get('cart') : new stdClass()
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => "required",
        ]);

        $user = User::find(Auth::user()->id);

        $user->update([
            'name' => trim($request->name)
        ]);

        if (filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            if (User::where('email', $request->email)->count() > 0) {
                return response()->json([
                    'message' => 'Пользователь с таким e-mail уже существует'
                ], 403);
            } else {
                $user->update([
                    'email' => trim($request->email)
                ]);
            }
        }

        if ($request->phone) {
            if (User::where('phone', $request->phone)->count() > 0) {
                return response()->json([
                    'message' => 'Пользователь с таким номером уже существует'
                ], 403);
            } else {
                $user->update([
                    'phone' => trim($request->phone)
                ]);
            }
        }

        if (!is_null($request->new_password) && $request->new_password === $request->confirm_password) {
            if (Hash::check($request->password, $user->password)) {
                $user->update([
                    'password' => trim($request->new_password)
                ]);
                $login = $user->email ? 'email' : 'phone';
                Auth::attempt([$login => $login === 'email' ? $user->email : $user->phone, 'password' => trim($request->new_password), 'is_active' => true]);
            } else {
                return response()->json([
                    'message' => 'Введен неправильный пароль'
                ], 403);
            }
        }

        return response()->json([
            'message' => 'Данные обновлены'
        ]);
    }

    public function history()
    {
        return Inertia::render('Home/Profile/History', [
            'orders' => Order::with('products', 'status')->where('client_id', Auth::user()->id)->get(),
            'cartData' => session()->get('cart') ? session()->get('cart') : new stdClass()
        ]);
    }

    public function bonus()
    {
        return Inertia::render('Home/Profile/Bonus', [
            'cartData' => session()->get('cart') ? session()->get('cart') : new stdClass(),
            'user' => User::find(Auth::user()->id),
            'ordersTotal' => Order::with('products')->where('status_id','=',7)->where('client_id', Auth::user()->id)->get()->sum('total')
        ]);
    }

    public function setAvatar(Request $request)
    {
        if ($request->file('avatar')) {
            $file = $request->file('avatar')->store('users', ['disk' => 'public']);
        }

        $user = User::find(Auth::user()->id)->update([
            'avatar' => $file
        ]);

        return response()->json([
            'fileName' => $file
        ]);
    }

    public function checkout(Request $request)
    {
        return Inertia::render('Home/Checkout', [
            'cartData' => session()->get('cart') ? session()->get('cart') : new stdClass(),
            'user' => User::find(Auth::user()->id),
            'cities' => City::all(),
        ]);
    }

    public function confirmOrder(Request $request)
    {
        $this->validate($request, [
            'city' => "required",
            'address' => "required",
            'phone' => "required",
            'courier' => "required",
        ]);

        $cart = session()->get('cart');

        $total = floatval($this->getTotal($cart));

        $ordersTotal = Order::with('products')->where('client_id', Auth::user()->id)->get()->sum('total');

        $order = Order::create([
            'client_id' => Auth::user()->id,
            'total' => $total,
            'status_id' => 1,
            'phone' => $request->phone,
            'city' => $request->city,
            'address' => $request->address,
            'cashback' => $request->cashback
        ]);

        $user = User::find(Auth::user()->id);

        $user->update([
            'cashback' => $user->cashback - $request->cashback
        ]);

        foreach ($cart as $key => $item) {
            $quantity=0;
            foreach ($item['size_quantity'] as $size_quantity) {
                $quantity += $size_quantity['quantity'];
            }
            $order->products()->attach($key, [
                'product_price' => $item['price'],
                'product_qty' => $quantity,
            ]);
        }

        $cart = session()->put('cart', []);

        $payment = new AlifController();
        $token = $payment->token($total, $order->id);
        $key = $payment->key;

        return response()->json([
            'message' => 'Спасибо за покупку',
            'token' => $token,
            'key' => $key,
            'order_id' => $order->id,
            'total' => $total,
            'cart' => new stdClass()
        ]);
    }

    private function getTotal($cart)
    {
        $total = 0;
        foreach ($cart as $key => $item) {
            $product = Product::find($key);
            foreach ($item['size_quantity'] as $key => $size_quantity) {
                $total += ($product->price * (1 - $product->sale / 100)) * $size_quantity['quantity'];
            }
        }
        return $total;
    }
}
