<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h2>{{ $answersCount . " " . Str::plural('Answer', $answersCount)}}</h2>
                </div>
                <hr>
                @include('layouts._messages')

                @foreach($answers as $answer)
                    <div class="media d-flex">
                        <div class="d-flex flex-column vote-controls">
                            <a title="This Answer is Useful" class="vote-up {{ Auth::guest() ? 'off' : '' }}"
                               onclick="event.preventDefault(); document.getElementById('up-vote-answer-{{ $answer->id }}').submit()">
                                <i class="fas fa-caret-up fa-3x"></i>
                            </a>
                            <form action="{{ route('answers.vote', $answer->id) }}" id="up-vote-answer-{{$answer->id}}" method="POST" style="display: none">
                                @csrf
                                <input type="hidden" name="vote" value="1">
                            </form>
                            <span class="votes-count">{{ $answer->votes_count }}</span>
                            <a title="This Answer is not Useful" class="vote-down {{ Auth::guest() ? 'off' : '' }}"
                               onclick="event.preventDefault(); document.getElementById('down-vote-answer-{{ $answer->id }}').submit()">
                                <i class="fas fa-caret-down fa-3x"></i>
                            </a>
                            <form action="{{ route('answers.vote', $answer->id) }}" id="down-vote-answer-{{$answer->id}}" method="POST" style="display: none">
                                @csrf
                                <input type="hidden" name="vote" value="-1">
                            </form>
                            @can('accept', $answer)
                                <a title="Mark this as Best Answer" class="favorite d-flex flex-column mt-2 {{ $answer->status }} " onclick="event.preventDefault(); document.getElementById('accept-answer-{{ $answer->id }}').submit()">
                                    <i class="fas fa-check fa-2x mb-2"></i>
                                </a>
                                <form action="{{ route('answers.accept', $answer->id) }}" id="accept-answer-{{$answer->id}}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            @else
                                @if ($answer->is_best)
                                    <a title="This answer has been accepted as best answer" class="favorite d-flex flex-column mt-2 {{ $answer->status }} ">
                                        <i class="fas fa-check fa-2x mb-2"></i>
                                    </a>
                                @endif
                            @endcan
                        </div>
                        <div class="media-body">
                            {!! $answer->body_html !!}
                            <div class="row">
                                <div class="col-4">
                                    <div class="ml-auto">
                                        @can('update', $answer)
                                            <a href="{{ route('questions.answers.edit', [$question->id, $answer->id]) }}" class="btn btn-sm btn-outline-info">Edit</a>
                                        @endcan
                                        @can('delete', $answer)
                                            <form class="form-delete" action="{{ route('questions.answers.destroy', [$question->id, $answer->id]) }}" method="post">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                        @endcan
                                    </div>
                                </div>
                                <div class="col-4"></div>
                                <div class="d-flex col-4">
                                    <div class="d-flex flex-column">
                                        <span class="text-muted">Answered {{$answer->created_date}} </span>
                                        <div class="media mt-2 d-flex flex-row justify-content-evenly align-items-center">
                                            <a href="{{ $answer->user->url }}" class="p-2">
                                                <img src="{{ $answer->user->avatar }}" alt="">
                                            </a>
                                            <div class="media-body">
                                                <a href="{{ $answer->user->url }}">{{ $answer->user->name }}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                @endforeach
            </div>
        </div>
    </div>
</div>