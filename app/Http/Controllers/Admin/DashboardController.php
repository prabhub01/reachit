<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\AdminTypeRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function __construct(
        AdminTypeRepository $adminType
    )
    {
        $this->middleware('auth:admin');
        auth()->shouldUse('admin');
        $this->adminType = $adminType;

    }

    public function index(Request $request)
    {
        $searchReport = [];
        return view('admin.dashboard', ['searchReport' => $searchReport]);
    }


}
