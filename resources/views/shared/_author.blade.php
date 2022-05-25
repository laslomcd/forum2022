<span class="text-muted"> {{$label . " " . $model->created_date}} </span>
<div class="media mt-2 d-flex flex-row justify-content-evenly align-items-center">
    <a href="{{ $model->user->url }}" class="p-2">
        <img src="{{ $model->user->avatar }}" alt="">
    </a>
    <div class="media-body">
        <a href="{{ $model->user->url }}">{{ $model->user->name }}</a>
    </div>
</div>
