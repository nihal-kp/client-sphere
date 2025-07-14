<?php

namespace App\Http\Controllers\Client;

use App\Models\TextBox;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TextBoxController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $textBoxes = Auth::user()->textBoxes()->select('text_boxes.id', 'label', 'value', 'text_boxes.created_at')->orderBy('text_boxes.id', 'DESC')->get();

        return view('client.text-boxes.index', compact('textBoxes'));
    }

}
