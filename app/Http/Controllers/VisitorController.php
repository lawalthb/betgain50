<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use Illuminate\Http\Request;


class VisitorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'ip_address' => ['required'],

        ]);
        $ip_address = $request->ip_address;
        $city = $request->city;
        $region = $request->region;
        $country = $request->country;
        $nework_provider = $request->nework_provider;


        $user = Visitor::create([
            'ip_address' => $ip_address,
            'city' => $city,
            'region' => $region,
            'country' => $country,
            'nework_provider' => $nework_provider,

        ]);
        return $user;
    }

    /**
     * Display the specified resource.
     */
    public function show(Visitor $visitor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Visitor $visitor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Visitor $visitor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Visitor $visitor)
    {
        //
    }
}
