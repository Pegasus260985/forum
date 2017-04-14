@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
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


                @foreach($replies as $reply)
                    @include('treads.reply')
                @endforeach

                {{ $replies->links() }}

                @if(auth()->check())

                    <form action="{{$tread->path(). '/replies'}}" method="post">
                        {{csrf_field()}}
                        <div class="form-group">
                            <textarea name="body" id="body" rows="5" class="form-control"
                                      placeholder="Have something to say?">{{ old('body') }}</textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-default">Post</button>
                        </div>
                        @if(count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $message)
                                        <li>{{ $message }}</li>
                                    @endforeach
                                </ul>
                            </div>
                    </form>

                @endif

                @else
                    <p class="text-center">
                        Please <a href="{{ route('login') }}">sign in</a> to participate in this discussion
                    </p>
                @endif
            </div>

        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-body">
                    <p>
                        This tread was publish {{ $tread->created_at->diffForHumans() }} by
                        <a href="#">{{ $tread->owner->name }}</a> and currently
                        has {{ $tread->replies_count }} {{ str_plural('comment', $tread->replies()->count()) }}.
                    </p>
                </div>
            </div>
        </div>
        </div>
    </div>
@endsection
