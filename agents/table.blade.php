<div class="table-responsive">
    <table class="table" id="agents-table">
        <thead>
            <tr>
                <th>Name</th>
        <th>Sex</th>
        <th>Contact</th>
        <th>Roles</th>
        <th>Signature</th>
        <th>District Assigned</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($agents as $agent)
            <tr>
                <td>{!! $agent->Name !!}</td>
            <td>{!! $agent->SEX !!}</td>
            <td>{!! $agent->Contact !!}</td>
            <td>{!! $agent->Roles !!}</td>
            <td>{!! $agent->Signature !!}</td>
            <td>{!! $agent->District_Assigned !!}</td>
                <td>
                    {!! Form::open(['route' => ['agents.destroy', $agent->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('agents.show', [$agent->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('agents.edit', [$agent->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
