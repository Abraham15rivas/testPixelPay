<?php

namespace App\Http\Controllers;

use App\Statu;
use Illuminate\Http\Request;

class StatuController extends Controller
{
    public function index()
    {
        return Statu::orderBy('name', 'asc')->get()->toJson();
    }
}
