@csrf
<div class="form-group">
    <label for="question-title">Question Title</label>
    <input type="text" name="title" id="question-title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $question->title) }}">
    @error('title')
    <div class="invalid-feedback">
        {{$message}}
    </div>
    @enderror
</div>
<div class="form-group mt-2">
    <label for="question-body">Explain Your Question</label>
    <textarea name="body" id="question-body" cols="30" rows="10" class="form-control @error('body') is-invalid @enderror">{{ old('body', $question->body) }}</textarea>
    @error('body')
    <div class="invalid-feedback">
        {{$message}}
    </div>
    @enderror
</div>
<div class="form-group mt-2">
    <button type="submit" class="btn btn-outline-primary btn-lg">{{$buttonText}}</button>
</div>
