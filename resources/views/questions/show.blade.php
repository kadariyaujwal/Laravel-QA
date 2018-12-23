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
                    <a title="this question is useful " class="vote-up {{Auth::guest()?'off':''}}" onclick="event.preventDefault(); document.getElementById('vote-up-question-{{$question->id}}').submit()">
                            <i class="fas fa-caret-up fa-3x"></i>
                        </a>
                        <form action='/questions/{{$question->id}}/vote' id="vote-up-question-{{$question->id}}"
                            method="post" style="display:none;">
                            @csrf
                            <input type="hidden" name="vote" value="1">
                        </form>
                        <span class="vote-count">{{$question->votes_count}}</span>
                        <a title="this is non-useful question" class="vote-down {{Auth::guest()?'off':''}}"  onclick="event.preventDefault(); document.getElementById('vote-down-question-{{$question->id}}').submit()">
                            <i class="fas fa-caret-down fa-3x"></i>
                        </a>
                        <form action='/questions/{{$question->id}}/vote' id="vote-down-question-{{$question->id}}"
                            method="post" style="display:none;">
                            @csrf
                            <input type="hidden" name="vote" value="-1">
                        </form>
                        <a title="click to mark as favourite" class="favourite mt-2 {{ Auth::guest()?'off':($question->is_favourited?'favourited':'') }}"
                            onclick="event.preventDefault(); document.getElementById('favourite-question-{{$question->id}}').submit()">
                            <i class="fas fa-star fa-2x"></i>
                            <span class="favourites-count">{{$question->getFavouritesCount()}}</span>
                        </a>
                        <form action='/questions/{{$question->id}}/favourites' id="favourite-question-{{$question->id}}"
                            method="post" style="display:none;">
                            @csrf
                            @if($question->is_favourited)
                            @method('DELETE');
                            @endif
                        </form>
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
    @include('answers._index',[
    'answersCount'=> $question->answer_count,
    'answers' => $question->answers,
    ])
    @include('answers._create')
</div>
@endsection
