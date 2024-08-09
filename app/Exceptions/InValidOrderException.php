<?php

namespace App\Exceptions;

use Exception;

class InValidOrderException extends Exception
{
    public function render($request, Exception $exception)
    {
        return back()->withInput()->withErrors('Invalid Order');
    }
}
