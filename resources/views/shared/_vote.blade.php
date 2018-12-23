@if ($model instanceof App\Question)
    @php
        $name = 'question';
        $firstURISegment = "questions";


    @endphp
@elseif($model instanceof App\Answer)
    @php
        $name = 'answer';
        $firstURISegment = "answers";
    @endphp
@endif

@php
    $formId = $name . '-' . $model->id;
    $formAction = "/{$firstURISegment}/{$model->id}/vote";
@endphp

<div class="flex-cloumn vote-controls">
    <a title="this {{$name}} is useful " class="vote-up {{Auth::guest()?'off':''}}" onclick="event.preventDefault(); document.getElementById('vote-up-{{$formId}}').submit()">
            <i class="fas fa-caret-up fa-3x"></i>
        </a>
        <form action='{{$formAction}}' id="vote-up-{{$formId}}"
            method="post" style="display:none;">
            @csrf
            <input type="hidden" name="vote" value="1">
        </form>
        <span class="vote-count">{{$model->votes_count}}</span>
        <a title="this is non-useful {{$name}}" class="vote-down {{Auth::guest()?'off':''}}"  onclick="event.preventDefault(); document.getElementById('vote-down-{{$formId}}').submit()">
            <i class="fas fa-caret-down fa-3x"></i>
        </a>
    <form action='{{$formAction}}' id="vote-down-{{$formId}}"
            method="post" style="display:none;">
            @csrf
            <input type="hidden" name="vote" value="-1">
        </form>
        @if($model instanceof App\Question)
            @include('shared._favourite',[
                'model'=>$model
            ])
        @elseif ($model instanceof App\Answer)
        @include('shared._accept',[
            'model'=>$model
        ])
        @endif
    </div>