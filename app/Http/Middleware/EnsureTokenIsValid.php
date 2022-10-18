<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Library\Structure;

class EnsureTokenIsValid
{
    // Structure of response API.
    use Structure;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $data = auth("api")->user();
        if(!empty($data))
        {
            if ($data->is_active == 'No') {
                return response()->json($this->structure(false, "Your Account Has Been Blocked!"), 200);
            }
            return $next($request);
        }
        return response()->json($this->structure(false, "Unauthorised access"), 200);
    }
}
