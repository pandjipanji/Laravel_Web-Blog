
{!! Form::open(['route' => ['articles.destroy',$id], 'method' => 'delete', 'role' => 'form']) !!}

{!! link_to_route('articles.edit', 'Edit',$id, ['class' => 'btn btn-sm btn-raised btn-primary']) !!} |

{!! Form::submit('Delete', ['class' => 'btn btn-sm btn-raised btn-danger', 'onclick' => "return confirm('Sure want to delete?')"]) !!}


{!! Form::close() !!}

