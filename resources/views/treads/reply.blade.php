<div class="panel panel-default">

    <div class="panel-heading">


        <h4>
            <a href="#">
                {{$reply->owner->name}}                             
            </a>
            said {{$reply->created_at->diffForHumans()}}...
        </h4>
    </div>

    <div class="panel-body">
        {{$reply->body}}
    </div>

</div>