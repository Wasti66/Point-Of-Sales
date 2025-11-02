<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    function homePages(){
        return view('pages.HomePage');
    }
    function LoginPageVisit(){
        return view('pages.auth.userLogin-page');
    }
    function RegistrationPageVisit(){
        return view('pages.auth.UserRegistration-page');
    }
    
    public function features()
    {
        $features = [
            [
                'title' => 'Effortless card',
                'description' => 'Easily manage your sales and transactions with a smooth interface.',
            ],
            [
                'title' => 'Inventory Management',
                'description' => 'Track products, stock levels, and suppliers in real-time.',
            ],
            [
                'title' => 'Sales Reports',
                'description' => 'Get daily, weekly, and monthly reports to analyze your business growth.',
            ],
            [
                'title' => 'Effortless card',
                'description' => 'Easily manage your sales and transactions with a smooth interface.',
            ],
            [
                'title' => 'Inventory Management',
                'description' => 'Track products, stock levels, and suppliers in real-time.',
            ],
            [
                'title' => 'Sales Reports',
                'description' => 'Get daily, weekly, and monthly reports to analyze your business growth.',
            ]
        ];

        return view('pages.HomePage', compact('features'));
    }

}
