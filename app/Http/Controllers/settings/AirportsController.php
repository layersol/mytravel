<?php

namespace App\Http\Controllers\settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\airports;
use App\Models\Countries;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

use DataTables;
class AirportsController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $airports = airports::select(['id', 'name', 'iata', 'city', 'country']);
            return DataTables::of($airports)
                ->addColumn('actions', function ($airport) {
                    // Add your actions HTML here
                    return '<a href="'.route('airports.edit', $airport->id).'" class="bg-blue-1-05 text-blue-1"><i class="icon-edit text-16 text-light-1"></i></a>'
                        . '<form method="post" action="'.route('airports.destroy', $airport->id).'" onsubmit="return confirm(\'Are you sure to delete\')" class="d-inline">'
                        . '<input type="hidden" name="_token" value="'.csrf_token().'">'
                        . '<input type="hidden" name="_method" value="DELETE">'
                        . '<button type="submit"><i class="icon-trash-2 text-16 text-light-1"></i></button>'
                        . '</form>';
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('backend.airports.index');
    }

    public function create(){
        $countries=Countries::all();
        return view('backend.airports.create',compact('countries'));
        
    }
    public function store(Request $request){

        $request->validate([
            'name' => 'required|string|max:191',
            'iata' => 'required|string|unique:airports,iata|max:3',
            'country' => 'required|string|max:191',
            'city' => 'required|string|max:191',
        ]);
        
        airports::create([
            'name' => $request->input('name'),
            'iata' => strtoupper($request->input('iata')),
            'country' => $request->input('country'),
            'city' => $request->input('city'),
           
        ]);
    
        return redirect()->route('airports.index')->with('success', 'Airport created successfully.');
    }
    public function edit($id){
        $airport=airports::findOrfail($id);
        $countries=Countries::all();
        return view('backend.airports.update',compact('airport','countries'));

    }
   
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:191',
            'iata' => "required|string|unique:airports,iata,$id|max:3", // Ensure uniqueness, excluding the current record
            'country' => 'required|string|max:191',
            'city' => 'required|string|max:191',
        ]);

        $airport = airports::findOrFail($id);

        $airport->update([
            'name' => $request->input('name'),
            'iata' => strtoupper($request->input('iata')),
            'country' => $request->input('country'),
            'city' => $request->input('city'),
        ]);

        return redirect()->route('airports.index')->with('success', 'Airport updated successfully.');
    }

    public function destroy($id){
        $airport=airports::findOrfail($id);
        $airport->delete();
        return redirect()->route('airports.index')->with('success', 'Airport deleted successfully.');

    }



    public function autocomplete(Request $request)
    {
        try {
            $searchText = $request->input('query');
    
            $results = Cache::remember('airport_search_' . $searchText, 3600, function () use ($searchText) {
                return DB::table('airports')
                    ->select('name', 'iata', 'country', 'city')
                    ->where('name', 'LIKE', "%$searchText%")
                    ->orWhere('iata', 'LIKE', "%$searchText%")
                    ->orWhere('city', 'LIKE', "%$searchText%")
                    ->orWhere('country', 'LIKE', "%$searchText%")
                    ->orderByRaw("
                        CASE
                            WHEN name LIKE '$searchText%' THEN 1
                            WHEN iata LIKE '$searchText%' THEN 2
                            WHEN city LIKE '$searchText%' THEN 3
                            WHEN country LIKE '$searchText%' THEN 4
                            ELSE 5
                        END
                    ")
                    ->take(25)
                    ->get();
            });
            
        
    
            return response()->json($results);
        } catch (\Exception $e) {
            // Log the exception
            \Log::error($e->getMessage());
    
            // Return an error response
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }
    
    

}
