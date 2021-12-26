@inject('helper', 'App\Helper\Helper')
@extends('layouts.admin.app')
@section('styles')
<link href="{{ asset('dashboard/plugins/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('scripts')

@endsection

@section('page-header')
<div class="subheader py-2 py-lg-4  subheader-solid " id="kt_subheader">
    <div class=" container-fluid  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <div class="d-flex align-items-center flex-wrap mr-2">
            <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Check In Entry</h5>
            <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
            <span class="text-dark-50 font-weight-bold" id="kt_subheader_total">Manage</span>
        </div>
        <div class="d-flex align-items-center">
            @can('master-policy.perform', ['checkin-entry', 'add'])

            @endif
        </div>
    </div>
</div>
@endsection
@section('content')

@livewire('admin.check-in.checkin-list-component')

@endsection