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
                   
                      @include('shared._vote ',[
                          'model'=>$answer
                      ])
                    
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
                                @include('shared._author',[
                                    'model'=>$answer,
                                    'label'=>'answered',
                                ])
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
