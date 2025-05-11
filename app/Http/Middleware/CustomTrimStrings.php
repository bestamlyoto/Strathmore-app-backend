<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CustomTrimStrings
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Trim the strings in the request's input data
        $request->merge($this->trimStrings($request->all()));

        return $next($request);
    }

    /**
     * Recursively trim all strings in an array or object.
     *
     * @param  mixed  $value
     * @return mixed
     */
    protected function trimStrings($value)
    {
        if (is_array($value)) {
            return array_map([$this, 'trimStrings'], $value);
        }

        if (is_string($value)) {
            return trim($value);
        }

        return $value;
    }
}
