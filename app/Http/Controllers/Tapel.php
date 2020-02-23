<?php

namespace App\Http\Controllers;

use App\Http\Resources\TapelCollection;
use Illuminate\Support\Facades\Auth;
use App\Models\Tapel as ModelsTapel;

class Tapel extends Controller
{
    public function index()
    {
        return new TapelCollection(ModelsTapel::all());
    }
}
