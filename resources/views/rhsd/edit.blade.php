@extends('layouts.master')
@section('css')
    <!--- Internal Select2 css-->
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    @if(LaravelLocalization::getCurrentLocale() === "ar")
        <link rel="stylesheet" href="{{ URL::asset('assets/plugins/sumoselect/sumoselect-rtl.css') }}">

    @else
        <link rel="stylesheet" href="{{ URL::asset('assets/plugins/sumoselect/sumoselect.css') }}">

    @endif

@section('title')
    @lang('rhsd.edit rhsd')
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">@lang('sidebar.rhsd')</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    @lang('rhsd.edit rhsd') </span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class=" pb-0">
        <a href="{{route('rhsd.index')}}" class="btn btn-primary" style="color: whitesmoke"><i class="fas fa-undo"></i> @lang('sidebar.return') </a>

    </div>
    <br>
    <div class="row">

        <div class="col-lg-12 col-md-12">

            <div class="card">
                @include('layouts.errors_success')
                <div class="card-body">
                    <form action="{{ route('rhsd.update',$rhsd->id) }}" method="post" autocomplete="off">
                        @csrf
@method('PUT')
                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="inputName" class="control-label">@lang('rhsd.nom_qualite')</label>
                                    <select name="qualite" class="form-control SlectBox" >
                                        <option value=""    selected disabled> @lang('rhsd.choi_qualite')</option>
                                        @if(isset($qualites) && $qualites->count() > 0)
                                            @foreach($qualites as $qualite)
                                                <option @if($qualite->id === $rhsd->qualite_id) selected="selected" @endif value="{{$qualite->id}}">{{$qualite->qualite}}</option>
                                            @endforeach

                                        @endif


                                    </select>

                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="inputName" class="control-label">@lang('rhsd.nom_domaine')</label>
                                    <select name="domaine" class="form-control SlectBox">
                                        <option value=""   selected disabled>@lang('rhsd.choi_domaine')</option>
                                        @if(isset($domaines) && $domaines->count() > 0)
                                            @foreach($domaines as $domaine)
                                                <option @if($domaine->id === $rhsd->domaine_id) selected="selected" @endif value="{{$domaine->id}}">{{$domaine->domaine}}</option>
                                            @endforeach
                                        @endif
                                    </select>

                                </div>

                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="inputName" class="control-label">@lang('rhsd.nom_axe')</label>
                                    <select name="axe" class="form-control SlectBox">
                                        <option value=""   selected disabled>@lang('rhsd.choi_axe')</option>
                                        @if(isset($axes) && $axes->count() > 0)
                                            @foreach($axes as $axe)
                                                <option @if($axe->id === $rhsd->axe_id) selected="selected" @endif value="{{$axe->id}}">{{$axe->axe}}</option>
                                            @endforeach
                                        @endif

                                    </select>

                                </div>

                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('rhsd.date_creation')</label>
                                    <input class="form-control fc-datepicker" name="date_creation" id="date_creation" placeholder="YYYY-MM-DD" value="{{$rhsd->DateSD}}"
                                           type="text" required>
                                </div>

                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputName" class="control-label">@lang('rhsd.nom_objectif')</label>
                                    <input type="text" class="form-control" id="amount1" name="objectif" value="{{$rhsd->ObjectifSD}}">
                                </div>

                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputName" class="control-label">@lang('rhsd.nom_realisation')</label>
                                    <input type="text" class="form-control"  name="realisation" id="amount2" value="{{$rhsd->RealisationSD}}">
                                </div>

                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputName" class="control-label">@lang('rhsd.nom_ecart')</label>

                                    <input type="text" class="form-control"  name="ecart"  readonly id="ecart" value="{{$rhsd->EcartSD}}">
                                </div>

                            </div>



                        </div>


<br>

                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary">@lang('rhsd.btn_add_edit')</button>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>

    </div>

    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!-- Internal Select2 js-->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>

    <!--Internal  Form-elements js-->
    <script src="{{ URL::asset('assets/js/advanced-form-elements.js') }}"></script>
    <script src="{{ URL::asset('assets/js/select2.js') }}"></script>
    <!--Internal Sumoselect js-->
    <script src="{{ URL::asset('assets/plugins/sumoselect/jquery.sumoselect.js') }}"></script>

    <script src="{{ URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js') }}"></script>

    <!-- Internal form-elements js -->
    <script src="{{ URL::asset('assets/js/form-elements.js') }}"></script>
    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>

    <script>
        var date = $('.fc-datepicker').datepicker({
            dateFormat: 'yy-mm-dd'
        }).val();


    </script>

    <script>
        // calculate objectif et realisation and display in Ecart input
        $(document).ready(function(){
            $("input").keyup(function(){
                var obj = $("#amount1").val();
                var rea = $("#amount2").val();
               var sum = 0;
               var ecart = 0;
                if(obj != '' && rea != ''){
                      if( (obj > rea) || (obj == rea) ){
                           sum += obj - rea;
                            ecart += sum * (-1);

                          $("#ecart").val(ecart);
                      }else if(rea > obj){
                          sum += obj - rea;
                          ecart += sum * (-1);
                          $("#ecart").val(ecart);
                      }

                }else{
                    $("#ecart").val('');
                }

            });
        });
    </script>





@endsection
