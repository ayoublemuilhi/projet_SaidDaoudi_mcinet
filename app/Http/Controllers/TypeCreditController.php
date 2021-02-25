<?php

namespace App\Http\Controllers;


use App\Http\Requests\TypeCredit\TypeCreditRequest;
use App\Models\TypeCredit;
use Illuminate\Http\Request;
use Session;
use LaravelLocalization;
class TypeCreditController extends Controller
{
    public function index()
    {
        $type_credits = TypeCredit::select('id','type_credit_'.LaravelLocalization::getCurrentLocale().' as type_credit')->orderBy('id','ASC')->cursor();

        return view('type_credits.type_credit',compact('type_credits'));
    }

    public function create()
    {
        return view('type_credits.create');
    }

    public function store(TypeCreditRequest $request)
    {
        $data = $request->only(['type_credit_fr','type_credit_ar']);

        TypeCredit::create([
            'type_credit_fr' => $data['type_credit_fr'],
            'type_credit_ar' => $data['type_credit_ar'],
            'created_at' => now()

        ]);
        Session::flash('success',__('type_credit.type credit success in add'));
        return redirect()->back();
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $type_credit = TypeCredit::find($id);
        if(!$type_credit){
            return redirect()->back();
        }
        return view('type_credits.edit',compact('type_credit'));
    }

    public function update(Request $request, $type_credit_id)
    {

        // validation
        $request->validate([
            'type_credit_fr' => 'required|max:200|unique:type_credits,type_credit_fr,'.$type_credit_id,
            'type_credit_ar' => 'required|max:200|unique:type_credits,type_credit_ar,'.$type_credit_id

        ],[
            'type_credit_fr.required' => __('type_credit.type_credit_fr required'),
            'type_credit_fr.max' => __('type_credit.type_credit_fr max'),
            'type_credit_fr.unique' => __('type_credit.type_credit_fr unique'),

            'type_credit_ar.required' => __('type_credit.type_credit_ar required'),
            'type_credit_ar.max' => __('type_credit.type_credit_ar max'),
            'type_credit_ar.unique' => __('type_credit.type_credit_ar unique'),
        ]);

        $data = $request->only(['type_credit_fr','type_credit_ar']);
        $type_credit = TypeCredit::find($type_credit_id);
        $type_credit->update([
            'type_credit_fr' => $data['type_credit_fr'],
            'type_credit_ar' => $data['type_credit_ar'],

        ]);
        Session::flash('success',__('type_credit.type credit success in edit'));
        return redirect()->back();
    }

    public function destroy(Request $request)
    {

        $typeCredit = TypeCredit::find($request->id);
        $typeCredit->delete();

        Session::flash('success',__('type_credit.type credit success in supprimer'));
        return redirect()->back();
    }
}
