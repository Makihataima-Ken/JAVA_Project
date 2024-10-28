<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;

class LogoutController extends Controller
{
    /**
     * logout user
     * @return JsonResponse
     */
    public function logout():JsonResponse
    {
        Auth::logout();
        return $this->send('logged out successfully',null,'HTTP_OK',JsonResponse::HTTP_OK);
    }
}
