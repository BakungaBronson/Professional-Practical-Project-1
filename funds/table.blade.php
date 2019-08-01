<div class="table-responsive">
    <table class="table" id="funds-table">
        <thead>
            <tr>
                <th>Source</th>
        <th>Amount</th>
        <th>Contributed On</th>
        

        
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($funds as $fund)
            <tr>
                <td>{!! $fund->Source !!}</td>
            <td>{!! $fund->Amount !!}</td>
            <td>{!! $fund->created_at->format('d/m/y') !!}</td>

          
                <td>
                    {!! Form::open(['route' => ['funds.destroy', $fund->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('funds.show', [$fund->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('funds.edit', [$fund->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
