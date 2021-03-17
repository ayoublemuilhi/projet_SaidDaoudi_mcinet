@extends('layouts.master')
@section('title') @lang('sidebar.liste rhsd')   @endsection
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
                <h4 class="content-title mb-0 my-auto">@lang('sidebar.rhsd')</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/  @lang('sidebar.liste rhsd')</span>
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
                    <a href="{{route('rhsd.create')}}" class="btn btn-primary" style="color: whitesmoke"><i class="fas fa-plus"></i> @lang('rhsd.add rhsd') </a>
                    <button type="button" class="btn btn-primary" id="btn_update_all" >
                        @lang('rhsd.envoyer')
                    </button>
                </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example1"  class="table key-buttons text-md-nowrap">
                                <thead>
                                <tr>
                                   <th><input type="checkbox" name="select_all" id="example-select-all" onclick="CheckAll('box1',this)"></th>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">@lang('rhsd.nom_qualite')</th>
                                    <th class="border-bottom-0">@lang('rhsd.nom_domaine')</th>
                                    <th class="border-bottom-0">@lang('rhsd.nom_axe')</th>
                                    <th class="border-bottom-0">@lang('rhsd.date')</th>
                                    <th class="border-bottom-0">@lang('rhsd.nom_objectif')</th>
                                    <th class="border-bottom-0">@lang('rhsd.nom_realisation')</th>
                                    <th class="border-bottom-0">@lang('rhsd.nom_ecart')</th>
                                    <th class="border-bottom-0">@lang('rhsd.rejet')</th>
                                    @hasanyrole('sys')
                                        <th class="border-bottom-0">@lang('rhsd.etat')</th>
                                    @else
                                    @endhasanyrole

                                    <th class="border-bottom-0">@lang('rhsd.user')</th>
                                    <th class="border-bottom-0">@lang('rhsd.description')</th>
                                    <th class="border-bottom-0">@lang('rhsd.motif')</th>
                                    <th class="border-bottom-0">@lang('rhsd.action')</th>


                                </tr>
                                </thead>
                                <tbody>

                                   @forelse($rhsds as $rhsd)
                                       <tr @if($rhsd->RejetSD == 1) style="background-color: #f5b4b4 !important;}" @endif>
                                           <td><input type="checkbox" value="{{$rhsd->id}}" class="box1" ></td>
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
                                               <label class="badge badge-success">@lang('rhsd.non')</label>
                                           @else
                                               <label class="badge badge-danger">@lang('rhsd.oui')</label>
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
                                               <td>
                                                   @if($rhsd->Description != "")
                                                       {{\Illuminate\Support\Str::limit($rhsd->Description,50,'..')}}
                                                   @else

                                                   @endif

                                              </td>

                                       <td>
                                           @if($rhsd->Motif != "")
                                               {{\Illuminate\Support\Str::limit($rhsd->Motif,50,'..')}}
                                           @else

                                           @endif

                                       </td>

                                               <td>
                                                   <div class="dropdown">
                                                       <button aria-expanded="false" aria-haspopup="true"
                                                               class="btn ripple btn-primary btn-sm" data-toggle="dropdown"
                                                               type="button">@lang('rhsd.action')<i class="fas fa-caret-down"></i></button>
                                                       <div class="dropdown-menu">

                                                           <a class="dropdown-item"
                                                              href="{{route('rhsd.edit',$rhsd->id)}}"><i class=" fas fa-edit" style="color: #239a8a"></i>&nbsp;&nbsp;@lang('rhsd.edit')
                                                           </a>


                                                           <a class="dropdown-item"  href="javascript:void(0)" data-id="{{ $rhsd->id }}"
                                                              data-toggle="modal" data-target="#modalRhsdSUP"><i
                                                                   class="text-danger fas fa-trash-alt"></i>&nbsp;&nbsp;@lang('rhsd.supprimer')
                                                           </a>

                                                       </div>
                                                   </div>
                                               </td>



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

    <div class="modal" id="modalRhsdSUP">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">@lang('rhsd.modal supprimer')</h6><button aria-label="Close" class="close" data-dismiss="modal"
                                                                  type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="rhsd/destroy" method="post">
                    @method('DELETE')
                    @csrf
                    <div class="modal-body">
                        <p>@lang('rhsd.modal validation supprision')</p><br>
                        <input type="hidden" name="rhsd_id" id="rhsd_id" value="">

                        <div style="text-align: center;">
                            <img width="30%" height="100px" src="{{asset('/img/ressource_humaine.svg')}}">

                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('rhsd.modal validation close')</button>
                        <button type="submit" class="btn btn-danger">@lang('rhsd.modal validation confirm')</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <!-- حذف مجموعة صفوف -->
    <div class="modal fade" id="update_all" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                        {{ trans('Envoyer') }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="{{route('update_all')}}" method="POST">
                    @csrf
                    <div class="modal-body">
                         <input type="hidden" name="update_all_id" id="update_all_id" value="">
                        <div style="text-align: center;">
                            <img width="30%" height="100px" src="{{asset('/img/resource_humaine_send.svg')}}">

                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('regions.modal validation close')</button>
                        <button type="submit" class="btn btn-danger">@lang('regions.modal validation confirm')</button>
                    </div>
                </form>
            </div>
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
        $('#modalRhsdSUP').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var modal = $(this)
            modal.find('.modal-body #rhsd_id').val(id);

        })
    </script>
    <script type="text/javascript">
        $(function() {
            $("#btn_update_all").click(function() {
                var selected = new Array();
                $("#example1 input[type=checkbox]:checked").each(function() {
                    selected.push(this.value);
                });
                if (selected.length > 0) {
                    $('#update_all').modal('show')
                    $('input[id="update_all_id"]').val(selected);
                }else{

                }
            });
        });
    </script>
@endsection
