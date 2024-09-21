@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Quiz Result</h1>
    @if($submission->is_graded)
        <p>Your score: {{ $submission->score }}%</p>
    @else
        <p>Your submission is under review. Please wait for the teacher to grade it.</p>
    @endif
</div>
@endsection
