@extends('layouts.admin.app')
@section('styles')
    <link rel="stylesheet" type="text/css"
        href="{{ asset('/backend/css/tables/datatable/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('/backend/css/tables/datatable/responsive.bootstrap5.min.css') }}">
@endsection
@section('scripts')
    <script src="{{ asset('/backend/js/tables/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/backend/js/tables/datatable/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('/backend/js/tables/datatable/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('/backend/js/tables/datatable/responsive.bootstrap5.js') }}"></script>
    <script src="{{ asset('/backend/js/tables/datatable/table-datatables-advanced.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.defaultTable').dataTable({
                "pageLength": 50,
                "columnDefs": [{
                    "orderable": false,
                    "targets": 3
                }]
            });

            $(".defaultTable").on("click", ".change-status", function() {
                $object = $(this);
                var id = $object.attr('id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'Do you want to change the status',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, change it!',
                    cancelButtonText: 'No, keep it'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            type: "GET",
                            url: "{{ url('admin/users/change-status') }}/" + id,
                            dataType: 'json',
                            success: function(response) {
                                Swal.fire("Thank You!", response.message, "success");
                                if (response.response.is_active == 1) {
                                    $($object).children().removeClass('la-minus');
                                    $($object).children().addClass('la-check');
                                } else {
                                    $($object).children().removeClass('la-check');
                                    $($object).children().addClass('la-minus');
                                }
                            },
                            error: function(e) {
                                if (e.responseJSON.message) {
                                    Swal.fire('Error', e.responseJSON.message, 'error');
                                } else {
                                    Swal.fire('Error',
                                        'Something went wrong while processing your request.',
                                        'error')
                                }
                            }
                        });

                    }
                })
            });


        });
    </script>
@endsection
@section('page-header')
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-4  subheader-solid " id="kt_subheader">
        <div class=" container-fluid  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Roles</h5>
                <!--end::Page Title-->
                <!--begin::Actions-->
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200">Users</div>
                <!--end::Actions-->
            </div>
            <!--end::Info-->

            <!--begin::Toolbar-->
            <div class="d-flex align-items-center">
            </div>
            <!--end::Toolbar-->
        </div>
    </div>
    <!--end::Subheader-->
@endsection
@section('content')
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container-fluid">
            <div class="card card-custom gutter-b">
                <div class="card-body">
                    <div class="datatable datatable-bordered datatable-head-custom datatable-default datatable-primary datatable-loaded"
                        id="kt_datatable">
                        <table class="table datatable-column-search-inputs defaultTable">
                            <thead>
                                <tr>
                                    <th width="50px">S.No.</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Mobile Number</th>
                                    <th class="text-center" width="130px">ID</th>
                                    <th width="80px">Status</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th width="50px">S.No.</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Mobile Number</th>
                                    <th class="text-center" width="130px">ID</th>
                                    <th width="80px">Status</th>

                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($users as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->first_name . ' ' . $item->middle_name . ' ' . $item->last_name }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->mobile_number }}</td>
                                        <td class="text-center">
                                            {{ $item->card_number }}
                                        </td>
                                        <td>
                                            <a title="Change Status" href="javascript:void(0)"
                                                class="btn btn-outline-dark waves-effect change-status" id="{{ $item->id }}">
                                                @if ($item->is_active == 1)
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check me-25"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                                @else
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                                @endif
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
