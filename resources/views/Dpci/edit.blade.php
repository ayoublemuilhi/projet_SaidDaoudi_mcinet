@extends('layouts.master')
@section('css')
    <!--- Internal Select2 css-->
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    @if(LaravelLocalization::getCurrentLocale() === "ar")
        <link rel="stylesheet" href="{{ URL::asset('assets/plugins/sumoselect/sumoselect-rtl.css') }}">
    @else
        <link rel="stylesheet" href="{{ URL::asset('assets/plugins/sumoselect/sumoselect.css') }}">
    @endif
@endsection
@section('title')
    @lang('dpci.edit Province')
@stop

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">@lang('sidebar.dpci')</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                     @lang('dpci.edit Province') </span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class=" pb-0">
        <a href="{{route('dpci.index')}}" class="btn btn-primary" style="color: whitesmoke"><i class="fas fa-undo"></i> @lang('sidebar.return') </a>

    </div>
    <br>
    <div class="row">
        <div class="col-lg-1 col-md-1"></div>

        <div class="col-lg-9 col-md-9">
            <div class="card">
                @include('layouts.errors_success')
                <div class="card-body">
                    <form action="{{route('dpci.update',$dpci->id)}}" method="POST" autocomplete="off">
                        @csrf
                        @method('PUT')


                        <div class="row">
                            <div class="col-lg-6">


                                <div class="form-group">
                                    <label for="inputName" class="control-label m-2">@lang('dpci.nom_province_fr')</label>
                                    <input type="text" class="form-control" id="inputName" name="domaine_fr" dir="ltr"
                                           value="{{$dpci->domaine_fr}}">
                                </div>

                                <div class="form-group">
                                    <label for="inputName" class="control-label m-2">@lang('dpci.nom_province_ar')</label>
                                    <input type="text" class="form-control" id="inputName" name="domaine_ar" dir="rtl"
                                           value="{{$dpci->domaine_ar}}">
                                </div>



                                <br>
                            </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="inputName" class="control-label m-2">@lang('dpci.nom_region')</label>
                                        <select name="region" class="form-control SlectBox">
                                            <option value=""  selected disabled>@lang('dpci.form select')</option>
                                            @foreach($regions as $region)
                                                <option @if($region->id === $dpci->dr_id) selected="selected" @endif value="{{$region->id}}" >{{$region->region}}</option>

                                            @endforeach


                                        </select>

                                    </div>

                                    <div class="form-group">
                                        <label for="inputName" class="control-label m-2">@lang('dpci.nom_type')</label>
                                        <select name="type" class="form-control SlectBox" title="@lang('dpci.form select type')" >
                                            @if($dpci->type == 'P')
                                                <option value="P" selected>Province</option>
                                                <option value="R">Region</option>
                                            @else
                                                <option value="R" selected>Region</option>
                                                <option value="P" >Province</option>

                                            @endif




                                        </select>

                                    </div>
                                </div>



                        </div>
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary">@lang('objectifs.btn_add_edit')</button>
                        </div>


                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-1 col-md-1"></div>
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
    <!--Internal  spectrum-colorpicker js -->
    <script src="{{ URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js') }}"></script>
    <!-- Internal form-elements js -->
    <script src="{{ URL::asset('assets/js/form-elements.js') }}"></script>







@endsection

