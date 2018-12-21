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
                        <a title="this question is useful " class="vote-up">
                            <i class="fas fa-caret-up fa-3x"></i>
                        </a>
                        <span class="vote-count">8</span>
                        <a title="this is non-useful question" class="vote-down off">
                            <i class="fas fa-caret-down fa-3x"></i>
                        </a>
                        <a title="mark this answer as best answer" class=" {{ $answer->status }} mt-2">
                            <i class=" fas fa-check fa-2x"></i>
                        </a>
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
