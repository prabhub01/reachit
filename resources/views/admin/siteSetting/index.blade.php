@inject('helper', 'App\Helper\Helper')
@extends('layouts.admin.app')
@section('styles')
    <style>
        .preview {
            position: relative;
        }

        .preview .remove {
            position: absolute;
            left: 41%;
            top: 40%;
            display: none;
        }

        .preview:hover .remove {
            display: block;
        }
    </style>
@endsection
@section('scripts')
    <script>
        $(document).ready(function () {
            $(".preview").on("click", ".remove", function () {
                $object = $(this);
                var id = $object.attr('data-id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You will not be able to recover this !',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, keep it'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            type: "POST",
                            url: baseUrl + "/admin/setting" + "/" + id,
                            data: {
                                id: id,
                                _method: 'DELETE'
                            },
                            success: function (response) {
                                Swal.fire("Deleted!", response.message, "success");
                                $('.preview').html('');
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
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Settings</h5>
                <!--end::Page Title-->
                <!--begin::Actions-->
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
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
            <div class="row">
                <div class="col-12 col-md-9">
                    <div class="card card-custom gutter-b">
                        <div class="card-body">
                            {!! Form::open(array('route' => 'admin.setting.store','class'=>'form-horizontal','id'=>'validator', 'files' => 'true')) !!}
                            <div class="row">
                                <div class="col-3">
                                    <ul class="nav flex-column nav-pills">
                                        <li class="nav-item">
                                            <a class="nav-link active" href="#left-tab1" data-toggle="tab"
                                               aria-expanded="true">
                                                <span class="nav-icon"><i class="la la-cog"></i></span>
                                                <span class="nav-text">General</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#left-tab2" data-toggle="tab"
                                               aria-expanded="false">
                                                <span class="nav-icon"><i class="la la-id-card"></i></span>
                                                <span class="nav-text">Contact</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#left-tab3" data-toggle="tab"
                                               aria-expanded="false">
                                                <span class="nav-icon"><i class="la la-share-alt-square"></i></span>
                                                <span class="nav-text">Social</span>
                                            </a>
                                        </li>
                                        <li class="d-none">
                                            <a class="nav-link" href="#left-tab4" data-toggle="tab"
                                               aria-expanded="false">
                                                <i class="icon-credit-card2 position-left"></i> Remittance
                                            </a>
                                        </li>
                                        <li class="d-none">
                                            <a class="nav-link" href="#left-tab6" data-toggle="tab"
                                               aria-expanded="false">
                                                <span class="nav-icon"><i class="la la-envelope"></i></span><span
                                                    class="nav-text">Grievance</span>
                                            </a>
                                        </li>
                                        <li class="d-none">
                                            <a class="nav-link" href="#left-tab7" data-toggle="tab"
                                               aria-expanded="false">
                                                <i class=" icon-make-group position-left"></i> Schema
                                            </a>
                                        </li>
                                        <li class="d-none">
                                            <a class="nav-link" href="#left-tab8" data-toggle="tab"
                                               aria-expanded="false">
                                                <i class="icon-make-group position-left"></i> Schema Home
                                            </a>
                                        </li>

                                        <li class="d-none">
                                            <a class="nav-link" href="#left-tab9" data-toggle="tab"
                                               aria-expanded="false">
                                                <i class="icon-images3 position-left"></i> Banners
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#left-tab5" data-toggle="tab"
                                               aria-expanded="false">
                                                <span class="nav-icon"><i class="la la-thumbtack"></i></span>
                                                <span class="nav-text">Others</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-9">
                                    <div class="tab-content">
                                        <div class="tab-pane has-padding active" id="left-tab1">
                                            <fieldset class="">
                                                @foreach($general as $item)
                                                    @if($item->key == 'preferred_language')
                                                        <div class="form-group d-none">
                                                            <label for=""
                                                                   class="control-label">{{ $item->title }}</label>
                                                            @php $languages = App\Helper\Helper::getLanguages(); @endphp
                                                            <select name="{{ $item->key }}" class="form-control">
                                                                @foreach($languages as $language)
                                                                    <option
                                                                        value="{{ $language['id'] }}" {{ $item->value == $language['id'] ? 'selected' : '' }}>{{ $language['name'] }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    @elseif(in_array($item->key, ['tagline']))
                                                    @elseif(in_array($item->key, ['multi_language','show_video_banner']))
                                                        <div class="form-group">
                                                            <div class="form-group">
                                                                <div class="checkbox-inline">
                                                                    <label class="checkbox checkbox-lg">
                                                                        <input type="checkbox" name="{{ $item->key }}"
                                                                               value="1" {{ $item->value == 1 ? 'checked' : ''}}>
                                                                        <span></span></label>
                                                                </div>
                                                            </div>
                                                            <span class="">Check to enable language option.</span>
                                                        </div>
                                                    @elseif(in_array($item->key, ['landing_pages']))
                                                        <div class="form-group d-none">
                                                            <label class="control-label">{{ $item->title }}</label>
                                                            {!! Form::textarea($item->key, $item->value, array('class'=>'form-control','rows' => 3)) !!}
                                                        </div>
                                                    @elseif(!in_array($item->key, ['header_logo', 'footer_logo', 'fav_icon', 'site_url']))
                                                        <div class="form-group">
                                                            <label class="control-label">{{ $item->title }}</label>
                                                            {!! Form::text($item->key, $item->value, array('class'=>'form-control')) !!}
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </fieldset>
                                        </div>

                                        <div class="tab-pane has-padding" id="left-tab2">
                                            <fieldset class="">
                                                @foreach($contact as $item)
                                                    @if(in_array($item->key, ['address']))
                                                        <div class="form-group">
                                                            <label class="control-label">{{ $item->title }}</label>
                                                            {!! Form::textarea($item->key, $item->value, array('class'=>'form-control','rows' => 3)) !!}
                                                        </div>
                                                    @else
                                                        <div class="form-group">
                                                            <label class="control-label">{{ $item->title }}</label>
                                                            {!! Form::text($item->key, $item->value, array('class'=>'form-control')) !!}
                                                        </div>
                                                    @endif
                                                    <div class="clearfix"></div>
                                                @endforeach
                                            </fieldset>
                                        </div>

                                        <div class="tab-pane has-padding" id="left-tab3">
                                            <fieldset class="s">
                                                @foreach($social as $item)
                                                    <div class="form-group">
                                                        <label class="control-label">{{ $item->title }}</label>
                                                        {!! Form::text($item->key, $item->value, array('class'=>'form-control')) !!}
                                                    </div>
                                                    <div class="clearfix"></div>
                                                @endforeach
                                            </fieldset>
                                        </div>

                                        <div class="tab-pane has-padding" id="left-tab4">
                                            <fieldset class="s">
                                                @foreach($remittance as $item)
                                                    @if(in_array($item->key, ['remit_map']))
                                                    @elseif(in_array($item->key, ['remit_contact']))
                                                        <div class="form-group">
                                                            <label class="control-label">{{ $item->title }}</label>
                                                            {!! Form::textarea($item->key, $item->value, array('class'=>'form-control', 'rows' => 3)) !!}
                                                        </div>
                                                    @elseif(in_array($item->key, ['remit_banner']))
                                                        <div class="form-group">
                                                            <label class="control-label">{{ $item->title }}</label>
                                                            <div class="col-lg-9">
                                                                <input type="file" name="remit_banner">
                                                            </div>
                                                            <div class="col-lg-12"><br></div>
                                                            <div class="col-lg-3"></div>
                                                            <div class="col-lg-9">
                                                                <div class="label label-striped border-left-info">
                                                                    Preferred size: 1900px / 600px
                                                                </div>
                                                                @if(isset($item->value) && !empty($item->value))
                                                                    <div class="preview">
                                                                        <div
                                                                            class="remove btn btn-danger btn-icon btn-rounded legitRipple"
                                                                            data-id="{{ $item->id }}"><i
                                                                                class="la la-trash"></i></div>
                                                                        <img
                                                                            src="{{ asset('storage/thumbs/'.$item->value) }}"/>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div class="form-group">
                                                            <label class="control-label">{{ $item->title }}</label>
                                                            {!! Form::text($item->key, $item->value, array('class'=>'form-control')) !!}
                                                        </div>
                                                    @endif
                                                    <div class="clearfix"></div>
                                                @endforeach
                                            </fieldset>
                                        </div>

                                        <div class="tab-pane has-padding" id="left-tab5">
                                            <fieldset class="s">
                                                @foreach($others as $item)
                                                    <div class="form-group">
                                                        <label class="control-label">{{ $item->title }}</label>
                                                        @if(in_array($item->key, ['custom_css']))
                                                            {!! Form::textarea($item->key, json_decode($item->value), array('class'=>'form-control', 'rows' => 12)) !!}
                                                        @else
                                                            {!! Form::textarea($item->key, $item->value, array('class'=>'form-control', 'rows' => 3)) !!}
                                                        @endif
                                                    </div>
                                                    <div class="clearfix"></div>
                                                @endforeach
                                            </fieldset>
                                        </div>

                                        <div class="tab-pane has-padding" id="left-tab6">
                                            <fieldset>
                                                @foreach($grievance as $item)
                                                    <div class="form-group">
                                                        <label for="" class="control-label">{{ $item->title }}</label>
                                                        @if(in_array($item->key, ['grievance_handling_officer']))
                                                            {!! Form::textarea($item->key, $item->value, array('class'=>'form-control', 'rows' => 3)) !!}
                                                        @elseif(in_array($item->key, ['grievance_image']))
                                                            <input type="file" name="grievance_image">
                                                            @if(isset($item->value) && !empty($item->value))
                                                                <div class="row">
                                                                    <div class="col-4">
                                                                        <div class="preview">
                                                                            <div
                                                                                class="remove btn btn-danger btn-icon btn-rounded legitRipple"
                                                                                data-id="{{ $item->id }}"><i
                                                                                    class="la la-trash"></i></div>
                                                                            <img
                                                                                src="{{ asset('storage/thumbs/'.$item->value) }}"/>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        @else
                                                            {!! Form::text($item->key, $item->value, array('class' => 'form-control', 'placeholder' => $item->title)) !!}
                                                        @endif
                                                    </div>
                                                @endforeach
                                            </fieldset>
                                        </div>

                                        <div class="tab-pane has-padding" id="left-tab7">
                                            <fieldset class="s">
                                                @foreach($schema as $item)
                                                    <div class="form-group">
                                                        <label class="control-label">{{ $item->title }}</label>
                                                        @if(in_array($item->key, ['schema_home_page']))
                                                            {!! Form::textarea($item->key, $item->value, array('class'=>'form-control', 'rows' => 6)) !!}
                                                        @else
                                                            {!! Form::text($item->key, $item->value, array('class'=>'form-control')) !!}
                                                        @endif
                                                    </div>
                                                    <div class="clearfix"></div>
                                                @endforeach
                                            </fieldset>
                                        </div>
                                        <div class="tab-pane has-padding" id="left-tab8">
                                            <fieldset class="s">
                                                @foreach($schemaHome as $item)
                                                    <div class="form-group">
                                                        <label class="control-label">{{ $item->title }}</label>
                                                        @if(in_array($item->key, ['schema_home_description']))
                                                            {!! Form::textarea($item->key, $item->value, array('class'=>'form-control', 'rows' => 6)) !!}
                                                        @else
                                                            {!! Form::text($item->key, $item->value, array('class'=>'form-control')) !!}
                                                        @endif
                                                    </div>
                                                    <div class="clearfix"></div>
                                                @endforeach
                                            </fieldset>
                                        </div>

                                        <div class="tab-pane has-padding" id="left-tab9">
                                            <fieldset class="s">
                                                @foreach($banners as $item)
                                                    <div class="form-group">
                                                        <label class="control-label">{{ $item->title }}</label>
                                                        <div class="col-lg-9">
                                                            <div class="col-lg-9">
                                                                <input type="file" name="{{ $item->key }}">
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <div class="label label-striped border-left-info">
                                                                    Preferred size: 1900px / 600px
                                                                </div>
                                                                @if(isset($item->value) && !empty($item->value))
                                                                    <div class="preview">
                                                                        <div
                                                                            class="remove btn btn-danger btn-icon btn-rounded legitRipple"
                                                                            data-id="{{ $item->id }}"><i
                                                                                class="la la-trash"></i></div>
                                                                        <img
                                                                            src="{{ asset('storage/thumbs/'.$item->value) }}"/>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                @endforeach
                                            </fieldset>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="text-left col-lg-offset-10 pull-right">
                                <button type="submit" class="btn btn-primary legitRipple"> Submit <i
                                        class="icon-arrow-right14 position-right"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
