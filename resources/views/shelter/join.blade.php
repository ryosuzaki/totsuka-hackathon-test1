@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
    @can('shelter-user',$shelter-> id)
    <p>既に避難者登録されています。</p>
    @else
    <form action="{{route('shelter.join_user',['id'=>$shelter-> id])}}" method="post">
    {{ csrf_field() }}
    利用者パスワード：<input type="text" name="user_password">
    <input type="submit" value="利用者登録">
    </form>
    @endcan
    @can('shelter-staff',$shelter-> id)
    <p>既にスタッフ登録されています。</p>
    @else
    <form action="{{route('shelter.join_staff',['id'=>$shelter-> id])}}" method="post">
    {{ csrf_field() }}
    スタッフパスワード：<input type="text" name="staff_password">
    <input type="submit" value="スタッフ登録">
    </form>
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