@extends('layouts.frontend.app')
@section('title', $setting->name)
@section('header_js')
@endsection
@section('main')


    <!-- .site-header -->

    <div id="custom-header">
        <div class="custom-header-content">
            <div class="container">
                <h1 class="page-title">{{$setting->name}}</h1>
                <div id="breadcrumb">
                    <div  aria-label="Breadcrumbs" class="breadcrumbs breadcrumb-trail">
                        <ul class="trail-items">
                            <li class="trail-item trail-begin"><a href="{{route('home')}}" rel="home"><span>Home</span></a></li>
                            <li class="trail-item trail-end"><span>{{$setting->slug}}</span></li>
                        </ul>
                    </div> <!-- .breadcrumbs -->
                </div> <!-- #breadcrumb -->
            </div> <!-- .container -->
        </div>  <!-- .custom-header-content -->
    </div> <!-- .custom-header -->
    <div id="content" class="site-content default-full-width blog-grid-layout">
        <div class="container">
            <div class="inner-wrapper">
                <div id="primary" class="content-area">
                    <main id="main" class="site-main" >
                        <article class="hentry post">
                            <div class="entry-thumb aligncenter thumb-overlay">
                                <a  href="{{route('page.setting',[$setting->slug])}}" >
                                    @if(file_exists('storage/'.$setting->value) && $setting->value != '')
                                        <img  src="{{asset('storage/'.$setting->value)}}" alt="{{$setting->name}}">
                                    @endif
                                </a>
                                <div class="overlay-box">
                                    <a href="{{route('page.setting',[$setting->slug])}}"><i class="icon-attachment"></i></a>
                                </div>

                            </div> <!-- .entry-thumb -->
                            <div class="entry-content-wrapper">
                                <header class="entry-header">
                                    <h2 class="entry-title"><a href="{{route('page.setting', [$setting->slug])}}" rel="bookmark">{!! $setting->name !!}</a></h2>
                                </header><!-- .entry-header -->

                                <div class="entry-content">
                                    <p>{!! $setting->description !!}</p>
                                </div><!-- .entry-content -->
                            </div><!-- .entry-content-wrapper -->
                        </article><!-- .post -->

                    </main>
                </div>
               <!-- .sidebar -->
            </div> <!-- #inner-wrapper -->
        </div><!-- .container -->
    </div> <!-- #content-->
@endsection

@section('scripts')


    <script type="text/javascript">
        $('.carousel').carousel({
            interval: 2000
        })

        $('#room-id').on('change',function() {
            var roomId = $('#room-id').val();

            $.get("<?php echo url('/')?>" + "/roomlist/"+roomId, function(data, status){
                if(data != 'no data'){
                    var numberOfRooms = data.number_of_rooms;

                    if(numberOfRooms != 0){
                        var options = '';
                        for(i=1; i<= numberOfRooms; i++){
                            options += '<option value="'+i+'">'+i+'</option>';
                        }

                        $('#number-of-rooms option').remove();
                        $('#number-of-rooms').append(options);
                    }else{
                        $('#number-of-rooms option').remove();
                        $('#number-of-rooms').append('<option>'+0+'<option>');
                    }

                }
            });
        });
    </script>
@endsection