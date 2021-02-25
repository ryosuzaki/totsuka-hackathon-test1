@extends('layouts.app')

@section('content')
<div class="container">
    
    <form action="{{route('support_team.edit.post',['id'=>$support_team-> id])}}" method="POST">
        {{ csrf_field() }}
        <div>
            <label>サポートチーム名</label><br>
            <input type="text" value="{{ $support_team-> name}}" name="name">
        </div>
        <div>
            <label>詳細情報</label><br>
            <textarea name="info">{{ $support_team-> info}}</textarea>
        </div>
        <div>
            <label>スタッフパスワード</label><br>
            <input type="text" name="staff_password">
        </div>
        <div>
            <label>利用者パスワード</label><br>
            <input type="text" name="user_password">
        </div>
        <div>
            <input type="submit" value="更新"/>
        </div>
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