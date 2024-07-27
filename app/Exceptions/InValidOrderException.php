<?php

namespace App\Exceptions;

use Exception;

class InValidOrderException extends Exception
{
    public function report()
    {
        //
    }

    public function render($request, Exception $exception)
    {
        return back()->withInput()->withErrors('Invalid Order');
    }
}
