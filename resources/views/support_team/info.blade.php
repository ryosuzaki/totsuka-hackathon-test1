@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
    <table class="table">
    <tr><th>id</th><td>{{ $support_team-> id}}</td></tr>
    <tr><th>作成日時</th><td>{{ $support_team-> created_at }}</td></tr>
    <tr><th>更新日時</th><td>{{ $support_team-> updated_at }}</td></tr>
    <tr><th>サポートチーム名</th><td>{{ $support_team-> name}}</td></tr>
    <tr><th>詳細情報</th><td>{{ $support_team-> info}}</td></tr>
    </table>
    <a href="{{route('support_team.join',['id'=>$support_team-> id])}}">このサポートチームに登録する</a>
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