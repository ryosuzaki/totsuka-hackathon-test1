@extends('layouts.app')

@section('content')
<div class="container">
    <a href="{{route('questionnaire.answers',['id'=>$user->id])}}">これまでの回答へ</a>
    <table class="table">
    <tr><th>回答日時</th><td>{{$answer-> created_at}}</td></tr>
    <tr><th>質問</th><th>回答</th></tr>
    <tr><th>Q1 {{$questions[0]}}</th><td>{{$answer->Q1}}</td></tr>
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