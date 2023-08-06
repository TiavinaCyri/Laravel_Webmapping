<?php

namespace App\Http\Controllers;

use App\Models\Monument;

class MonumentController extends Controller
{
    function index()
    {
        // $geojson = [
        //     'type' => 'FeatureCollection',
        //     'features' => [],
        // ];

        // Monument::selectRaw('id, name, image, ST_AsGeoJSON(geom) as geom')
        //     ->get()
        //     ->each(function ($monument) use (&$geojson) {
        //         $geojson['features'][] = [
        //             'type' => 'Feature',
        //             'properties' => [
        //                 'name' => $monument->name,
        //                 'image' => $monument->image,
        //             ],
        //             'geometry' => json_decode($monument->geom, true),
        //         ];
        //     });

        // return view('index', ['geojson' => json_encode($geojson)]);

        return view('index');
    }
}
