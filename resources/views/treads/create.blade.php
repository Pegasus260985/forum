@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Forum Treads</div>

                <div class="panel-body">
                    <form action="/treads" method="post">

                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="channel_id">Choose a channel</label>
                            <select name="channel_id"  class="form-control" required="true">
                                <option value="">Choose one...</option>

                                @foreach($channels as $channel)
                                <option value="{{ $channel->id }}" {{ old('channel_id') == $channel->id ? 'selected' : '' }}>{{ $channel->name }}</option>
                                @endforeach

                            </select>
                        </div>

                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" class="form-control"  
                                   value="{{ old('title') }}" required="true"/>
                        </div>

                        <div class="form-group">
                            <label for="body">Body</label>
                            <textarea name="body" id="body" rows="8" 
                                      class="form-control" required="true">{{ old('body') }}</textarea>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Add Tread</button>
                        </div>


                        @if(count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $message)
                                <li>{{ $message }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
