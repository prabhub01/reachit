@extends('layouts.admin.app')
@section('styles')

@endsection

@section('scripts')
    <script>
        $(function () {
            $(".type-check-all").click(function () {
                $(".type-check").prop('checked', $(this).prop("checked"));
            });
            $(".view-check-all").click(function () {
                $(".view-check").prop('checked', $(this).prop("checked"));
            });
        });

        $('form').submit(function () {
            $(this).find("button[type='submit']").prop('disabled', true);
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
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{!! $title !!}</h5>
                <!--end::Page Title-->
                <!--begin::Actions-->
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <span class="text-dark-50 font-weight-bold" id="kt_subheader_total">Create</span>
                <!--end::Actions-->
            </div>
            <!--end::Info-->

            <!--begin::Toolbar-->
            <div class="d-flex align-items-center">
                <a href="{{ route('admin.'.$route.'.index') }}"
                   class="btn btn-default btn-outline-success font-weight-bolder">Back</a>
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
            {!! Form::open(array('route' => 'admin.'.$route.'.store','class'=>'form-horizontal','id'=>'validator', 'files' => 'true')) !!}
            <div class="row">
                <div class="col-12 col-md-9">
                    <div class="card card-custom gutter-b">
                        <div class="card-body">
                            <div class="form-group">
                                <div class="checkbox-inline">
                                    <label class="checkbox checkbox-lg">
                                        <input type="checkbox" name="is_active" value="1" checked="checked">
                                        <span></span>Publish ?</label>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Image  <span
                                                class="text-danger">*</span></label>
                                    <span class="text-muted float-right">Preferred size: ..x..px</span>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="image" accept="image/*"
                                               id="image-file">
                                        <label class="custom-file-label selected" for="image-file"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card card-custom gutter-b">
                        <div class="card-body">
                            @php
                                use App\Helper\Helper;use App\Helper\SettingHelper;$languages = Helper::getLanguages();
                                $isMultiLanguage = SettingHelper::setting('multi_language');
                            @endphp
                            @if($isMultiLanguage)
                                <ul class="nav nav-tabs nav-tabs-line nav-tabs-line-2x">
                                    @php $count=0; @endphp
                                    @foreach($languages as $language)
                                        <li class="nav-item"><a class="nav-link {{ ($count == 0) ? 'active' : '' }}"
                                                                data-toggle="tab"
                                                                href="#aa-{{ $language['id'] }}">{{ $language['name'] ?? '' }}</a>
                                        </li>
                                        @php $count++; @endphp
                                    @endforeach
                                </ul>
                            @endif
                            <div class="tab-content mt-5">
                                @php $count=0; @endphp

                                @foreach($languages as $language)
                                    <div id="aa-{{ $language['id'] }}"
                                         class="tab-pane fade in {{ ($count == 0) ? 'active show' : '' }}">
                                        <div class="form-group">
                                            <label class="control-label">Title <span
                                                        class="text-danger">*</span></label>
                                            {!! Form::text('title['.$language['id'].']', null, array('class'=>'form-control','required'=>'required')) !!}
                                        </div>
                                        <div class="form-group">
                                            {{--<label class="control-label">Description <span--}}
                                                        {{--class="text-danger">*</span></label>--}}
                                            {!! Form::hidden('destination'.$language['id'].']', null, array('class'=>'form-control')) !!}
                                        </div>
                                    </div>
                                    @php
                                        $count++;
                                        if(!$isMultiLanguage){
                                        break;
                                        }
                                    @endphp
                                @endforeach
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
