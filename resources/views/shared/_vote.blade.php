@php
    use App\Models\Question;
    use App\Models\Answer;
@endphp

@if($model instanceof Question)
    @php
    $name = 'question';
    $firstURISegment = 'questions';
    @endphp
@elseif($model instanceof Answer)
    @php
        $name = 'answer';
        $firstURISegment = 'answers';
    @endphp
@endif

@php
    $formId = $name . "-" . $model->id;
    $formAction = $firstURISegment . "/" . $model->id;
@endphp
<div class="d-flex flex-column vote-controls">
    <a title="This {{$name}} is Useful" class="vote-up {{ Auth::guest() ? 'off' : '' }}"
       onclick="event.preventDefault(); document.getElementById('up-vote-{{ $formId }}').submit()">
        <i class="fas fa-caret-up fa-3x"></i>
    </a>
    <form action="/{{ $formAction }}/vote" id="up-vote-{{$formId}}" method="POST" style="display: none">
        @csrf
        <input type="hidden" name="vote" value="1">
    </form>
    <span class="votes-count">{{ $model->votes_count }}</span>
    <a title="This {{$name}} is not Useful" class="vote-down {{ Auth::guest() ? 'off' : '' }}"
       onclick="event.preventDefault(); document.getElementById('down-vote-{{ $formId }}').submit()">
        <i class="fas fa-caret-down fa-3x"></i>
    </a>
    <form action="/{{ $formAction }}/vote" id="down-vote-{{$formId}}" method="POST" style="display: none">
        @csrf
        <input type="hidden" name="vote" value="-1">
    </form>

    @if($model instanceof Question)
        <favorite :question="{{ $model }}"></favorite>
    @elseif( $model instanceof Answer)
        <accept :answer="{{ $model }}">
    @endif
</div>
