<?php

namespace App\Http\Controllers;

use App\Http\Requests\Qualite\QualiteRequest;
use App\Models\Qualite;
use Illuminate\Http\Request;
use Session;
use LaravelLocalization;
class QualiteController extends Controller
{
    public function index()
    {
        $qualites = Qualite::select('id','qualite_'.LaravelLocalization::getCurrentLocale().' as qualite')->orderBy('id','ASC')->cursor();

        return view('qualites.qualites',compact('qualites'));
    }

    public function create()
    {
        return view('qualites.create');
    }

    public function store(QualiteRequest $request)
    {
        $data = $request->only(['qualite_fr','qualite_ar']);

        Qualite::create([
            'qualite_fr' => $data['qualite_fr'],
            'qualite_ar' => $data['qualite_ar'],
            'created_at' => now()

        ]);
        Session::flash('success',__('qualites.qualite success in add'));
        return redirect()->back();
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $qualite = Qualite::find($id);
        if(!$qualite){
            return redirect()->route('qualites.index');
        }
        return view('qualites.edit',compact('qualite'));
    }

    public function update(Request $request, $qualite_id)
    {

        // validation
        $request->validate([
            'qualite_fr' => 'required|max:200|unique:qualites,qualite_fr,'.$qualite_id,
            'qualite_ar' => 'required|max:200|unique:qualites,qualite_ar,'.$qualite_id

        ],[
            'qualite_fr.required' => __('qualites.qualite_fr required'),
            'qualite_fr.max' => __('qualites.qualite_fr max'),
            'qualite_fr.unique' => __('qualites.qualite_fr unique'),

            'qualite_ar.required' => __('qualites.qualite_ar required'),
            'qualite_ar.max' => __('qualites.qualite_ar max'),
            'qualite_ar.unique' => __('qualites.qualite_ar unique'),
        ]);

        $data = $request->only(['qualite_fr','qualite_ar']);
        $qualite = Qualite::find($qualite_id);
        $qualite->update([
            'qualite_fr' => $data['qualite_fr'],
            'qualite_ar' => $data['qualite_ar'],

        ]);
        Session::flash('success',__('qualites.qualite success in edit'));
        return redirect()->back();
    }

    public function destroy(Request $request)
    {

        $qualite = Qualite::find($request->id);
        $qualite->delete();

        Session::flash('success',__('qualites.qualite success in supprimer'));
        return redirect()->back();
    }
}
