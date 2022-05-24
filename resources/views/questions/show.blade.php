@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <div class="d-flex justify-content-between align-items-center">
                                <h1>{{ $question->title }}</h1>
                                <div class="ml-auto">
                                    <a href="{{ route('questions.index') }}" class="btn btn-outline-secondary back-btn">Back to All Questions</a>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="media d-flex">
                            <div class="d-flex flex-column vote-controls">
                                <a title="This Question is Useful" class="vote-up {{ Auth::guest() ? 'off' : '' }}"
                                   onclick="event.preventDefault(); document.getElementById('up-vote-question-{{ $question->id }}').submit()">
                                    <i class="fas fa-caret-up fa-3x"></i>
                                </a>
                                <form action="{{ route('questions.vote', $question->id) }}" id="up-vote-question-{{$question->id}}" method="POST" style="display: none">
                                    @csrf
                                    <input type="hidden" name="vote" value="1">
                                </form>
                                <span class="votes-count">{{ $question->votes_count }}</span>
                                <a title="This Question is not Useful" class="vote-down {{ Auth::guest() ? 'off' : '' }}"
                                   onclick="event.preventDefault(); document.getElementById('down-vote-question-{{ $question->id }}').submit()">
                                    <i class="fas fa-caret-down fa-3x"></i>
                                </a>
                                <form action="{{ route('questions.vote', $question->id) }}" id="down-vote-question-{{$question->id}}" method="POST" style="display: none">
                                    @csrf
                                    <input type="hidden" name="vote" value="-1">
                                </form>
                                <a title="Click to Mark as Favorite (Click Again to Undo)"
                                   onclick="event.preventDefault(); document.getElementById('favorite-question-{{ $question->id }}').submit()"
                                   class="favorite d-flex flex-column mt-2 {{ Auth::guest() ? 'off' : ($question->is_favorited ? 'favorited' : '') }}">
                                    <i class="fas fa-star fa-2x mb-2"></i>
                                    <span class="favorites-count">{{ $question->favorites_count }}</span>
                                </a>
                                <form action="{{ route('questions.favorite', $question->id) }}" id="favorite-question-{{$question->id}}" method="POST" style="display: none">
                                    @csrf
                                    @if($question->is_favorited)
                                        @method('DELETE')
                                    @endif
                                </form>
                            </div>
                            <div class="media-body">
                                {!! $question->body_html !!}
                                <div class="row">
                                    <div class="col-4"></div>
                                    <div class="col-4"></div>
                                    <div class="col-4">
                                        <div class="d-flex">
                                            <div class="d-flex flex-column">
                                                <span class="text-muted">Asked {{$question->created_date}} </span>
                                                <div class="media mt-2 d-flex flex-row justify-content-evenly align-items-center">
                                                    <a href="{{ $question->user->url }}" class="p-2">
                                                        <img src="{{ $question->user->avatar }}" alt="">
                                                    </a>
                                                    <div class="media-body">
                                                        <a href="{{ $question->user->url }}">{{ $question->user->name }}</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('answers._index', [
            'answers' => $question->answers,
            'answersCount' => $question->answers_count
        ])
        @include('answers._create')
    </div>

@endsection
