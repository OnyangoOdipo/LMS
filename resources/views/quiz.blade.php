@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $quiz->title }}</h1>
    <form action="{{ route('quiz.submit', $quiz->id) }}" method="POST">
        @csrf
        @foreach($quiz->questions as $question)
            <div class="mb-4">
                <label>{{ $question->question }}</label>
                @foreach($question->options as $option)
                    <div>
                        <input type="radio" name="answers[{{ $question->id }}]" value="{{ $option }}">
                        <label>{{ $option }}</label>
                    </div>
                @endforeach
            </div>
        @endforeach
        <button type="submit" class="bg-blue-500 text-white px-4 py-2">Submit Quiz</button>
    </form>
</div>
@endsection
