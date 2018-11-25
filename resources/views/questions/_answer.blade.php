<div class="row mt-2">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h2> {{ $answerCount . "  " . str_plural("Answer",$answerCount) }}</h2>
                    @foreach($answers as $answer)
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
                                   class="{{$answer->status}} mt-2"><i class="fa fa-check fa-3x"></i>
                                    <span class="accept-count">140</span>
                                </a>
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
