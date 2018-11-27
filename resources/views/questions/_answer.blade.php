<div class="row mt-2">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h2> {{ $answerCount . "  " . str_plural("Answer",$answerCount) }}</h2>
                    @foreach($answers as $answer)
                        <div class="media">
                            <div class="d-flex flex-column vote-control">
                                <a href="" title="Is Answer Usefull" class="vote-up {{ Auth::guest() ?'off':'' }}"
                                   onclick="event.preventDefault();document.getElementById('vote-answer-up-{{$answer->id}}').submit();">
                                    <i class="fa fa-caret-up fa-4x"></i>
                                    <form action="/answers/{{$answer->id}}/vote" method="POST"
                                          id="vote-answer-up-{{$answer->id}}"   style="display: none">
                                        @csrf
                                        <input type="hidden" name="vote" value="1">
                                    </form>
                                </a>

                                <span class="votes-count">{{$answer->votes_count}}</span>

                                <a href="" title="This Answer is Not Usefull" class="vote-down {{ Auth::guest() ?'off':'' }}"
                                   onclick="event.preventDefault();document.getElementById('vote-answer-down-{{$answer->id}}').submit();">
                                    <i class="fa fa-caret-down fa-4x"></i>
                                    <form action="/answers/{{$answer->id}}/vote" method="POST"
                                          id="vote-answer-down-{{$answer->id}}"   style="display: none">
                                        @csrf
                                        <input type="hidden" name="vote" value="-1">
                                    </form>
                                </a>
                                @can('accept',$answer)
                                    <a href="" title="mark this answer as best answer"
                                       class="{{$answer->status}} mt-2"
                                       onclick="event.preventDefault();document.getElementById('accept-answer-{{$answer->id}}').submit();"
                                    ><i class="fa fa-check fa-3x"></i>

                                    </a>
                                    <form action="{{route('answers.accept',$answer->id)}}"
                                          id="accept-answer-{{$answer->id}}" method="post" style="display: none">
                                        @csrf

                                    </form>
                                @else
                                    @if($answer->is_best)
                                        <a href="" title="accepted answer" class="{{$answer->status}} mt-2">
                                            <i class="fa fa-check fa-3x"></i>
                                        </a>
                                        @endif

                                @endcan
                            </div>
                            <div class="media-body">
                                {!! $answer->body_html !!}

                                <div class="row">
                                    <div class="col-4">
                                        <div class="ml-auto">
                                            @if( Auth::user())
                                                @can('update',$answer)
                                                    <a href="{{route('questions.answers.edit',[$question->id,$answer->id])}}"
                                                       class="btn btn-success btn-sm">Update</a>
                                                @endcan
                                                @can('delete',$answer)
                                                    <form class="form-delete"
                                                          action="{{route('questions.answers.destroy',[$question->id,$answer->id])}}"
                                                          method="post">
                                                        {{method_field("DELETE")}}
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger btn-sm">Delete
                                                        </button>
                                                    </form>
                                                @endcan
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-4"></div>
                                    <div class="col-4">

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
                        </div>
                        <hr>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
