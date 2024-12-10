<?php

namespace App\Http\Controllers\settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TravelDeal;

class TravelDealsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $deals = TravelDeal::all();
        return view('backend/contents/travel_deals/travel_deals',compact('deals'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend/contents/travel_deals/create');
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
            // Validation rules
            $rules = [
            'area_name' => 'required|string|max:255',
            'starting_price' => 'required|numeric|min:0',
            'currency' => 'required|string|max:3',
            'airport_name' => 'required|string|max:255',
            'iata_code' => 'required|string|max:3',
            'status' => 'required|in:active,inactive',
        ];

        // Validate the request data
        $request->validate($rules);

        // Create a new travel deal
        $travelDeal = TravelDeal::create([
            'area_name' => $request->input('area_name'),
            'starting_price' => $request->input('starting_price'),
            'currency' => $request->input('currency'),
            'airport_name' => $request->input('airport_name'),
            'iata_code' => strtoupper($request->input('iata_code')),
            'status' => $request->input('status'),
        ]);

        return redirect()->route('travel-deals.index')->with('success', 'Travel Deal created successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $deal=TravelDeal::findOrfail($id);
        return view('backend/contents/travel_deals/update',compact('deal'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         // Validation rules
         $rules = [
            'area_name' => 'required|string|max:255',
            'starting_price' => 'required|numeric|min:0',
            'currency' => 'required|string|max:3',
            'airport_name' => 'required|string|max:255',
            'iata_code' => 'required|string|max:3',
            'status' => 'required|in:active,inactive',
        ];

        // Validate the request data
        $request->validate($rules);

        // Find the travel deal by ID
        $travelDeal = TravelDeal::find($id);

        // Check if the travel deal exists
        if (!$travelDeal) {

            return redirect()->back()->with('error', 'Travel deal not found.');
        }

        // Update the travel deal with the validated data
        $travelDeal->update([
            'area_name' => $request->input('area_name'),
            'starting_price' => $request->input('starting_price'),
            'currency' => $request->input('currency'),
            'airport_name' => $request->input('airport_name'),
            'iata_code' =>strtoupper($request->input('iata_code')),
            'status' => $request->input('status'),
        ]);

        // Optionally, you can return a response or redirect to a specific page
        return redirect()->route('travel-deals.index')->with('success', 'Travel Deal updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the travel deal by ID
        $travelDeal = TravelDeal::find($id);

        // Check if the travel deal exists
        if (!$travelDeal) {
            return redirect()->back()->with('error', 'Travel deal not found.');
        }

        // Delete the travel deal
        $travelDeal->delete();

        // Optionally, you can return a response or redirect to a specific page
        return redirect()->route('travel-deals.index')->with('success', 'Travel Deal deleted successfully.');

    }
}
