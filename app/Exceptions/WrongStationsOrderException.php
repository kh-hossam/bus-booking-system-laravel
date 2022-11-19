<?php

namespace App\Exceptions;

use App\Libraries\ApiResponse;
use Exception;

class WrongStationsOrderException extends Exception
{
    /**
     * Render the exception as an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function render($request)
    {
        return ApiResponse::fail([], 'wrong stations order');
    }
}
