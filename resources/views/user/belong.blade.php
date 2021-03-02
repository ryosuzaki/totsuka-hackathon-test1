@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
    <h3>所属している避難所</h3>
    <table class="table">
    <thead class="thead-light">
    <tr><th>役割</th><th>id</th><th>名前</th><th>混雑状況</th></tr>
    </thead>
    <tbody>
    @foreach($staff_shelters as $shelter)
    <tr><td>職員</td><td>{{$shelter->id}}</td><td><a href="{{route('shelter.info',['id'=>$shelter-> id])}}">{{$shelter->name}}</a></td><td>{{$shelter->degree_of_congestion}}</td></tr>
    @endforeach

    @foreach($user_shelters as $shelter)
    <tr><td>避難者</td><td>{{$shelter->id}}</td><td><a href="{{route('shelter.info',['id'=>$shelter-> id])}}">{{$shelter->name}}</a></td><td>{{$shelter->degree_of_congestion}}</td></tr>
    @endforeach
    </tbody>
    </table>
    <h3>所属しているサポートチーム</h3>
    <table class="table">
    <thead class="thead-light">
    <tr><th>役割</th><th>id</th><th>名前</th><th></th></tr>
    </thead>
    <tbody>
    @foreach($staff_supports as $support)
    <tr><td>職員</td><td>{{$support->id}}</td><td><a href="{{route('support_team.info',['id'=>$support-> id])}}">{{$support->name}}</a></td><td><a href="{{route('support_team.users.get',['id'=>$support-> id])}}">利用者一覧</a></td></tr>
    @endforeach
    
    @foreach($user_supports as $support)
    <tr><td>利用者</td><td>{{$support->id}}</td><td><a href="{{route('support_team.info',['id'=>$support-> id])}}">{{$support->name}}</a></td><td></td></tr>
    @endforeach
    </tbody>
    </table>
    
    
    </div>
</div>
@endsection