<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function index(Request $request) {
        $user = User::find(1);
        Auth::login($user);

        return redirect('/admin');
    }
}
