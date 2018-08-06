<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;

class WelcomepageController extends Controller
{

    public function login()
    {
        return Redirect::to('/login');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
