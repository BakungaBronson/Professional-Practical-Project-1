<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $fund->id !!}</p>
</div>

<!-- Source Field -->
<div class="form-group">
    {!! Form::label('Source', 'Source:') !!}
    <p>{!! $fund->Source !!}</p>
</div>

<!-- Amount Field -->
<div class="form-group">
    {!! Form::label('Amount', 'Amount:') !!}
    <p>{!! $fund->Amount !!}</p>
</div>

<!-- Date Field 
<div class="form-group">
    {!! Form::label('Date', 'Date:') !!}
    <p>{!! $fund->Date !!}</p>
</div> -->

<!-- Deleted At Field 
<div class="form-group">
    {!! Form::label('deleted_at', 'Deleted At:') !!}
    <p>{!! $fund->deleted_at !!}</p>
</div> -->

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Contributed On:') !!}
    <p>{!! $fund->created_at->format('d/m/y') !!}</p>
</div>

<!-- Updated At Field 
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $fund->updated_at !!}</p>
</div> -->

