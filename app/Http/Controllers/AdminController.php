<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Catalog;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function showAdminDashboard()
    {
        $catalogs = Catalog::all();
        return view('admin', compact('catalogs'));
    }
}
