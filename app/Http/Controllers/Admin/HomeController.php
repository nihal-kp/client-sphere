<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\TextBox;
use App\Enums\UserType;
use App\Enums\UserStatus;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $clientCount = User::where('type', UserType::CLIENT->value)->get()->count();
        $textBoxCount = TextBox::get()->count();

        return view('admin.dashboard')->with(['clientCount'=>$clientCount, 'textBoxCount'=>$textBoxCount]);
    }
}
