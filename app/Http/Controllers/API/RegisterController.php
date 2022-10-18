<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Library\Structure;
use App\Models\User;

class RegisterController extends Controller
{
    // Structure of response API.
    use Structure;

    /**
     * User Register.
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        return response()->json($this->structure(false, 'This function is empty!'), 200);
    }

} //Class End Tag.
