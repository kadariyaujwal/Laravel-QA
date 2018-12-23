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
                   @include('shared._vote',[
                       'model'=>$question,

                   ])
                    <div class="media-body">
                        {!! $question->body_html !!}
                        <div class="row">
                            <div class="col-4"></div>
                            <div class="col-4"></div>
                            <div class="col-4">
                                @include('shared._author',[
                                    'model'=>$question,
                                    'label'=>'asked',
                                ])
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
