@can('accept', $model)
    <a title="Mark this as Best Answer" class="favorite d-flex flex-column mt-2 {{ $model->status }} " onclick="event.preventDefault(); document.getElementById('accept-answer-{{ $model->id }}').submit()">
        <i class="fas fa-check fa-2x mb-2"></i>
    </a>
    <form action="{{ route('answers.accept', $model->id) }}" id="accept-answer-{{$model->id}}" method="POST" style="display: none;">
        @csrf
    </form>
@else
    @if ($model->is_best)
        <a title="This answer has been accepted as best answer" class="favorite d-flex flex-column mt-2 {{ $model->status }} ">
            <i class="fas fa-check fa-2x mb-2"></i>
        </a>
    @endif
@endcan
