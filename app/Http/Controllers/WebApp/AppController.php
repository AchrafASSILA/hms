<?php

namespace App\Http\Controllers\WebApp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AppController extends Controller
{
    //
    public function getLinks()
    {
        $data = [];
        $user = auth('sanctum')->user();
        $data['links'] = [];
        if ($user->role_->Alias == 'super-admin') {

            $data['links'] = [
                'dashboard' => [
                    'to' => 'Dashboard',
                    'title' => 'Dashboard',
                    'icon_class' => 'fa fa-bar-chart mr-1'
                ],
                'sections' => [
                    'to' => 'Sections',
                    'title' => 'Sections',
                    'icon_class' => 'fa fa-stethoscope mr-1'
                ],
                'doctors' => [
                    'to' => 'Doctors',
                    'title' => 'Doctors',
                    'icon_class' => 'fa fa-users mr-1'
                ],
            ];
        } else if ($user->role_->Alias == 'doctor') {
            $data['links'] = [];
        }
        return response($data, 200);
    }
}
