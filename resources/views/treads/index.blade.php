@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Forum Treads</div>

                <div class="panel-body">
                    @foreach ($treads as $tread)
                    <article>
                        <h4>
                            <a href="{{$tread->path()}}">{{$tread->title}}</a>
                        </h4>
                        <div class="body">{{$tread->body}}</div>
                    </article>
                    <hr />
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
