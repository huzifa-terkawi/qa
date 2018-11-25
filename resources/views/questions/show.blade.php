@extends('layouts.app')

@section('content')
    <div class="container">
        @include('questions._question')
        @include('questions._answer',['answers'=>$question->answers,'answerCount'=> $question->answers_count])
        @auth()
            @include('questions._answerForm',['question'=>$question])
        @endauth
    </div>
@endsection
