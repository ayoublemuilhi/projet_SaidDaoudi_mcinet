<?php

namespace App\Http\Controllers;

use App\Http\Requests\Dpci\DpciRequest;
use App\Models\DP;
use App\Models\DR;
use Illuminate\Http\Request;
use LaravelLocalization;
use Session;
class DpciController extends Controller
{

    public function index()
    {
        $dpcis = DP::with(['region' => function($q){
            $q->select('id','region_'.LaravelLocalization::getCurrentLocale().' as region');
        }])->select('id','domaine_'.LaravelLocalization::getCurrentLocale().' as domaine','type','dr_id')->orderBy('id','ASC')->get();

        return view('Dpci.dpci',compact('dpcis'));
    }

    public function create()
    {
        $regions = DR::select('id','region_'.LaravelLocalization::getCurrentLocale().' as region')->cursor();
        return view('Dpci.create',compact('regions'));
    }

    public function store(DpciRequest $request)
    {
        $data = $request->only(['domaine_fr','domaine_ar','region','type']);

        DP::create([
            'domaine_fr' => $data['domaine_fr'],
            'domaine_ar' => $data['domaine_ar'],
            'type' => $data['type'],
            'dr_id' => $data['region'],
            'created_at' => now()

        ]);
        Session::flash('success',__('dpci.Province success in add'));
        return redirect()->back();
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $dpci = DP::find($id);
        if(!$dpci){
            return redirect()->back();
        }
        $regions = DR::select('id','region_'.LaravelLocalization::getCurrentLocale().' as region')->cursor();
        return view('Dpci.edit',compact('dpci','regions'));
    }

    public function update(Request $request, $dpci_id)
    {
        // validation
        $request->validate([
            'domaine_fr' => 'required|max:200|unique:dpci,domaine_fr,'.$dpci_id,
            'domaine_ar' => 'required|max:200|unique:dpci,domaine_ar,'.$dpci_id,
            'type' => 'required',
            'region' => 'required',

        ],[
            'domaine_fr.required' => __('dpci.Province_fr required'),
            'domaine_fr.max' => __('dpci.Province_fr max'),
            'domaine_fr.unique' => __('dpci.Province_fr unique'),

            'domaine_ar.required' => __('dpci.Province_ar required'),
            'domaine_ar.max' => __('dpci.Province_ar max'),
            'domaine_ar.unique' => __('dpci.Province_ar unique'),

            'type.required' => __('dpci.type required'),
            'region.required' => __('dpci.region required'),
        ]);

        $data = $request->only(['domaine_fr','domaine_ar','type','region']);
        $dpci = DP::find($dpci_id);
        $dpci->update([
            'domaine_fr' => $data['domaine_fr'],
            'domaine_ar' => $data['domaine_ar'],
            'type' => $data['type'],
            'dr_id' => $data['region'],

        ]);
        Session::flash('success',__('dpci.Province success in edit'));
        return redirect()->back();
    }

    public function destroy(Request $request)
    {
        $dpci = DP::find($request->id);
        $dpci->delete();

        Session::flash('success',__('dpci.Province success in supprimer'));
        return redirect()->back();
    }
}
