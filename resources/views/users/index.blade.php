@extends('layouts.master')
@section('title') @lang('sidebar.liste secteur')   @endsection
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
                <h4 class="content-title mb-0 my-auto">المستخدمين</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ قائمة
                المستخدمين</span>

            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection

@section('content')

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- row opened -->
    <div class="row row-sm">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="col-sm-1 col-md-2">

                            <a class="btn btn-primary btn-sm" href="{{ route('users.create') }}">اضافة مستخدم</a>

                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive hoverable-table">
                        <table class="table table-hover" id="example1" data-page-length='50' style=" text-align: center;">
                            <thead>
                                <tr>
                                    <th class="wd-10p border-bottom-0">#</th>
                                    <th class="wd-15p border-bottom-0">اسم المستخدم</th>
                                    <th class="wd-20p border-bottom-0">البريد الالكتروني</th>
                                    <th class="wd-15p border-bottom-0">حالة المستخدم</th>
                                    <th class="wd-15p border-bottom-0">نوع المستخدم</th>
                                    <th class="wd-10p border-bottom-0">العمليات</th>
                                </tr>
                            </thead>
                            <tbody>

                            @foreach ($users as $user)
                                <tr>

                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if ($user->status == 1)
                                            <span class="label text-success d-flex">
                                                <div class="bg-success text-center"></div> Activé

                                            </span>

                                        @else
                                            <span class="label text-danger d-flex">
                                                <div class="dot-label bg-danger ml-2"></div>  Pas activé
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        @if (!empty($user->getRoleNames()))
                                            @foreach ($user->getRoleNames() as $role)
                                                <label class="badge badge-success">{{ $role }}</label>
                                            @endforeach
                                        @endif
                                    </td>


                                    <td>
                                        <div class="dropdown">
                                            <button aria-expanded="false" aria-haspopup="true"
                                                    class="btn ripple btn-primary btn-sm" data-toggle="dropdown"
                                                    type="button">العمليات<i class="fas fa-caret-down"></i></button>
                                            <div class="dropdown-menu">

                                                <a class="dropdown-item"
                                                   href="{{route('users.edit',$user->id)}}"><i class=" fas fa-edit" style="color: #239a8a"></i>&nbsp;&nbsp;تعديل
                                                </a>
                                                <a class="dropdown-item"  href="javascript:void(0)"  data-id="{{ $user->id }}" data-name="{{ $user->name }}" data-email="{{ $user->email }}"
                                                   data-toggle="modal" data-target="#modalUserShow"><i
                                                        class="fas fa-eye" style="color: #252e75"></i>&nbsp;&nbsp;عرض
                                                </a>

                                                <a class="dropdown-item"  href="javascript:void(0)" data-id="{{ $user->id }}" data-name="{{ $user->name }}" data-email="{{ $user->email }}"
                                                   data-toggle="modal" data-target="#modalUserSuP"><i
                                                        class="text-danger fas fa-trash-alt"></i>&nbsp;&nbsp;حذف
                                                </a>

                                                <a class="dropdown-item"  href="javascript:void(0)"  data-id="{{ $user->id }}"
                                                   data-toggle="modal" data-target="#modalUserDes"><i
                                                        class="fas fa-lock" style="color: #600a27" ></i>&nbsp;&nbsp;تعطيل الحساب
                                                </a>

                                                <a class="dropdown-item"  href="javascript:void(0)"  data-id="{{ $user->id }}"
                                                   data-toggle="modal" data-target="#modalUserAct"><i
                                                        class="fas fa-lock-open" style="color: #077a17" ></i>&nbsp;&nbsp;تفعيل  الحساب
                                                </a>


                                            </div>
                                        </div>
                                    </td>


                                </tr>

                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--/div-->

        <!-- Modal effects -->
        <div class="modal" id="modalUserSuP">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">حذف المستخدم</h6><button aria-label="Close" class="close"
                                                                         data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                        <form action="{{ url('users/destroy') }}" method="post">
                           @method('DELETE')
                           @csrf
                            <div class="modal-body">
                                <p>هل انت متاكد من عملية الحذف ؟</p><br>
                                <input type="hidden" name="user_id" id="user_id" value="">

                                <div style="text-align: center;">
                                    <img width="30%" height="100px" src="{{asset('/img/delete.svg')}}">

                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                                <button type="submit" class="btn btn-danger">تاكيد</button>
                            </div>
                        </form>
                </div>

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
        $('#modalUserSuP').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var user_name = button.data('name')
            var user_email= button.data('email')
            var modal = $(this)
            modal.find('.modal-body #user_id').val(id);

        })
    </script>
@endsection
