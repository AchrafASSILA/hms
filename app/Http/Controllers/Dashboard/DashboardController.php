<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Doctor\Doctor;
use App\Models\Section\Section;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function getDoctorsCount()
    {
        $doctors = Doctor::count();
        return response(['doctors' => $doctors], 200);
    }
    public function getActiveSectionsCount()
    {
        $sections = Section::where('Active', true)->count();
        return response(['sections' => $sections], 200);
    }
    public function getDeactiveSectionsCount()
    {
        $sections = Section::where('Active', false)->count();
        return response(['sections' => $sections], 200);
    }
    public function getUsersCount()
    {
        $users = User::count();
        return response(['users' => $users], 200);
    }
}
