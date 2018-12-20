@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-title">
                    <div class="d-flex align-items-center">
                        <h1> {{$question->title}} </h1>
                        <div class="ml-auto">
                            <a href="  {{ route('questions.index') }} " class="btn btn-primary"> Back to all Questions
                            </a>
                        </div>
                    </div>
                </div>
                <div class="media mb-3">
                    <div class=" flex-cloumn vote-controls">
                        <a title="this question is useful " class="vote-up">
                            <i class="fas fa-caret-up fa-3x"></i>
                        </a>
                        <span class="vote-count">8</span>
                        <a title="this is non-useful question" class="vote-down off">
                            <i class="fas fa-caret-down fa-3x"></i>
                        </a>
                        <a title="click to mark as favourite" class="favourite mt-2 favourited">
                            <i class="fas fa-star fa-2x"></i>
                            <span class="favourites-count">123</span>
                        </a>
                    </div>
                    <div class="media-body">
                        {!! $question->body_html !!}
                        <div class="float-right">
                            <span class="text-muted"> Answered {{$question->created_date }} </span>
                            <div class="media mt-2">
                                <a href=" {{ $question->user->url }} " class="pr-2">
                                    <img src=" {{ $question->user->avatar }} " alt="User img">
                                </a>
                                <div class="media-body mt-4">
                                    <a href=" {{ $question->user->url }} "> {{ $question->user->name }} </a>
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
                        <h2> {{ $question->answers_count . " " . str_plural('Answer',$question->answers_count) }} </h2>
                    </div>
                    <hr>
                    @foreach($question->answers as $answer)
                    <div class="media">
                            <div class=" flex-cloumn vote-controls">
                                    <a title="this question is useful " class="vote-up">
                                        <i class="fas fa-caret-up fa-3x"></i>
                                    </a>
                                    <span class="vote-count">8</span>
                                    <a title="this is non-useful question" class="vote-down off">
                                        <i class="fas fa-caret-down fa-3x"></i>
                                    </a>
                                    <a title="mark this answer as best answer" class=" vote-accepted mt-2">
                                        <i class=" fas fa-check fa-2x"></i>
                                    </a>
                                </div>
                        <div class="media-body">
                            {!! $answer->body_html !!}
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
                        <hr>
                    </div>
                    <hr>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
