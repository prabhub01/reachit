@if (session('status'))
<div class="message is-success">
    <div class="message-body">
        <h4><i class="icon fa fa-check"></i> Success:</h4>
        {!! session('status') !!}
    </div>
</div>
@endif


@if(Session::has('flash_success'))
<div class="message is-success">
    <div class="message-body">
        <h4><i class="icon fa fa-check"></i> Success:</h4>
        {!! Session::get('flash_success') !!}
    </div>
</div>
@endif

@if(Session::has('flash_notice'))
<div class="message is-dark">
    <div class="message-body">
        <h4><i class="icon fa fa-check"></i> Success:</h4>
        {!! Session::get('flash_notice') !!}
    </div>
</div>
@endif

@if (Session::has('flash_error'))
<div class="message is-danger">
    <div class="message-body">
        <h4><i class="icon far fa-bell"></i> Error!</h4>
        {!! Session::get('flash_error') !!}
    </div>
</div>
@endif

@if ($errors->any())
<div class="message is-danger">
    <div class="message-body">
        <h4><i class="icon fa fa-ban"></i>Error(s):</h4>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
</div>
@endif

@if (Session::has('flash_info'))
<div class="message is-info">
    <div class="message-body">
        <h4><i class="icon fa fa-info"></i> Notice:</h4>
        {!! Session::get('flash_info') !!}
    </div>
</div>
@endif