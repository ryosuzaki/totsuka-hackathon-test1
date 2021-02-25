@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
    <table>
    <tr><th>id</th><td>{{ $shelter-> id}}</td></tr>
    <tr><th>作成日時</th><td>{{ $shelter-> created_at }}</td></tr>
    <tr><th>更新日時</th><td>{{ $shelter-> updated_at }}</td></tr>
    <tr><th>混雑状況</th><td>{{ $shelter-> degree_of_congestion }}</td></tr>
    <tr><th>避難所名</th><td>{{ $shelter-> name}}</td></tr>
    <tr><th>詳細情報</th><td><textarea readonly>{{ $shelter-> info}}</textarea></td></tr>
    </table>
    
    <a href="{{route('shelter.join',['id'=>$shelter-> id])}}">この避難所に登録する</a>
    @can('shelter-staff',$shelter-> id)
    <a href="{{route('shelter.edit.get',['id'=>$shelter-> id])}}">避難所情報を編集する</a>
    @endcan
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
