<?php

namespace App\Http\Controllers\Dashboard;

use App\Ticket;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class WelcomeController extends Controller
{
    public function index()
    {
        $tickets_count = Ticket::count();

        $admin_count = User::whereRoleIs('admin')->count();
        $users_count = User::whereRoleIs('users')->count();



        return view('dashboard.welcome', compact('tickets_count', 'users_count','admin_count'));
    
    }//end of index
    
}//end of controller
