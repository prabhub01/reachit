@extends('layouts.frontend.app')
@section('title','Search Results')
@section('header_js')
@endsection
@section('main')

<section class="inner_header_bg "> <svg viewBox="-1.5 529.754 603 71.746" preserveAspectRatio="none">
  <path d=" M 0 560 Q 66.018 533.115 153.816 571.235 C 241.613 609.355 293.526 571.416 310 560 C 346.774 534.516 402.903 510.645 450 560 Q 497.097 609.355 600 560 L 600 600 L 0 600 L 0 560 Z " stroke-width="3"></path>
  </svg> <img src="{{asset('images/innerbanner3.jpg')}}" > </section>
<section class="pd content">
  <div class="container">
    <div class="title">
      <h1>Most Relevent Packages</h1>
      <span>MAT Nepal gather popular packages so you can spend less time searching</span></div>
    <div class="row">
    @forelse ($packages as $package)
      <div class="col-md-4 col-sm-6">
        <div class="card">
          <div class="card_img"> 
          <a href="{{ url('package/'.$package->slug) }}">
          @if(file_exists('storage/'.$package->image) && $package->image != '')
         <img src="{{asset('storage/'.$package->image)}}" alt="Everest Base Camp Trek" style="height: 270px; width: 358px;">
          @else
         <img src="{{asset('images/ebc.jpg')}}" alt="Everest Base Camp Trek" >
          @endif
       </a> 
         </div>
          <div class="price"><span>${{$package->cost}}</span></div>
          <div class="card_title"><a href="{{ url('package/'.$package->slug) }}">{{$package->title}}</a></div>
          <div class="duration">Duration : {{$package->duration}} Days </div>
          <div class="rating"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
          <div class="clear"></div>
        </div>
      </div>
      @empty
        <p>No Packages Found !!!</p>
      @endforelse
    </div>
    <div class="clear"></div>
  <!--   <div class="text-center">
      <ul class="pagination">
        <li><a href="#">&laquo;</a></li>
        <li><a href="#">1</a></li>
        <li><a href="#">2</a></li>
        <li class="active"><a href="#">3</a></li>
        <li><a href="#">4</a></li>
        <li><a href="#">5</a></li>
        <li><a href="#">&raquo;</a></li>
      </ul>
    </div> -->
  </div>
</section>
@endsection