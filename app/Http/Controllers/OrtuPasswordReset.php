<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\ResetsPasswords;

class OrtuPasswordReset extends Controller
{
    use ResetsPasswords;

    public function __construct()
    {
        $this->broker = 'ortu';
    }
}
