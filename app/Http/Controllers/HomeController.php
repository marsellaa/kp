<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Mitra;
use App\Models\Peh;
use App\Models\HealthTalk;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
    $users = User::count();
    $mitras = Mitra::count();

    // Data PEH
    $totalPeh = Peh::count();
    $pehYa = Peh::where('status', 'Y')->count();
    $pehPercentage = $totalPeh > 0 ? ($pehYa / $totalPeh) * 100 : 0;

    // Data HealthTalk
    $totalHealthTalk = HealthTalk::count();
    $healthTalkYa = HealthTalk::where('status', 'Y')->count();
    $healthTalkPercentage = $totalHealthTalk > 0 ? ($healthTalkYa / $totalHealthTalk) * 100 : 0;

    $widget = [
        'users' => $users,
        'mitras' => $mitras,
        'pehPercentage' => $pehPercentage,
        'healthTalkPercentage' => $healthTalkPercentage,
        // ...
    ];

    return view('home', compact('widget'));

    }
}