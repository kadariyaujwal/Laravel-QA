<a title="click to mark as favourite" class="favourite mt-2 {{ Auth::guest()?'off':($model->is_favourited?'favourited':'') }}"
    onclick="event.preventDefault(); document.getElementById('favourite-question-{{$model->id}}').submit()">
    <i class="fas fa-star fa-2x"></i>
    <span class="favourites-count">{{$model->getFavouritesCount()}}</span>
</a>
<form action='/questions/{{$model->id}}/favourites' id="favourite-question-{{$model->id}}"
    method="post" style="display:none;">
    @csrf
    @if($model->is_favourited)
    @method('DELETE');
    @endif
</form>