<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use App\Http\Requests\StatusRequest;


class AlifController extends Controller
{

    public $key;

    public function __construct()
    {
        $this->key = config('app.alif.key');
        $this->password = config('app.alif.password');

        $this->callbackUrl = config('app.alif.callbackUrl');
        $this->returnUrl = config('app.alif.returnUrl');

        $this->secretkey = hash_hmac('sha256', $this->password, $this->key);
    }

    public function token($amount, $orderId)
    {
        $amount = number_format($amount, 2, '.', '');

        if ($amount !== '' && $this->key !== '' && $orderId !== '' && $this->callbackUrl !== '') {
            return hash_hmac('sha256', $this->key . $orderId . $amount . $this->callbackUrl, $this->secretkey);
        }
    }
}
