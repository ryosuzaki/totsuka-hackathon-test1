@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('flash_message'))
        <div class="flash_message">
            {{ session('flash_message') }}
        </div>
    @endif
    <h3 class="text-center">{{$support_team->name}}</h3>
    <form action="{{route('support_team.users.post',['id'=>$support_team->id])}}" method="post">
        {{ csrf_field() }}
        <table class="table table-sm">
        <thead class="thead-light">
        <tr><th>名前</th><th>安否確認日時</th><th>回答</th><th>健康確認日時</th><th>回答</th><th>救助状況</th><th>担当状況</th></tr>
        </thead>
        <tbody>
        @for($i = 0; $i < count($support_users); $i++)
        @php
        $user=$support_users[$i];
        $safety=$latest_safeties[$i];
        $health=$latest_healths[$i];
        @endphp
        <tr>
        <td><a href="{{route('user.info',['id'=>$user->id])}}">{{$user->name}}</a></td>
        <td>
        @if(null!=$safety->get())
        <a href="{{route('questionnaire.answer',['type'=>'safety','user_id'=>$user->id,'answer_id'=>$safety->id])}}">{{$safety->created_at}}</a>
        @endif
        </td>
        <td>{{$safety->Q1}}</td>
        <td>
        @if(null!=$health->get())
        <a href="{{route('questionnaire.answer',['type'=>'health','user_id'=>$user->id,'answer_id'=>$health->id])}}">{{$health->created_at}}</a>
        @endif
        </td>
        <td>{{$health->Q1}}</td>
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
        </tbody>
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