<?php

namespace App\Http\Controllers;

use App\Http\Requests\Objectifs\ObjectifRequest;
use App\Models\Objectif;
use App\Models\Secteur;
use Illuminate\Http\Request;
use Session;
use LaravelLocalization;
class ObjectifController extends Controller
{
    public function index()
    {
        $objectifs = Objectif::with(['secteur' => function($q){
            $q->select('id','T_secteur_'.LaravelLocalization::getCurrentLocale().' as secteur');
        }])->select('id','objectif_'.LaravelLocalization::getCurrentLocale().' as objectif','secteur_id')->orderBy('id','ASC')->get();

        return view('objectifs.objectifs',compact('objectifs'));
    }

    public function create()
    {
        $secteurs= Secteur::select('id','T_secteur_'.LaravelLocalization::getCurrentLocale().' as secteur')->cursor();
        return view('objectifs.create',compact('secteurs'));
    }

    public function store(ObjectifRequest $request)
    {
        $data = $request->only(['objectif_fr','objectif_ar','secteur']);

        Objectif::create([
            'objectif_fr' => $data['objectif_fr'],
            'objectif_ar' => $data['objectif_ar'],
            'secteur_id' => $data['secteur'],
            'created_at' => now()

        ]);
        Session::flash('success',__('objectifs.objectif success in add'));
        return redirect()->back();
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $objectif = Objectif::find($id);
        if(!$objectif){
            return redirect()->back();
        }
        $secteurs = Secteur::select('id','T_secteur_'.LaravelLocalization::getCurrentLocale().' as secteur')->cursor();
        return view('objectifs.edit',compact('objectif','secteurs'));
    }

    public function update(Request $request, $objectif_id)
    {

        // validation
        $request->validate([
            'objectif_fr' => 'required|max:255|unique:objectifs,objectif_fr,'.$objectif_id,
            'objectif_ar' => 'required|max:255|unique:objectifs,objectif_ar,'.$objectif_id,
            'secteur' => 'required'

        ],[
            'objectif_fr.required' => __('objectifs.objectif_fr required'),
            'objectif_fr.max' => __('objectifs.objectif_fr max'),
            'objectif_fr.unique' => __('objectifs.objectif_fr unique'),

            'objectif_ar.required' => __('objectifs.objectif_ar required'),
            'objectif_ar.max' => __('objectifs.objectif_ar max'),
            'objectif_ar.unique' => __('objectifs.objectif_ar unique'),
            'secteur.required' => __('objectifs.secteur required')
        ]);

        $data = $request->only(['objectif_fr','objectif_ar','secteur']);
        $objectif = Objectif::find($objectif_id);
        $objectif->update([
            'objectif_fr' => $data['objectif_fr'],
            'objectif_ar' => $data['objectif_ar'],
            'secteur_id' => $data['secteur'],

        ]);
        Session::flash('success',__('objectifs.objectif success in edit'));
        return redirect()->back();
    }

    public function destroy(Request $request)
    {
        $objectif = Objectif::find($request->id);
        $objectif->delete();

        Session::flash('success',__('objectifs.objectif success in supprimer'));
        return redirect()->back();
    }
}
