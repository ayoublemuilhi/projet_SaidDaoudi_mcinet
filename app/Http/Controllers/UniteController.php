<?php

namespace App\Http\Controllers;

use App\Http\Requests\Unites\UniteRequest;
use App\Models\Unite;
use Illuminate\Http\Request;
use Session;
use LaravelLocalization;
class UniteController extends Controller
{
    public function index()
    {
        $unites = Unite::select('id','unite_'.LaravelLocalization::getCurrentLocale().' as unite')->orderBy('id','ASC')->cursor();

        return view('unites.unites',compact('unites'));
    }

    public function create()
    {
        return view('unites.create');
    }

    public function store(UniteRequest $request)
    {
        $data = $request->only(['unite_fr','unite_ar']);

        Unite::create([
            'unite_fr' => $data['unite_fr'],
            'unite_ar' => $data['unite_ar'],
            'created_at' => now()

        ]);
        Session::flash('success',__('unites.unite success in add'));
        return redirect()->back();
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $unite = Unite::find($id);
        if(!$unite){
            return redirect()->back();
        }
        return view('unites.edit',compact('unite'));
    }

    public function update(Request $request, $unite_id)
    {

        // validation
        $request->validate([
            'unite_fr' => 'required|max:255|unique:unites,unite_fr,'.$unite_id,
            'unite_ar' => 'required|max:255|unique:unites,unite_ar,'.$unite_id

        ],[
            'unite_fr.required' => __('unites.unite_fr required'),
            'unite_fr.max' => __('unites.unite_fr max'),
            'unite_fr.unique' => __('unites.unite_fr unique'),

            'unite_ar.required' => __('unites.unite_ar required'),
            'unite_ar.max' => __('unites.unite_ar max'),
            'unite_ar.unique' => __('unites.unite_ar unique'),
        ]);

        $data = $request->only(['unite_fr','unite_ar']);
        $unite = Unite::find($unite_id);
        $unite->update([
            'unite_fr' => $data['unite_fr'],
            'unite_ar' => $data['unite_ar'],

        ]);
        Session::flash('success',__('unites.unite success in edit'));
        return redirect()->back();
    }

    public function destroy(Request $request)
    {

        $unite = Unite::find($request->id);
        $unite->delete();

        Session::flash('success',__('unites.unite success in supprimer'));
        return redirect()->back();
    }
}
