<?php

namespace App\Http\Controllers;

use App\Http\Requests\secteurs\SecteurRequest;
use App\Models\Secteur;
use Illuminate\Http\Request;
use LaravelLocalization;
use Session;
class SecteurController extends Controller
{
    public function index()
    {
        $secteurs = Secteur::select('id','T_secteur_'.LaravelLocalization::getCurrentLocale().' as secteur')->orderBy('id','ASC')->cursor();

       return view('secteurs.secteurs',compact('secteurs'));
    }


    public function create()
    {
        return view('secteurs.create');
    }


    public function store(SecteurRequest $request)
    {
       $data = $request->validated();

       Secteur::create([
           'T_secteur_fr' => $data['secteur_fr'],
           'T_secteur_ar' => $data['secteur_ar'],
           'created_at' => now()

       ]);
        Session::flash('success',__('secteurs.secteur success in add'));
        return redirect()->back();

    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
       $secteur = Secteur::find($id);
        if(!$secteur){
            return redirect()->route('secteurs.index');
        }
      return view('secteurs.edit',compact('secteur'));
    }

    public function update(Request $request, $secteur_id)
    {
        // validation
        $request->validate([
            'secteur_fr' => 'required|max:250|unique:secteurs,T_secteur_fr,'.$secteur_id,
            'secteur_ar' => 'required|max:250|unique:secteurs,T_secteur_ar,'.$secteur_id,

        ],[
            'secteur_fr.required' => __('secteurs.secteur required'),
            'secteur_fr.max' => __('secteurs.secteur max'),
            'secteur_fr.unique' => __('secteurs.secteur unique'),

            'secteur_ar.required' => __('secteurs.secteur_ar required'),
            'secteur_ar.max' => __('secteurs.secteur_ar max'),
            'secteur_ar.unique' => __('secteurs.secteur_ar unique'),
        ]);

        $data = $request->only(['secteur_fr','secteur_ar']);

       $secteur = Secteur::find($secteur_id);
        $secteur->update([
            'T_secteur_fr' => $data['secteur_fr'],
            'T_secteur_ar' => $data['secteur_ar'],

        ]);
        Session::flash('success',__('secteurs.secteur success in edit'));
        return redirect()->back();
    }

    public function destroy(Request $request)
    {

        $secteur = Secteur::find($request->id);

        $secteur->delete();

        Session::flash('success',__('secteurs.secteur success in supprimer'));
        return redirect()->back();
    }
}
