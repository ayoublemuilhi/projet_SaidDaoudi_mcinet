@extends('layouts.master')
@section('css')

@endsection
@section('title')
    @lang('qualites.edit qualite')
@stop

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">@lang('sidebar.qualites')</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                     @lang('qualites.edit qualite') </span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class=" pb-0">
        <a href="{{route('qualites.index')}}" class="btn btn-primary" style="color: whitesmoke"><i class="fas fa-undo"></i> @lang('sidebar.return') </a>

    </div>
    <div class="row">
        <div class="col-lg-2 col-md-2"></div>

        <div class="col-lg-8 col-md-8">
            <div class="card">
                @include('layouts.errors_success')
                <div class="card-body">
                    <form action="{{route('qualites.update',$qualite->id)}}" method="POST" autocomplete="off">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="inputName" class="control-label">@lang('qualites.nom_qualite_fr')</label>
                            <input type="text" class="form-control" id="inputName" name="qualite_fr" dir="ltr"
                                   title="@lang('qualites.form.title')" value="{{$qualite->qualite_fr}}">
                        </div>

                        <div class="form-group">
                            <label for="inputName" class="control-label">@lang('qualites.nom_qualite_ar')</label>
                            <input type="text" class="form-control" id="inputName" name="qualite_ar" dir="rtl"
                                   title="@lang('qualites.form.title')" value="{{$qualite->qualite_ar}}">
                        </div>


                           <br>
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary">@lang('qualites.btn_add_edit')</button>
                        </div>


                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-2"></div>
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

    <!--Internal Fancy uploader js-->
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.ui.widget.js') }}"></script>

    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.iframe-transport.js') }}"></script>

    <script src="{{ URL::asset('assets/plugins/fancyuploder/fancy-uploader.js') }}"></script>
    <!--Internal  Form-elements js-->
    <script src="{{ URL::asset('assets/js/advanced-form-elements.js') }}"></script>
    <script src="{{ URL::asset('assets/js/select2.js') }}"></script>
    <!--Internal Sumoselect js-->
    <script src="{{ URL::asset('assets/plugins/sumoselect/jquery.sumoselect.js') }}"></script>
    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!--Internal  jquery.maskedinput js -->
    <script src="{{ URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js') }}"></script>
    <!--Internal  spectrum-colorpicker js -->
    <script src="{{ URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js') }}"></script>
    <!-- Internal form-elements js -->
    <script src="{{ URL::asset('assets/js/form-elements.js') }}"></script>







@endsection

