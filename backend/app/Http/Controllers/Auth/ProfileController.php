<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * show profile
     * @return JsonResponse
     */
    public function profile():JsonResponse
    {
        return $this->send('User Profile',Auth::user(),200);
    }
}
