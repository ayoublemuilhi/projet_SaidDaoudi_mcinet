<?php

namespace App\Http\Controllers;

use App\Http\Requests\Axes\AxeRequest;
use App\Models\Axe;
use Illuminate\Http\Request;
use LaravelLocalization;
use Session;
class AxeController extends Controller
{

    public function index()
    {
        $axes = Axe::select('id','axes_'.LaravelLocalization::getCurrentLocale().' as axe')->orderBy('id','ASC')->cursor();

        return view('axes.axes',compact('axes'));
    }

    public function create()
    {
        return view('axes.create');
    }

    public function store(AxeRequest $request)
    {
        $data = $request->validated();

        Axe::create([
            'axes_fr' => $data['axe_fr'],
            'axes_ar' => $data['axe_ar'],
            'created_at' => now()

        ]);
        Session::flash('success',__('axes.axe success in add'));
        return redirect()->back();
    }

    public function show(Axe $axe)
    {
        //
    }

    public function edit($id)
    {
        $axe = Axe::find($id);
        if(!$axe){
            return redirect()->back();
        }
        return view('axes.edit',compact('axe'));
    }

    public function update(Request $request,  $axe_id)
    {
        // validation
        $request->validate([
            'axe_fr' => 'required|max:200|unique:axes,axes_fr,'.$axe_id,
            'axe_ar' => 'required|max:200|unique:axes,axes_ar,'.$axe_id,

        ],[
            'axe_fr.required' => __('axes.axe_fr required'),
            'axe_fr.max' => __('axes.axe_fr max'),
            'axe_fr.unique' => __('axes.axe_fr unique'),

            'axe_ar.required' => __('axes.axe_ar required'),
            'axe_ar.max' => __('axes.axe_ar max'),
            'axe_ar.unique' => __('axes.axe_ar unique'),
        ]);

        $data = $request->only(['axe_fr','axe_ar']);

        $axe = Axe::find($axe_id);
        $axe->update([
            'axes_fr' => $data['axe_fr'],
            'axes_ar' => $data['axe_ar'],

        ]);
        Session::flash('success',__('axes.axe success in edit'));
        return redirect()->back();
    }

    public function destroy(Request $request)
    {
        $axe = Axe::find($request->id);
        $axe->delete();

        Session::flash('success',__('axes.axe success in supprimer'));
        return redirect()->back();
    }
}
