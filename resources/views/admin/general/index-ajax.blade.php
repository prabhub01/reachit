@inject('helper', App\Helper\Helper)
@extends('layouts.admin.app')
@section('styles')
    <link href="{{ asset('dashboard/plugins/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@section('scripts')
    <script src="{{ asset('dashboard/plugins/datatables/datatables.bundle.js') }}"></script>
    <script type="text/javascript">
        $(function () {
            $('.defaultTable').dataTable({
                "pageLength": 50,
                "columnDefs": [{
                    "orderable": false,
                    "targets": 5
                }]
            });
        });
    </script>


    <script type="text/javascript">
        $(function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.'.$route.'.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'title', name: 'title'},
                    {data: 'code', name: 'code'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'status', name: 'status'},
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

            $('#create{{$view}}').click(function () {
                $('#save{{$view}}').val("Save");
                $('#edit_id').val('');
                $('#form{{$view}}').trigger("reset");
                $('#modelHeading{{$view}}').html("Create New {{$title}}");
                $('#modal{{$view}}').modal('show');
            });

            $('body').on('click', '.edit{{$view}}', function () {
                var item_id = $(this).data('id');
                $.get("{{ route('admin.'.$route.'.index') }}" + '/' + item_id + '/edit', function (data) {
                    $('#modelHeading{{$view}}').html("Edit {{$title}}");
                    $('#save{{$view}}').val("Save..");
                    $('#modal{{$view}}').modal('show');
                    $('#edit_id').val(data.id);
                    $('#title').val(data.title);
                    $('#code').val(data.code);
                    $('#is_active').val(data.is_active);
                })
            });

            $('#save{{$view}}').click(function (e) {
                e.preventDefault();
                $(this).html('Update');

                $.ajax({
                    data: $('#form{{$view}}').serialize(),
                    url: "{{ route('admin.'.$route.'.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {
                        if (data.success != false) {
                            $('#save{{$view}}').html("Save");
                            $('#form{{$view}}').trigger("reset");
                            $('#modal{{$view}}').modal('hide');
                            table.draw();
                        } else {
                            printErrorMsg(data.errors);
                        }
                    },
                    error: function (data) {
                        console.log(data);
                        $('#save{{$view}}').html('Save Changes');
                        printErrorMsg(data.errors);
                    }
                });
            });

            $('body').on('click', '.delete{{$view}}', function () {

                var item_id = $(this).data("id");
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You will not be able to recover this !',
                    info: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, keep it'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            type: "DELETE",
                            url: "{{ route('admin.'.$route.'.store') }}" + '/' + item_id,
                            data: {
                                id: item_id,
                            },
                            success: function (response) {
                                Swal.fire("Deleted!", response.message, "success");
                                table.draw();
                            },
                            error: function (e) {
                                if (e.responseJSON.message) {
                                    Swal.fire('Error', e.responseJSON.message, 'error');
                                } else {
                                    Swal.fire('Error', 'Something went wrong while processing your request.', 'error')
                                }
                            }
                        });
                    }
                });

                // }
            });

        });

        function printErrorMsg(msg) {
            $(".print-error-msg").find("ul").html('');
            $(".print-error-msg").css('display', 'block');
            $.each(msg, function (key, value) {
                $(".print-error-msg").find("ul").append('<li>' + value + '</li>');
            });
        }
    </script>
@endsection

@section('page-header')
    <div class="subheader py-2 py-lg-4  subheader-solid " id="kt_subheader">
        <div class=" container-fluid  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-2">
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{$title}}</h5>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <span class="text-dark-50 font-weight-bold" id="kt_subheader_total">Manage</span>
            </div>
            <div class="d-flex align-items-center">
                @can('master-policy.perform', [$permission, 'add'])
                    <a class="btn btn-success" href="javascript:void(0)" id="create{{$view}}"> Create New {{$title}}</a>
                @endif
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="d-flex flex-column-fluid">
        <div class="container-fluid">
            <div class="card card-custom gutter-b">
                <div class="card-body">
                    <div
                        class="datatable datatable-bordered datatable-head-custom datatable-default datatable-primary datatable-loaded"
                        id="kt_datatable">
                        <table class="table table-bordered data-table">
                            <thead>
                            <tr>
                                <th>S.NO</th>
                                <th>Title</th>
                                <th>Code</th>
                                <th>Created At</th>
                                <th>Status</th>
                                <th width="280px">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal{{$view}}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modelHeading{{$view}}"></h4>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-danger print-error-msg" role="alert" style="display:none">
                            <ul></ul>
                        </div>
                        <form id="form{{$view}}" name="form{{$view}}" class="form-horizontal">
                            <input type="hidden" name="edit_id" id="edit_id">
                            <div class="col-sm-12">
                                <label for="title" class="control-label">Name</label>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="title" name="title"
                                           placeholder="Enter Name" maxlength="100">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <label for="title" class="control-label">Code</label>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="code" name="code"
                                           placeholder="Enter code" maxlength="100">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <label for="first_name" class="control-label">Is Active</label>
                                <div class="form-group">
                                    <select class="form-control" id="is_active" name="is_active">
                                        <option value="1">Active</option>
                                        <option value="0">In-Active</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-primary" id="save{{$view}}" value="Create">Save
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
