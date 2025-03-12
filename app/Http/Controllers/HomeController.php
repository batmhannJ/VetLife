<?php

namespace App\Http\Controllers;

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
    $settings1 = [
        'column_class' => 'col-md-4',
        'chart_title' => 'Example Chart 1',
        'total_number' => 123
    ];

    $settings2 = [
        'column_class' => 'col-md-4',
        'chart_title' => 'Example Chart 2',
        'total_number' => 456
    ];

    $settings3 = [
        'column_class' => 'col-md-4',
        'chart_title' => 'Example Chart 3',
        'total_number' => 789
    ];

    $settings4 = [
        'column_class' => 'col-md-4',
        'chart_title' => 'Example Chart 4',
        'total_number' => 321
    ];

    $settings5 = [
        'column_class' => 'col-md-12',
        'chart_title' => 'Latest Entries',
        'fields' => ['name', 'email'], // example fields
        'data' => [
            (object) ['name' => 'John Doe', 'email' => 'johndoe@example.com'],
            (object) ['name' => 'Jane Smith', 'email' => 'janesmith@example.com']
        ]
    ];

    $settings6 = [
        'column_class' => 'col-md-12',
        'chart_title' => 'Other Entries',
        'fields' => ['title', 'description'],
        'data' => [
            (object) ['title' => 'Project A', 'description' => 'Description A'],
            (object) ['title' => 'Project B', 'description' => 'Description B']
        ]
    ];

    $settings7 = [
        'column_class' => 'col-md-4',
        'chart_title' => 'Another Chart',
        'total_number' => 987
    ];

    return view('home', compact(
        'settings1', 'settings2', 'settings3', 'settings4',
        'settings5', 'settings6', 'settings7'
    ));
}

}
