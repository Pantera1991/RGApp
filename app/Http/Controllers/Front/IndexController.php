<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Renderable;
use function view;

class IndexController extends Controller
{

    /**
     * @return Renderable
     */
    public function index(): Renderable
    {
        return view('front.index');
    }
}
