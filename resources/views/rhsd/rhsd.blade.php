@extends('layouts.master')
@section('title') @lang('sidebar.liste region')   @endsection
@section('css')
    <!-- Internal Data table css -->
    <link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
    <link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
    <link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">@lang('sidebar.regions')</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/  @lang('sidebar.liste region')</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row row-sm">


        <div class="col-xl-12">
            <div class="card mg-b-20">
                @include('layouts.errors_success')
                <div class="card-header pb-0">
                    <a href="{{route('rhsd.create')}}" class="btn btn-primary" style="color: whitesmoke"><i class="fas fa-plus"></i> @lang('regions.add region') </a>
                </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example1" class="table key-buttons text-md-nowrap">
                                <thead>
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">Qualite</th>
                                    <th class="border-bottom-0">Domaine</th>
                                    <th class="border-bottom-0">Axe</th>
                                    <th class="border-bottom-0">Date</th>
                                    <th class="border-bottom-0">Objectif</th>
                                    <th class="border-bottom-0">Realisation</th>
                                    <th class="border-bottom-0">Ecart</th>

                                        <th class="border-bottom-0">Rejet </th>
                                    @hasanyrole('sys')
                                        <th class="border-bottom-0">Etat </th>
                                    @else
                                        @endhasanyrole

                                    <th class="border-bottom-0">utilisateur </th>
                                    <th class="border-bottom-0">Description </th>
                                    <th class="border-bottom-0">Motif</th>

                                </tr>
                                </thead>
                                <tbody>

                                   @forelse($rhsds as $rhsd)
                                       <tr @if($rhsd->RejetSD == 1) style="background-color: #ffa6a6 !important;}" @endif>
                                       <td>{{$loop->iteration}}</td>
                                       <td>{{$rhsd->qualite->qualite}}</td>
                                       <td>{{$rhsd->dpci->domaine}}</td>
                                       <td>{{$rhsd->axe->axe}}</td>
                                       <td>{{$rhsd->DateSD}}</td>
                                       <td>{{$rhsd->ObjectifSD}}</td>
                                       <td>{{$rhsd->RealisationSD}}</td>
                                       <td>{{$rhsd->EcartSD}}</td>

                                       <td>
                                           @if($rhsd->RejetSD == 0)
                                               <label class="badge badge-success">Non</label>
                                           @else
                                               <label class="badge badge-danger"> Oui</label>
                                           @endif

                                       </td>
                                           @hasanyrole('sys')
                                       <td>
                                           @if($rhsd->EtatSD == 0)
                                               <label class="badge badge-success">{{ $rhsd->EtatSD }}</label>
                                           @else
                                               <label class="badge badge-danger"> {{$rhsd->EtatSD}}</label>
                                           @endif


                                       </td>
                                           @else
                                               @endhasanyrole

                                               <td>{{$rhsd->user->name}}</td>
                                       </tr>
                                   @empty

                                   @endforelse
                               </tr>



                                </tbody>
                            </table>
                        </div>
                    </div>


            </div>
        </div>


    </div>

    <div class="modal" id="supprimer_region">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">@lang('regions.modal supprimer')</h6><button aria-label="Close" class="close" data-dismiss="modal"
                                                                  type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="regions/destroy" method="post">
                    @method('DELETE')
                    @csrf
                    <div class="modal-body">
                        <p>@lang('regions.modal validation supprision')</p><br>
                        <input type="hidden" name="id" id="id" value="">
                        <input class="form-control" name="region_name" id="region_name" type="text" readonly  >
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('regions.modal validation close')</button>
                        <button type="submit" class="btn btn-danger">@lang('regions.modal validation confirm')</button>
                    </div>

                </form>
            </div>
        </div>

@endsection
@section('js')
    <!-- Internal Data tables -->
    <script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
    <!--Internal  Datatable js -->
    <script src="{{URL::asset('assets/js/table-data.js')}}"></script>

    <script>
        $('#supprimer_region').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var region_name = button.data('region_name')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #region_name').val(region_name);
        })
    </script>
@endsection
