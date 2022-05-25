<a title="Click to Mark as Favorite (Click Again to Undo)"
   onclick="event.preventDefault(); document.getElementById('favorite-question-{{ $model->id }}').submit()"
   class="favorite d-flex flex-column mt-2 {{ Auth::guest() ? 'off' : ($model->is_favorited ? 'favorited' : '') }}">
    <i class="fas fa-star fa-2x mb-2"></i>
    <span class="favorites-count">{{ $model->favorites_count }}</span>
</a>
<form action="{{ route('questions.favorite', $model->id) }}" id="favorite-question-{{$model->id}}" method="POST" style="display: none">
    @csrf
    @if($model->is_favorited)
        @method('DELETE')
    @endif
</form>
