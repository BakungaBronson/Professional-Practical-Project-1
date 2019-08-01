<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('Name', 'Name:') !!}
    {!! Form::text('Name', null, ['class' => 'form-control']) !!}
</div>

<!-- Sex Field -->
<div class="form-group col-sm-6">
    {!! Form::label('SEX', 'Sex:') !!}
    {!! Form::text('SEX', null, ['class' => 'form-control']) !!}
</div>

<!-- Contact Field -->
<div class="form-group col-sm-6">
    {!! Form::label('Contact', 'Contact:') !!}
    {!! Form::number('Contact', null, ['class' => 'form-control']) !!}
</div>

<!-- Role Field 
<div class="form-group col-sm-6">
    {!! Form::label('Roles', 'Roles:') !!}
    {!! Form::text('Roles', null, ['class' => 'form-control']) !!}
</div>  -->

<!-- Signature Field -->
<div class="form-group col-sm-6">
    {!! Form::label('Signature', 'Signature:') !!}
    {!! Form::text('Signature', null, ['class' => 'form-control']) !!}
</div>

<!-- District Assigned Field 
<div class="form-group col-sm-6">
    {!! Form::label('District_Assigned', 'District Assigned:') !!}
    {!! Form::text('District_Assigned', null, ['class' => 'form-control']) !!}
</div> -->

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('agents.index') !!}" class="btn btn-default">Cancel</a>
</div>
