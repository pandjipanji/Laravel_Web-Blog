
<!--{!! Form::open(['route' => ['articles.destroy',$id], 'method' => 'delete', 'role' => 'form']) !!}-->

<a href="{{route('articles.edit', $id)}}" class="btn btn-sm btn-raised btn-primary"> Edit 
    <span class="glyphicon glyphicon-pencil"></span>
</a>
<!--{!! link_to_route('articles.edit', 'Edit',$id, ['class' => 'btn btn-sm btn-raised btn-primary']) !!}--> |

<button class="btn btn-sm btn-raised btn-danger deleteData" data-id="{{$id}}" onclick="deleteData({{$id}})">Delete 
    <span class="glyphicon glyphicon-trash"></span>
</button>

<!--{!! Form::submit('Delete', ['class' => 'btn btn-sm btn-raised btn-danger', 'onclick' => "return confirm('Sure want to delete?')"]) !!}-->


<!--{!! Form::close() !!}-->

