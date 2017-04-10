@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>
                        <a href="#">
                            {{$tread->owner->name}}  
                        </a>
                        posted: {{$tread->title}}
                    </h4>
                </div>

                <div class="panel-body">
                    {{$tread->body}}
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @foreach($tread->replies as $reply)
            @include('treads.reply') 
            @endforeach
        </div>
    </div>

    @if(auth()->check())
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <form action="{{$tread->path(). '/replies'}}" method="post">

                {{csrf_field()}}
                <div class="form-group">
                    <textarea name="body" id="body" rows="5" class="form-control" placeholder="Have something to say?"></textarea>
                </div>

                <button type="submit" class="btn btn-default">Post</button>
            </form>
        </div>
    </div>
    
    
    @else

    <p class="text-center">Please <a href="{{route('login')}}">sign in</a> to participate in this discussion</p>
    
    @endif
</div>
@endsection
