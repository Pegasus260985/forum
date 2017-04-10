@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Forum Treads</div>

                <div class="panel-body">
                    <form action="/treads" method="post">

                        {{csrf_field()}}
                         <div class="form-group">
                             <input type="text" name="title" class="form-control" id="" />
                        </div>
                        
                        <div class="form-group">
                            <textarea name="body" id="body" rows="8" class="form-control" placeholder=""></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Add Tread</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
