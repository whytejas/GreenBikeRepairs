<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RepairShop;

class RepairShopController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $shops =  RepairShop::all();
        return response()->json($shops, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $shop = RepairShop::create($request->all());
        return  redirect('/', 201, $shop)->with('message', 'A new shop was addeds!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return RepairShop::findOrFail($id);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RepairShop $repairShop)
    {
        return view('Edit', $repairShop);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RepairShop $repairShop)
    {
        $req = $request->validate([
            'body' => ['required'],
        ]);
        $repairShop->update($req);
        return redirect('/')->with('message', 'The shop was updated in our listing!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RepairShop $repairShop)
    {
        $repairShop->delete();
        return redirect('/')->with('message', 'The shop was deleted from our listing!');
    }
}
