<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\GuideRest;

class GuideRestController extends Controller
{
    
	public function index()
    {
        return GuideRest::all();
    }

    public function show(GuideRest $url)
    {

        return $url;
    }

    public function store(Request $request)
    {
        $guide = GuideRest::create($request->all());

        return response()->json($guide, 201);
    }

    public function update(Request $request, GuideRest $guide)
    {
        $guide->update($request->all());

        return response()->json($guide, 200);
    }

    public function delete(GuideRest $guide)
    {
        $guide->delete();

        return response()->json(null, 204);
    }

}
