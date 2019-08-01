<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $payment->id !!}</p>
</div>


<!-- Agent_Name  Field -->
<div class="form-group">
    {!! Form::label('Agent_Name', 'Agent_Name:') !!}
    <p>{!! $payment->Agent_Name !!}</p>
</div>


<!-- Position Field -->
<div class="form-group">
    {!! Form::label('Position', 'Position:') !!}
    <p>{!! $payment->Position !!}</p>
</div>


<!-- Salary Field -->
<div class="form-group">
    {!! Form::label('Salary', 'Salary:') !!}
    <p>{!! $payment->Salary !!}</p>
</div>



<!-- Deleted At Field -->
<div class="form-group">
    {!! Form::label('deleted_at', 'Deleted At:') !!}
    <p>{!! $payment->deleted_at !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $payment->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $payment->updated_at !!}</p>
</div>

