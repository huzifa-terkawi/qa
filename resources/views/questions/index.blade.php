@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h2>All Questions</h2>
                            @if(Auth::user())
                                <div class="ml-auto">
                                    <a href="{{route('questions.create')}}" class="btn btn-outline-secondary">Ask
                                        Question</a>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="card-body">
                        @include('layouts.msg')
                        @foreach($questions as $q)
                            <div class="media">
                                <div class="d-flex flex-column counters">
                                    <div class="vote">
                                        <strong>{{$q->votes}}</strong> {{ str_plural('vote',$q->votes) }}
                                    </div>
                                    <div class="status {{$q->status}}">
                                        <strong>{{$q->answers}}</strong> {{ str_plural('answer',$q->answers) }}
                                    </div>
                                    <div class="view">
                                        {{$q->views . " " . str_plural('view',$q->views) }}
                                    </div>
                                </div>
                                <div class="media-body">
                                    <div class="d-flex align-items-center">
                                        <h3 class="mt-0"><a href="{{ $q->url }}">{{$q->title}}</a></h3>
                                        <div class="ml-auto">
                                            @if( Auth::user())
                                                @can('update',$q)
                                                    <a href="{{route('questions.edit',$q->id)}}"
                                                       class="btn btn-success btn-sm">update</a>
                                                @endcan
                                                @can('delete',$q)
                                                    <form class="form-delete"
                                                          action="{{route('questions.destroy',$q->id)}}"
                                                          method="post">
                                                        {{method_field("DELETE")}}
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger btn-sm">delete
                                                        </button>
                                                    </form>
                                                @endcan
                                            @endif
                                        </div>
                                    </div>
                                    <p class="lead">
                                        Asked By <a href="{{$q->user->url}}">{{$q->user->name}}</a>
                                        <small class="text-muted">{{$q->created_date}}</small>
                                    </p>
                                    {{ str_limit($q->body,250) }}
                                </div>
                            </div>
                            <hr>
                        @endforeach
                        <div class="text-center">
                            {{$questions->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
