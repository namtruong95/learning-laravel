<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class Page3Controller extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if (Gate::allows('testAdmin', $user)) {
            return $user->name . "allow access ";
        }

        return $user->name . 'has been denied';
    }
}
