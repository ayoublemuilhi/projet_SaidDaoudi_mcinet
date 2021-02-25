<?php

namespace App\Http\Controllers;

use App\Http\Requests\Indicateurs\IndicateurRequest;
use App\Models\Indicateur;
use Illuminate\Http\Request;
use Session;
use LaravelLocalization;
class IndicateurController extends Controller
{

    public function index()
    {
        $indicateurs = Indicateur::select('id','indicateur_'.LaravelLocalization::getCurrentLocale().' as indicateur')->orderBy('id','ASC')->cursor();

        return view('indicateurs.indicateurs',compact('indicateurs'));
    }

    public function create()
    {
        return view('indicateurs.create');
    }

    public function store(IndicateurRequest $request)
    {
        $data = $request->only('indicateur_fr','indicateur_ar');

        Indicateur::create([
            'indicateur_fr' => $data['indicateur_fr'],
            'indicateur_ar' => $data['indicateur_ar'],
            'created_at' => now()

        ]);
        Session::flash('success',__('indicateurs.indicateur success in add'));
        return redirect()->back();
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $indicateur = Indicateur::find($id);
        if(!$indicateur){
            return redirect()->back();
        }
        return view('indicateurs.edit',compact('indicateur'));
    }

    public function update(Request $request, $indicateur_id)
    {

        // validation
        $request->validate([
            'indicateur_fr' => 'required|max:255|unique:indicateurs,indicateur_fr,'.$indicateur_id,
            'indicateur_ar' => 'required|max:255|unique:indicateurs,indicateur_ar,'.$indicateur_id,


        ],[
            'indicateur_fr.required' => __('indicateurs.indicateur_fr required'),
            'indicateur_fr.max' => __('indicateurs.indicateur_fr max'),
            'indicateur_fr.unique' => __('indicateurs.indicateur_fr unique'),

            'indicateur_ar.required' => __('indicateurs.indicateur_ar required'),
            'indicateur_ar.max' => __('indicateurs.indicateur_ar max'),
            'indicateur_ar.unique' => __('indicateurs.indicateur_ar unique')
        ]);

        $data = $request->only('indicateur_fr','indicateur_ar');
        $indicateur = Indicateur::find($indicateur_id);
        $indicateur->update([
            'indicateur_fr' => $data['indicateur_fr'],
            'indicateur_ar' => $data['indicateur_ar'],

        ]);
        Session::flash('success',__('indicateurs.indicateur success in edit'));
        return redirect()->back();
    }

    public function destroy(Request $request)
    {
        $indicateur = Indicateur::find($request->id);
        $indicateur->delete();

        Session::flash('success',__('indicateurs.indicateur success in supprimer'));
        return redirect()->back();
    }
}
