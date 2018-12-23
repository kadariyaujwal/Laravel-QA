<div class="row mt-5">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h2> {{ $answersCount . " " . str_plural('Answer',$answersCount) }} </h2>
                </div>
                <hr>
                @include('layouts._messages')

                @foreach($answers as $answer)
                <div class="media">
                    <div class=" flex-cloumn vote-controls">
                        <a title="this answer is useful " class="vote-up {{Auth::guest()?'off':''}}" onclick="event.preventDefault(); document.getElementById('vote-up-answer-{{$answer->id}}').submit()">
                            <i class="fas fa-caret-up fa-3x"></i>
                        </a>
                        <form action='/answers/{{$answer->id}}/vote' id="vote-up-answer-{{$answer->id}}"
                            method="post" style="display:none;">
                            @csrf
                            <input type="hidden" name="vote" value="1">
                        </form>
                        <span class="vote-count">{{$answer->votes_count}}</span>
                        <a title="this is non-useful answer" class="vote-down {{Auth::guest()?'off':''}}"  onclick="event.preventDefault(); document.getElementById('vote-down-answer-{{$answer->id}}').submit()">
                            <i class="fas fa-caret-down fa-3x"></i>
                        </a>
                        <form action='/answers/{{$answer->id}}/vote' id="vote-down-answer-{{$answer->id}}"
                            method="post" style="display:none;">
                            @csrf
                            <input type="hidden" name="vote" value="-1">
                        </form>
                        @can('accept', $answer)
                            <a title="mark this answer as best answer" class=" {{ $answer->status }} mt-2" onclick="event.preventDefault(); document.getElementById('accept-answer-{{$answer->id}}').submit()">
                                <i class=" fas fa-check fa-2x"></i>
                            </a>
                            <form action=" {{ route('answers.accept',$answer->id) }} " id="accept-answer-{{$answer->id}}"
                                method="post" style="display:none;">
                                @csrf
                            </form>
                            @else
                                @if($answer->is_best)
                                <a title="Owner of this question accepted answer as best answer" class=" {{ $answer->status }} mt-2">
                                        <i class=" fas fa-check fa-2x"></i>
                                    </a>
                                @endif
                        @endcan
                    </div>
                    <div class="media-body">
                        {!! $answer->body_html !!}
                        <div class="row">
                            <div class="col-4">
                                <div class="ml-auto">
                                    @can('update',$answer)
                                    <a href=" {{ route('answers.edit', [$question->id,$answer->id]) }} " class="btn btn-outline-info ">
                                        Edit </a>
                                    @endcan
                                    @can('delete',$answer)
                                    <form class="form-delete" action="{{route('answers.destroy',[$question->id,$answer->id])}}"
                                        method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-outline-danger" onclick="return confirm('Are you sure?')"
                                            type="submit">Delete</button>
                                        @endcan
                                    </form>
                                </div>
                            </div>
                            <div class="col-4">

                            </div>
                            <div class="col-4">
                                <div class="float-right">
                                    <span class="text-muted"> Answered {{$answer->created_date }} </span>
                                    <div class="media mt-2">
                                        <a href=" {{ $answer->user->url }} " class="pr-2">
                                            <img src=" {{ $answer->user->avatar }} " alt="User img">
                                        </a>
                                        <div class="media-body mt-4">
                                            <a href=" {{ $answer->user->url }} "> {{ $answer->user->name }} </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <hr>
                </div>
                <hr>
                @endforeach
            </div>
        </div>
    </div>
</div>
