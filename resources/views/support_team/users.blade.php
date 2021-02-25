@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('flash_message'))
        <div class="flash_message">
            {{ session('flash_message') }}
        </div>
    @endif
    <form action="{{route('support_team.users.post',['id'=>$support_team->id])}}" method="post">
        {{ csrf_field() }}
        <table>
        <tr><th>名前</th><th>安否確認日時</th><th>回答</th><th>健康確認日時</th><th>回答</th><th>救助状況</th><th>担当状況</th></tr>
        @for($i = 0; $i < count($support_users); $i++)
        @php
        $user=$support_users[$i];
        $safeties=$latest_safeties[$i];
        $healths=$latest_healths[$i];
        @endphp
        <tr>
        <td><a href="{{route('user.info',['id'=>$user->id])}}">{{$user->name}}</a></td>
        <td><a href="{{route('questionnaire.answers',['type'=>'safety','id'=>$user-> id])}}">{{$safeties->created_at}}</a></td>
        <td>{{$safeties->Q1}}</td>
        <td><a href="{{route('questionnaire.answers',['type'=>'health','id'=>$user-> id])}}">{{$healths->created_at}}</a></td>
        <td>{{$healths->Q1}}</td>
        <td>
        @if($user->help_by==null)
        担当なし
        </td>
        <td>
        <input type="checkbox" name="help_users_id[]" value="{{$user->id}}">担当する
        </td>
        @elseif($user->help_by==$self->id)
        担当中
        </td>
        <td>
        <input type="checkbox" name="quit_users_id[]" value="{{$user->id}}">担当をやめる
        </td>
        @else
        担当あり</td>
        <td><a href="{{route('user.info',['id'=>$user->help_by])}}">担当者</a></td>
        @endif
        </td>
        </tr>
        @endfor
        </table>
        <input type="submit" value="送信"/>
    </form>
    
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