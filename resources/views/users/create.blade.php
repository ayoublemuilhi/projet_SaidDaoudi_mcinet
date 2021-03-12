@extends('layouts.master')
@section('css')
    <!-- Internal Nice-select css  -->
    <link href="{{URL::asset('assets/plugins/jquery-nice-select/css/nice-select.css')}}" rel="stylesheet" />
@section('title')
    @lang('users.add user')
@stop


@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">المستخدمين</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                 @lang('users.add user')</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class=" pb-0">
        <a href="{{route('users.index')}}" class="btn btn-primary" style="color: whitesmoke"><i class="fas fa-undo"></i> @lang('sidebar.return') </a>

    </div>
    <br>
    <div class="row">

        <div class="col-lg-12 col-md-12">

            <div class="card">
                <div class="card-body">
                    @include('layouts.errors_success')
                    <div class="col-lg-12 margin-tb">

                    </div><br>
                    <form  autocomplete="off"  action="{{route('users.store')}}" method="post">
                       @csrf

                        <div class="">

                            <div class="row mg-b-20">
                                <div class=" col-md-6">
                                    <label> @lang('users.nom_user') <span class="tx-danger">*</span></label>
                                    <input class="form-control" name="name"  type="text" value="{{old('name')}}">
                                </div>

                                <div class="col-md-6">
                                    <label>@lang('users.email') <span class="tx-danger">*</span></label>
                                    <input class="form-control" name="email"  type="email" value="{{old('email')}}">
                                </div>
                            </div>

                        </div>

                        <div class="row mg-b-20">
                            <div class="col-md-6">
                                <label>@lang('users.password')<span class="tx-danger"> (Le mot de passe doit comporter au moins 8 caractères) *</span></label>
                                <input class="form-control" name="password"  type="password" value="{{old('password')}}">
                            </div>

                            <div class="col-md-6">
                                <label>@lang('users.confirm_pass') <span class="tx-danger">*</span></label>
                                <input class="form-control form-control"  name="confirm-password" type="password" value="{{old('confirm-password')}}">
                            </div>
                        </div>

                        <div class="row row-sm mg-b-20">
                            <div class="col-lg-6">
                                <label class="form-label">@lang('users.statut')</label>
                                <select name="status" id="select-beast" class="form-control  nice-select  custom-select" value="{{old('status')}}">
                                    <option value="1">@lang('users.active')</option>
                                    <option value="0">@lang('users.Pas active')</option>
                                </select>
                            </div>
                            <div class="col-xs-6 col-md-6">
                                <div class="form-group">
                                    <label class="form-label">@lang('users.role utilisateur') : </label>
                                    <div class="row">
                                        <div class="col-md-3"></div>
                                        @foreach($roles as $role)

                                            <div class="col-md-3">

                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="customCheck_{{$role->id}}" name="roles[]"  value="{{$role->name}}">
                                                    <label class="custom-control-label" for="customCheck_{{$role->id}}">{{$role->name}}</label>
                                                </div>



                                            </div>
                                            <br>



                                        @endforeach

                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <button class="btn btn-primary" type="submit">@lang('users.btn_add_edit')</button>
                        </div>
                    </form>
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


    <!-- Internal Nice-select js-->
    <script src="{{URL::asset('assets/plugins/jquery-nice-select/js/jquery.nice-select.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/jquery-nice-select/js/nice-select.js')}}"></script>

    <!--Internal  Parsley.min js -->
    <script src="{{URL::asset('assets/plugins/parsleyjs/parsley.min.js')}}"></script>
    <!-- Internal Form-validation js -->
    <script src="{{URL::asset('assets/js/form-validation.js')}}"></script>
@endsection
