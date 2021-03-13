<?php

namespace App\Http\Controllers;

use App\Models\Axe;
use App\Models\DP;
use App\Models\Qualite;
use App\Models\Rhsd;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use LaravelLocalization;
use Session;
class RhsdController extends Controller
{

    public function index()
    {
        $uss = User::where('email',Auth::user()->email)->where('id',Auth::id())->first();
        $userRole = $uss->roles->pluck('name')->toArray();
        //the role of user authentifié
        $role_sys = in_array(ROLE,$userRole);
        $role_v0 = in_array("v0",$userRole);
        $role_v1 = in_array("v1",$userRole);
            if($role_sys){
                $rh =   Rhsd::select('id','DateSD','ObjectifSD','RealisationSD','EcartSD','EtatSD','RejetSD','qualite_id','domaine_id','axe_id','user_id');
            }
            if ($role_v0){
                $rh =  Rhsd::select('id','DateSD','ObjectifSD','RealisationSD','EcartSD','EtatSD','RejetSD','qualite_id','domaine_id','axe_id','user_id')->where('EtatSD',0)->WhereIn('RejetSD',[0,1])->where('user_id',Auth::user()->id);
            }

        if ($role_v1){
            $rh =  Rhsd::select('id','DateSD','ObjectifSD','RealisationSD','EcartSD','EtatSD','RejetSD','qualite_id','domaine_id','axe_id','user_id')->where('EtatSD',1)->WhereIn('RejetSD',[0,1]);
        }



         $rhsds = $rh->with(
                ['qualite' => function($q){
                    $q->select('id','qualite_'.LaravelLocalization::getCurrentLocale().' as qualite');
                }])->with(
                ['dpci' => function($qq){
                    $qq->select('id','domaine_'.LaravelLocalization::getCurrentLocale().' as domaine');
                }])->with(
                ['axe' => function($qqq){
                    $qqq->select('id','axes_'.LaravelLocalization::getCurrentLocale().' as axe');
                }])->with(
                ['user' => function($qqqq){
                    $qqqq->select('id','name');
                }])
               ->get();

        return view('rhsd.rhsd',compact('rhsds'));
    }


    public function create()
    {
        $qualites = Qualite::select('id','qualite_'.LaravelLocalization::getCurrentLocale().' as qualite')->orderBy('id','ASC')->cursor();
        $domaines = DP::select('id','domaine_'.LaravelLocalization::getCurrentLocale().' as domaine')->orderBy('id','ASC')->cursor();
        $axes = Axe::select('id','axes_'.LaravelLocalization::getCurrentLocale().' as axes')->orderBy('id','ASC')->cursor();

        return view('rhsd.create',compact('qualites','domaines','axes'));
    }

    public function store(Request $request)
    {
          if($request->isMethod('POST')){
              $fullDate =Carbon::createFromFormat('Y-m-d',$request->date_creation)->format('Y-m-d');
              $Month =Carbon::createFromFormat('Y-m-d',$request->date_creation)->format('m');
              $Year =Carbon::createFromFormat('Y-m-d',$request->date_creation)->format('Y');

              Rhsd::create([
                  'qualite_id' => $request->qualite,
                  'domaine_id' => $request->domaine,
                  'axe_id' => $request->axe,
                  'AnneeSD' => $Year,
                  'MoisSD' => $Month,
                  'DateSD' => $fullDate,
                  'ObjectifSD' => $request->objectif,
                  'RealisationSD' => $request->realisation,
                  'EcartSD' => $request->ecart,
                  'EtatSD' => 0,
                  'RejetSD' => 0,
                  'user_id' => Auth::id(),


              ]);

              Session::flash('success',__('objectifs.objectif success in add'));
              return redirect()->back();

          }

    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
