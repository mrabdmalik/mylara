<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;


class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::latest()->get();
        return view('image.index', compact('clients'));
    }

    public function create()
    {
        return view('image.create');
    }

    public function store(Request $request)
    {
        $input = $request->validate([
            'name' => 'required|min:5|max:255',
            'email' => 'required|email:rfc,dns',
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if ($input) {
            $client = Client::create($input);
            if ($request->hasFile('avatar') && $request->file('avatar')->isValid()) {
                $client->addMediaFromRequest('avatar')->toMediaCollection('avatar');
            }
            return redirect()->route('client')->with('status', 'New record added!');
        } else
        return redirect()->route('client')->with('status', 'Error add record!');
    }
}
