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
                @include('layouts.msg')
                <div class="media">
                    <div class="d-flex flex-column vote-control">

                        <a href="" title="Is Question Usefull" class="vote-up {{ Auth::guest() ?'off':'' }}"
                           onclick="event.preventDefault();document.getElementById('vote-question-up-{{$question->id}}').submit();">
                            <i class="fa fa-caret-up fa-4x"></i>
                            <form action="/questions/{{$question->id}}/vote" method="POST"
                                  id="vote-question-up-{{$question->id}}"   style="display: none">
                                @csrf
                                <input type="hidden" name="vote" value="1">
                            </form>
                        </a>

                        <span class="votes-count">{{$question->votes_count}}</span>

                        <a href="" title="This Question is Not Usefull" class="vote-down {{ Auth::guest() ?'off':'' }}"
                           onclick="event.preventDefault();document.getElementById('vote-question-down-{{$question->id}}').submit();">
                            <i class="fa fa-caret-down fa-4x"></i>
                            <form action="/questions/{{$question->id}}/vote" method="POST"
                                  id="vote-question-down-{{$question->id}}"   style="display: none">
                                @csrf
                                <input type="hidden" name="vote" value="-1">
                            </form>
                        </a>

                        <a href="" title="Click to mark as favoriate question (Click Again to undo)"
                           class="favoriate  mt-2 {{ Auth::guest() ? 'off' : ($question->is_favorited ? 'favoriated':'') }}"
                           onclick="event.preventDefault();document.getElementById('favorite-question-{{$question->id}}').submit();">
                            <i class="fa fa-star fa-3x"></i>
                            <span class="favoriate-count">{{$question->favorited_count}}</span>

                            <form action="/questions/{{ $question->id }}/favorite" method="POST"
                                  id="favorite-question-{{$question->id}}"   style="display: none">
                                @csrf
                                @if($question->is_favorited)
                                    @method('DELETE')
                                @endif
                            </form>

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
                        <div class="clearfix">
                            <div class="text-center m-auto mt-2 align-baseline">
                                <button class="btn btn-primary"
                                        onclick="document.querySelector('#yourAnswerAnchor').scrollIntoView({behavior: 'smooth'});">
                                    Answer
                                </button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
