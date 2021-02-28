<?php

namespace App\Http\Controllers;

use App\Http\Requests\Actions\ActionRequest;
use App\Models\Action;
use Illuminate\Http\Request;
use Session;
use LaravelLocalization;
class ActionController extends Controller
{
    public function index()
    {
        $actions = Action::select('id','action_'.LaravelLocalization::getCurrentLocale().' as action')->orderBy('id','ASC')->cursor();

        return view('actions.actions',compact('actions'));
    }

    public function create()
    {
        return view('actions.create');
    }

    public function store(ActionRequest $request)
    {
        $data = $request->only(['action_fr','action_ar']);

        Action::create([
            'action_fr' => $data['action_fr'],
            'action_ar' => $data['action_ar'],
            'created_at' => now()

        ]);
        Session::flash('success',__('actions.action success in add'));
        return redirect()->back();
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $action = Action::find($id);
        if(!$action){
            return redirect()->route('actions.index');
        }
        return view('actions.edit',compact('action'));
    }

    public function update(Request $request, $action_id)
    {

        // validation
        $request->validate([
            'action_fr' => 'required|max:255|unique:actions,action_fr,'.$action_id,
            'action_ar' => 'required|max:255|unique:actions,action_ar,'.$action_id

        ],[
            'action_fr.required' => __('actions.action_fr required'),
            'action_fr.max' => __('actions.action_fr max'),
            'action_fr.unique' => __('actions.action_fr unique'),

            'action_ar.required' => __('actions.action_ar required'),
            'action_ar.max' => __('actions.action_ar max'),
            'action_ar.unique' => __('actions.action_ar unique'),
        ]);

        $data = $request->only(['action_fr','action_ar']);
        $action = Action::find($action_id);
        $action->update([
            'action_fr' => $data['action_fr'],
            'action_ar' => $data['action_ar'],

        ]);
        Session::flash('success',__('actions.action success in edit'));
        return redirect()->back();
    }

    public function destroy(Request $request)
    {

        $action = Action::find($request->id);
        $action->delete();

        Session::flash('success',__('actions.action success in supprimer'));
        return redirect()->back();
    }
}
