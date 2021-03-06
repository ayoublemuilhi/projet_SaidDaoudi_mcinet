@extends('layouts.master')
@section('title') @lang('sidebar.liste action')   @endsection
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
                <h4 class="content-title mb-0 my-auto">@lang('sidebar.actions')</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/  @lang('sidebar.liste action')</span>
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
                    <a href="{{route('actions.create')}}" class="btn btn-primary" style="color: whitesmoke"><i class="fas fa-plus"></i> @lang('actions.add action') </a>
                </div>
                @if($actions->count() > 0)
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example1" class="table key-buttons text-md-nowrap">
                                <thead>
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">@lang('actions.nom_action')</th>
                                    <th class="border-bottom-0">@lang('actions.action')</th>

                                </tr>
                                </thead>
                                <tbody>
                                <?php $i = 0 ?>
                                @forelse($actions as $action)
                                    <tr>

                                        <td>{{++$i}}</td>
                                        <td>{{$action->action}}</td>
                                        <td>
                                            <a class="btn btn-sm btn-info"  href="{{route('actions.edit',$action->id)}}" title="@lang('actions.title edit')"><i class="las la-pen"></i></a>
                                            <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale" data-id="{{ $action->id }}"
                                               data-action_name="{{ $action->action }}" data-toggle="modal" href="#supprimer_action"
                                               title="@lang('actions.title supprimer')"><i
                                                    class="las la-trash"></i></a>

                                        </td>

                                    </tr>
                                @empty

                                @endforelse


                                </tbody>
                            </table>
                        </div>
                    </div>
                @else
                    <div>
                        <img width="100%" height="300px" src="{{asset('assets/img/svgicons/no-data.svg')}}">
                    </div>

                @endif

            </div>
        </div>


    </div>

    <div class="modal" id="supprimer_action">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">@lang('actions.modal supprimer')</h6><button aria-label="Close" class="close" data-dismiss="modal"
                                                                  type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="actions/destroy" method="post">
                    @method('DELETE')
                    @csrf
                    <div class="modal-body">
                        <p>@lang('actions.modal validation supprision')</p><br>
                        <input type="hidden" name="id" id="id" value="">
                        <input class="form-control" name="action_name" id="action_name" type="text" readonly  >
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('actions.modal validation close')</button>
                        <button type="submit" class="btn btn-danger">@lang('actions.modal validation confirm')</button>
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
        $('#supprimer_action').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var action_name = button.data('action_name')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #action_name').val(action_name);
        })
    </script>
@endsection
