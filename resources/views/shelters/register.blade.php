@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
    <form action="/register-shelter" method="post">
    {{ csrf_field() }}
    <div>
        <label>避難所コード</label><br>
        <input type="text" name="code"/>
    </div>
    <div>
        <label>避難所名</label><br>
        <input type="text" name="name">
    </div>
    <div>
        <label>詳細情報</label><br>
        <textarea name="info"></textarea>
    </div>
    <div>
        <input type="submit" value="登録"/>
    </div>
</form>
    </div>
</div>
@endsection