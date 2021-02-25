@extends('layouts.app')

@section('content')
<div class="container">
    <table>
    <tr><th>回答日時</th></tr>
    @foreach ($answers as $answer)
    <tr><td><a href="{{route('questionnaire.answer',['type'=>'safety','user_id'=>$answer->user_id,'answer_id'=>$answer->id])}}">{{$answer->created_at}}</a></td></tr>
    @endforeach
    </table>

    @if ($errors->any())
    <div>
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
    @endif
    </div>
</div>
@endsection