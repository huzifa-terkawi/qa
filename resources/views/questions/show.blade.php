@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row ">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <div class="d-flex align-items-center">
                                <h1>{{ $question->title }}</h1>
                                <div class="ml-auto">
                                    <a href="{{route('questions.index')}}" class="btn btn-outline-secondary">Go Back
                                    </a>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="media">
                            <div class="d-flex flex-column vote-control">
                                <a href="" title="Is Question Usefull" class="vote-up">
                                    <i class="fa fa-caret-up fa-4x"></i>
                                </a>
                                <span class="votes-count">120</span>
                                <a href="" title="This Question is Not Usefull" class="vote-down off">
                                    <i class="fa fa-caret-down fa-4x"></i>
                                </a>
                                <a href="" title="Click to mark as favoriate question (Click Again to undo)"
                                   class="favoriate favoriated mt-2"><i class="fa fa-star fa-3x"></i>
                                    <span class="favoriate-count">140</span>
                                </a>

                            </div>
                            <div class="media-body">
                                {!! $question->body_html !!}
                                <div class="float-right">
                                    <span class="text-muted">{{$question->created_date}}</span>
                                    <div class="media mt-1">
                                        <a href="{{$question->user->url}}" class="pr-2 ">
                                            <img src="{{$question->user->avatar}}" alt="">
                                        </a>
                                        <div class="media-body mt-1">
                                            <a href="{{$question->user->url}}">{{$question->user->name}}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h2> {{ $question->answers_count . "  " . str_plural("Answer",$question->answers_count) }}</h2>
                            @foreach($question->answers as $answer)
                                <div class="media">
                                    <div class="d-flex flex-column vote-control">
                                        <a href="" title="Is Answer Usefull" class="vote-up">
                                            <i class="fa fa-caret-up fa-4x"></i>
                                        </a>
                                        <span class="votes-count">120</span>
                                        <a href="" title="This Answer is Not Usefull" class="vote-down off">
                                            <i class="fa fa-caret-down fa-4x"></i>
                                        </a>
                                        <a href="" title="mark this answer as best answer"
                                           class="vote-accepted mt-2"><i class="fa fa-check fa-3x"></i>
                                            <span class="accept-count">140</span>
                                        </a>
                                    </div>
                                    <div class="media-body">
                                        {!! $answer->body_html !!}
                                        <div class="float-right">
                                            <span class="text-muted">{{$answer->created_date}}</span>
                                            <div class="media mt-1">
                                                <a href="{{$answer->user->url}}" class="pr-2 ">
                                                    <img src="{{$answer->user->avatar}}" alt="">
                                                </a>
                                                <div class="media-body mt-1">
                                                    <a href="{{$answer->user->url}}">{{$answer->user->name}}</a>
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
        </div>
    </div>
@endsection
