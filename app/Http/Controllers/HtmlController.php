<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HtmlController extends Controller
{
    public function getHtml($view, $data) {
        return view($view, compact('data'))->render();
    }
}
