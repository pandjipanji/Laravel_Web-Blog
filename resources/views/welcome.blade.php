@extends("layouts.application")
@section("content")
@if(Sentinel::check())
    @if(Sentinel::getUser()->hasAccess('admin'))
        <div class="panel panel-primary">
            <div class="panel-heading text-center">
                <h4>Articles Data</h4>
            </div>
            <div class="panel-body">
            
                    <table id="articles" class="table table-hover table-bordered table-condensed table-responsive">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Title</th>
                                    <th>Content</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
            </div>
            <div class="panel-footer">Articles Data</div>
        </div>
    @endif
@endif    
@stop
