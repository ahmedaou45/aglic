<?php

namespace App\Http\Controllers;

use App\Models\zone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class zoneControllers extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $zones = zone::all();
        return response()->json($zones);
    }

    /**
     * Show the form for creating a new resource.
     */
    /**public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nom_zone' => 'required|string',
            'id_user_createure' => 'required|exists:users,id_user',
        ]);
    
        // Si la validation échoue, retourner les erreurs
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $cat = new zone();
        $cat->nom_zone=$request->nom_zone;
        $cat->id_user_createure=$request->id_user_createure;
        $cat->save();
        return response()->json($cat, 201);
    }

    /**
     * Display the specified resource.
     */

    public function show( $id_zone)
    {
        
        $x= zone::find($id_zone);
        if(!$x){
            return response()->json(['message' => 'not found'], 404);
        }
        return response()->json($x);
    }

    /**
     * Show the form for editing the specified resource.
     */
    /**public function edit(zone $zone)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    $request->validate([
        'nom_zone' => 'string',
        'id_user_updateure' => 'required|exists:users,id_user',
    ]);

    $zone = zone::findOrFail($id); 
    $zone->nom_zone = $request->nom_zone;
    $zone->id_user_updateure = $request->id_user_updateure;
    $zone->save();

    return response()->json($zone);
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_zone)
    {
        $zone = zone::find($id_zone);
    
        if (!$zone) {
            return response()->json(['message' => 'Zone non trouvée'], 404);
        }
        
        $zone->delete();
        
        return response()->json(['message' => 'Zone supprimée avec succès']);
    }
    

}
