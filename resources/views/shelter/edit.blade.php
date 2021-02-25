@extends('layouts.app')

@section('content')
<div class="container">
    
    <form action="{{route('shelter.edit.post',['id'=>$shelter-> id])}}" method="POST">
        {{ csrf_field() }}
        <div>
            <label>避難所名</label><br>
            <input type="text" value="{{$shelter-> name}}" name="name">
        </div>
        <div>
            <label>混雑状況</label><br>
            <input type="text" value="{{$shelter-> degree_of_congestion}}" name="degree_of_congestion">
        </div>
        <div>
            <label>詳細情報</label><br>
            <textarea name="info">{{$shelter-> info}}</textarea>
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