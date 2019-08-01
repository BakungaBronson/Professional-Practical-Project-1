<!-- Source Field -->
<div class="form-group col-sm-6">
    {!! Form::label('Source', 'Source:') !!}
    {!! Form::text('Source', null, ['class' => 'form-control']) !!}
</div>

<!-- Amount Field -->
<div class="form-group col-sm-6">
    {!! Form::label('Amount', 'Amount:') !!}
    {!! Form::number('Amount', null, ['class' => 'form-control']) !!}
</div>

<!-- Date Field 
<div class="form-group col-sm-6">
    {!! Form::label('Date', 'Date:') !!}
    php date('d=28')
    <input type= 'date'>
</div>-->



@section('scripts')
   <script type="text/javascript">
        $('#Date').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: false
        })
    </script>
@endsection 

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('funds.index') !!}" class="btn btn-default">Cancel</a>
</div>
