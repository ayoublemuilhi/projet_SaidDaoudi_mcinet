<?php

namespace App\Http\Controllers;

use App\Http\Requests\Attributions\AttributionRequest;
use App\Models\Attribution;
use App\Models\Secteur;
use Illuminate\Http\Request;
use LaravelLocalization;
use Session;
class AttributionController extends Controller
{
    public function index()
    {
        $attributions = Attribution::with(['secteur' => function($q){
            $q->select('id','T_secteur_'.LaravelLocalization::getCurrentLocale().' as secteur');
        }])->select('id','attribution_'.LaravelLocalization::getCurrentLocale().' as attribution','secteur_id')->orderBy('id','ASC')->get();

        return view('attributions.attributions',compact('attributions'));
    }

    public function create()
    {
        $secteurs= Secteur::select('id','T_secteur_'.LaravelLocalization::getCurrentLocale().' as secteur')->cursor();

        return view('attributions.create',compact('secteurs'));
    }

    public function store(AttributionRequest $request)
    {
        $data = $request->only(['attribution_fr','attribution_ar','secteur']);

        Attribution::create([
            'attribution_fr' => $data['attribution_fr'],
            'attribution_ar' => $data['attribution_ar'],
            'secteur_id' => $data['secteur'],
            'created_at' => now()

        ]);
        Session::flash('success',__('attributions.attribution success in add'));
        return redirect()->back();
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $attribution = Attribution::find($id);
        if(!$attribution){
            return redirect()->route('attributions.index');
        }
        $secteurs = Secteur::select('id','T_secteur_'.LaravelLocalization::getCurrentLocale().' as secteur')->cursor();
        return view('attributions.edit',compact('attribution','secteurs'));
    }

    public function update(Request $request, $attribution_id)
    {

        // validation
        $request->validate([
            'attribution_fr' => 'required|max:200|unique:attributions,attribution_fr,'.$attribution_id,
            'attribution_ar' => 'required|max:200|unique:attributions,attribution_ar,'.$attribution_id,
            'secteur' => 'required'

        ],[
            'attribution_fr.required' => __('attributions.attribution_fr required'),
            'attribution_fr.max' => __('attributions.attribution_fr max'),
            'attribution_fr.unique' => __('attributions.attribution_fr unique'),

            'attribution_ar.required' => __('attributions.attribution_ar required'),
            'attribution_ar.max' => __('attributions.attribution_ar max'),
            'attribution_ar.unique' => __('attributions.attribution_ar unique'),

            'secteur.required' => __('objectifs.secteur required')
        ]);

        $data = $request->only(['attribution_fr','attribution_ar','secteur']);
        $attribution = Attribution::find($attribution_id);
        $attribution->update([
            'attribution_fr' => $data['attribution_fr'],
            'attribution_ar' => $data['attribution_ar'],
            'secteur_id' => $data['secteur'],

        ]);
        Session::flash('success',__('attributions.attribution success in edit'));
        return redirect()->back();
    }

    public function destroy(Request $request)
    {

        $attribution = Attribution::find($request->id);
        $attribution->delete();

        Session::flash('success',__('attributions.attribution success in supprimer'));
        return redirect()->back();
    }
}
