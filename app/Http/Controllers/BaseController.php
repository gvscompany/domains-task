<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Domain;
use Illuminate\Support\Facades\Auth;

class BaseController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function search(Request $request)
    {
        $output = '';
        $domains = Domain::where('name', 'LIKE', $request->search.'%')->get();
        if (!$domains->isEmpty()) {
            foreach ($domains as $domain) {
                $output .= '<a class="list-group-item list-group-item-action">' . $domain->name . '<small class="badge badge-warning float-right">domain is busy</small></a>';
            }
        } else {
            $pattern = "/.*[a-zA-Z]+\.(com|ru|am)$/";
            if (preg_match($pattern, $request->search)) {
                if (Auth::check()) {
                    $output .= '<a class="list-group-item list-group-item-action">' . $request->search;
                    $output .= '<form action="'. route('domain.store') .'" method="post" id="'.Auth::id().'" style="display: none;">'. @csrf_field();
                    $output .= '<input type="hidden" name="method" value="PUT">';
                    $output .= '<input type="hidden" name="name" value="'. $request->search .'"></form>';
                    $output .= '<button type="submit" form="'.Auth::id().'" class="btn btn-success btn-sm float-right">Reserve a domain</button>';
                    $output .= '</a>';
                } else {
                    $output .= '<a class="list-group-item list-group-item-action">' . $request->search . '<small class="badge badge-success float-right">sign in to reserve a domain</small></a>';
                }
            } else {
                $output .= '<a class="list-group-item list-group-item-action">' . $request->search . '<small class="badge badge-danger float-right">invalid domain</small></a>';
            }
        }
        return $output;
    }
}
