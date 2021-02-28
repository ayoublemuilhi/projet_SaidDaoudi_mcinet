<?php

namespace App\Http\Controllers;

use App\Http\Requests\Regions\RegionRequest;
use App\Models\DR;
use Illuminate\Http\Request;
use LaravelLocalization;
use Session;

class DRController extends Controller
{
    public function index()
    {
        $regions = DR::select('id','region_'.LaravelLocalization::getCurrentLocale().' as region')->orderBy('id','ASC')->cursor();

        return view('regions.regions',compact('regions'));
    }

    public function create()
    {
        return view('regions.create');
    }

    public function store(RegionRequest $request)
    {
        $data = $request->only(['region_fr','region_ar']);

        DR::create([
            'region_fr' => $data['region_fr'],
            'region_ar' => $data['region_ar'],
            'created_at' => now()

        ]);
        Session::flash('success',__('regions.region success in add'));
        return redirect()->back();
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $region = DR::find($id);
        if(!$region){
            return redirect()->route('regions.index');
        }
        return view('regions.edit',compact('region'));
    }

    public function update(Request $request, $region_id)
    {

        // validation
        $request->validate([
            'region_fr' => 'required|max:255|unique:dr,region_fr,'.$region_id,
            'region_ar' => 'required|max:255|unique:dr,region_ar,'.$region_id

        ],[
            'region_fr.required' => __('regions.region_fr required'),
            'region_fr.max' => __('regions.region_fr max'),
            'region_fr.unique' => __('regions.region_fr unique'),

            'region_ar.required' => __('regions.region_ar required'),
            'region_ar.max' => __('regions.region_ar max'),
            'region_ar.unique' => __('regions.region_ar unique'),
        ]);

        $data = $request->only(['region_fr','region_ar']);
        $region = DR::find($region_id);
        $region->update([
            'region_fr' => $data['region_fr'],
            'region_ar' => $data['region_ar'],

        ]);
        Session::flash('success',__('regions.region success in edit'));
        return redirect()->back();
    }

    public function destroy(Request $request)
    {

        $region = DR::find($request->id);
        $region->delete();

        Session::flash('success',__('regions.region success in supprimer'));
        return redirect()->back();
    }
}
