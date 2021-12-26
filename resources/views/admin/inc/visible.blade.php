@inject('helper', App\Helper\Helper)
@if(isset($visibleIn) && !empty($visibleIn))
<div class="form-group">
    <label for="" class="control-label col-lg-2">Visible In</label>
    <div class="col-lg-10">
        {!! Form::checkbox('visible_in[]', 1, Helper::visibleIn(1, $visibleIn), array('id'=> 'personal', 'class' => 'view-check')) !!}
        <label for="personal">Personal</label>&nbsp;
        {!! Form::checkbox('visible_in[]', 2, Helper::visibleIn(2, $visibleIn), array('id'=> 'business', 'class' => 'view-check')) !!}
        <label for="business">Business</label>&nbsp;
        {!! Form::checkbox('visible_in[]', 5, Helper::visibleIn(5, $visibleIn), array('id'=> 'trade', 'class' => 'view-check')) !!}
        <label for="trade">Trade</label>&nbsp;
        @if(isset($remittance) && !empty($remittance))
        {!! Form::checkbox('visible_in[]', 4, Helper::visibleIn(4, $visibleIn), array('id'=> 'remittance', 'class' => 'view-check')) !!}
        <label for="remittance">Remittance</label>&nbsp;
        @endif
    </div>
</div>
@else
<div class="form-group">
    <label for="" class="control-label col-lg-2">Visible In</label>
    <div class="col-lg-10">
        {!! Form::checkbox('visible_in[]', 1, '', array('id'=> 'personal', 'class' => 'view-check')) !!}
        <label for="personal">Personal</label>&nbsp;
        {!! Form::checkbox('visible_in[]', 2, '', array('id'=> 'business', 'class' => 'view-check')) !!}
        <label for="business">Business</label>&nbsp;
        {!! Form::checkbox('visible_in[]', 5, '', array('id'=> 'trade', 'class' => 'view-check')) !!}
        <label for="trade">Trade</label>&nbsp;
        @if(isset($remittance) && !empty($remittance))
        {!! Form::checkbox('visible_in[]', 4, '', array('id'=> 'remittance', 'class' => 'view-check')) !!}
        <label for="remittance">Remittance</label>&nbsp;
        @endif
    </div>
</div>
@endif