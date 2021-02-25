@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
    <form action="{{route('shelter.register.post')}}" method="POST">
        {{ csrf_field() }}
        <div>
            <label>避難所名</label><br>
            <input type="text" name="name">
        </div>
        <div>
            <label>詳細情報</label><br>
            <textarea name="info"></textarea>
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
            <input type="submit" value="登録"/>
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