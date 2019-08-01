<!-- District Code Field -->
<div class="form-group col-sm-6">
    {!! Form::label('District_Code', 'District Code:') !!}
    {!! Form::text('District_Code', null, ['class' => 'form-control']) !!}
</div>

<!-- District Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('District_Name', 'District Name:') !!}
    {!! Form::text('District_Name', null, ['class' => 'form-control']) !!}
</div>

<!-- Number Of Agents Field -->
<div class="form-group col-sm-6">
    {!! Form::label('Number_of_Agents', 'Number Of Agents:') !!}
    {!! Form::number('Number_of_Agents', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('districts.index') !!}" class="btn btn-default">Cancel</a>
</div>
