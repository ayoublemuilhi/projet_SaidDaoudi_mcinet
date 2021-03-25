<?php

namespace App\Http\Controllers;

use App\Http\Requests\Rhsd\RhsdRejetRequest;
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
        $role_v2 = in_array("v2",$userRole);
        $role_v3 = in_array("v3",$userRole);
        $role_v4 = in_array("v4",$userRole);
            if($role_sys){
                $rh =   Rhsd::select('id','DateSD','ObjectifSD','RealisationSD','EcartSD','EtatSD','RejetSD','qualite_id','domaine_id','axe_id','user_id','Description','Motif');
            }
            if ($role_v0){
                $rh =  Rhsd::select('id','DateSD','ObjectifSD','RealisationSD','EcartSD','EtatSD','RejetSD','qualite_id','domaine_id','axe_id','user_id','Description','Motif')->whereIn('EtatSD',[0,5])->WhereIn('RejetSD',[0,1])->where('user_id',Auth::user()->id);
            }

        if ($role_v1){
            $rh =  Rhsd::select('id','DateSD','ObjectifSD','RealisationSD','EcartSD','EtatSD','RejetSD','qualite_id','domaine_id','axe_id','user_id','Description','Motif')->whereIn('EtatSD',[1,5])->Where('RejetSD',0);
        }
        if ($role_v2){
            $rh =  Rhsd::select('id','DateSD','ObjectifSD','RealisationSD','EcartSD','EtatSD','RejetSD','qualite_id','domaine_id','axe_id','user_id','Description','Motif')->whereIn('EtatSD',[2,5])->Where('RejetSD',0);
        }
        if ($role_v3){
            $rh =  Rhsd::select('id','DateSD','ObjectifSD','RealisationSD','EcartSD','EtatSD','RejetSD','qualite_id','domaine_id','axe_id','user_id','Description','Motif')->whereIn('EtatSD',[3,5])->Where('RejetSD',0);
        }
        if ($role_v4){
            $rh =  Rhsd::select('id','DateSD','ObjectifSD','RealisationSD','EcartSD','EtatSD','RejetSD','qualite_id','domaine_id','axe_id','user_id','Description','Motif')->whereIn('EtatSD',[4,5])->Where('RejetSD',0);
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

            Session::flash('success',__('rhsd.rhsd success in edit'));
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
        $role_v2 = in_array("v2",$userRole);
        $role_v3 = in_array("v3",$userRole);
        $role_v4 = in_array("v4",$userRole);

        if ($role_v0){

            Rhsd::where('EtatSD',0)->where('RejetSD',0)->where('user_id',Auth::id())->whereIn('id',$update_all_id)->update([
                'EtatSD' => 1
            ]);
        }

        if ($role_v1){
            // rejet = 1 return to v0 (user) et les autres  go to  v2  sinon go to v2

           $rhsds  = Rhsd::select('id','EtatSD','RejetSD','user_id')->where('EtatSD',1)->Where('RejetSD',0)->cursor();
           foreach ($rhsds as $rhsd){
              if($rhsd->RejetSD == 0 && $rhsd->EtatSD == 1){
                   // v2
                   Rhsd::where('EtatSD',1)->where('RejetSD',0)->where('user_id',$rhsd->user_id)->whereIn('id',$update_all_id)->update([
                       'EtatSD' => 2
                   ]);

               }
           }
        }

        if ($role_v2){
            // rejet = 1 return to v0 (user) et les autres  go to  v2  sinon go to v2

            $rhsds  = Rhsd::select('id','EtatSD','RejetSD','user_id')->where('EtatSD',2)->Where('RejetSD',0)->cursor();
            foreach ($rhsds as $rhsd){
                if($rhsd->RejetSD == 0 && $rhsd->EtatSD == 2){
                    // v3
                    Rhsd::where('EtatSD',2)->where('RejetSD',0)->where('user_id',$rhsd->user_id)->whereIn('id',$update_all_id)->update([
                        'EtatSD' => 3
                    ]);

                }
            }
        }

        if ($role_v3){
            // rejet = 1 return to v0 (user) et les autres  go to  v2  sinon go to v2

            $rhsds  = Rhsd::select('id','EtatSD','RejetSD','user_id')->where('EtatSD',3)->Where('RejetSD',0)->cursor();
            foreach ($rhsds as $rhsd){
                if($rhsd->RejetSD == 0 && $rhsd->EtatSD == 3){
                    // send to  v4
                    Rhsd::where('EtatSD',3)->where('RejetSD',0)->where('user_id',$rhsd->user_id)->whereIn('id',$update_all_id)->update([
                        'EtatSD' => 4
                    ]);

                }
            }
        }
        if ($role_v4){
            // rejet = 1 return to v0 (user) et les autres  go to  v2  sinon go to v2

            $rhsds  = Rhsd::select('id','EtatSD','RejetSD','user_id')->where('EtatSD',4)->Where('RejetSD',0)->cursor();
            foreach ($rhsds as $rhsd){
                if($rhsd->RejetSD == 0 && $rhsd->EtatSD == 4){
                    // send to  v4
                    Rhsd::where('EtatSD',4)->where('RejetSD',0)->where('user_id',$rhsd->user_id)->whereIn('id',$update_all_id)->update([
                        'EtatSD' => 5
                    ]);

                }
            }
        }


      return redirect()->route('rhsd.index');


    }


public function updateRejet(Request  $request){

      $rhsd = Rhsd::find($request->re_id);

       if(!$rhsd){ back();}
       $rejet = $rhsd->RejetSD;

       if ($rejet == 1) {
           $rhsd->update(['RejetSD' => 0, 'Motif' => null]);
       }

       //pour le rejet 1 = $rhsd->update(['RejetSD' => 1,'EtatSD' => 0])

    return back();

}


public function  RejetWithMotif($id){
        $rhsd = Rhsd::find($id);

        if(!($rhsd) || $rhsd->RejetSD == 1 ){ return  back();}

   return view('rhsd.update_rejet',compact('rhsd'));
}

public function RejetWithMotifStore(RhsdRejetRequest $request,$id){
    $rhsd = Rhsd::find($id);
    $rhsd->update([
        'Motif' => $request->motif,
        'RejetSD' => 1,
        'EtatSD' => 0
    ]);

    Session::flash('success',__('rhsd.rhsd success in motif'));
    return redirect("/rhsd");

}

    public function destroy(Request  $request)
    {
        $rhsd = Rhsd::find($request->rhsd_id);
        $rhsd->delete();

        Session::flash('success',__('rhsd.rhsd success in supprimer'));
        return redirect()->back();
    }
}
