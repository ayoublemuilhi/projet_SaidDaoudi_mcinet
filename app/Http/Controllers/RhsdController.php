<?php

namespace App\Http\Controllers;

use App\Http\Requests\Rhsd\RhsdRequest;
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

    public function store(RhsdRequest $request)
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

              Session::flash('success',__('rhsd.rhsd success in add'));
              return back();

          }

    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $rhsd = Rhsd::find($id);
        if(!$rhsd){
            return redirect()->route('rhsd.index');
        }
        $qualites = Qualite::select('id','qualite_'.LaravelLocalization::getCurrentLocale().' as qualite')->cursor();
        $domaines = DP::select('id','domaine_'.LaravelLocalization::getCurrentLocale().' as domaine')->cursor();
        $axes = Axe::select('id','axes_'.LaravelLocalization::getCurrentLocale().' as axe')->cursor();

        return view('rhsd.edit',compact('rhsd','domaines','qualites','axes'));
    }


    public function update(RhsdRequest $request, $id)
    {
        $rhsd = Rhsd::find($id);
        if($request->isMethod('PUT')){
            $fullDate =Carbon::createFromFormat('Y-m-d',$request->date_creation)->format('Y-m-d');
            $Month =Carbon::createFromFormat('Y-m-d',$request->date_creation)->format('m');
            $Year =Carbon::createFromFormat('Y-m-d',$request->date_creation)->format('Y');

            $rhsd->update([
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
                'user_id' => $rhsd->user_id,


            ]);

            Session::flash('success',__('rhsd.rhsd success in add'));
            return back();

        }
    }

    public function updateAll(Request $request){
        $update_all_id = explode(",", $request->update_all_id);
        $uss = User::where('email',Auth::user()->email)->where('id',Auth::id())->first();
        $userRole = $uss->roles->pluck('name')->toArray();
        //the role of user authentifié
        $role_v0 = in_array("v0",$userRole);
        $role_v1 = in_array("v1",$userRole);

        if ($role_v0){

            Rhsd::where('EtatSD',0)->where('RejetSD',0)->where('user_id',Auth::id())->whereIn('id',$update_all_id)->update([
                'EtatSD' => 1
            ]);
        }

        if ($role_v1){
            // rejet = 1 return to v0 (user) et les autres  go to  v2  sinon go to v2

           $rhsds  = Rhsd::select('id','EtatSD','RejetSD','user_id')->where('EtatSD',1)->WhereIn('RejetSD',[0,1])->cursor();


           foreach ($rhsds as $rhsd){
               if($rhsd->RejetSD == 1){
                   Rhsd::where('EtatSD',1)->where('RejetSD',1)->where('user_id',$rhsd->user_id)->whereIn('id',$update_all_id)->update([
                       'EtatSD' => 0
                   ]);
               }else if($rhsd->RejetSD == 0 && $rhsd->EtatSD == 1){
                   // v2
                   Rhsd::where('EtatSD',1)->where('RejetSD',0)->where('user_id',$rhsd->user_id)->whereIn('id',$update_all_id)->update([
                       'EtatSD' => 2
                   ]);

               }

           }


        }


      return redirect()->route('rhsd.index');


    }


    public function destroy($id)
    {
        //
    }
}
