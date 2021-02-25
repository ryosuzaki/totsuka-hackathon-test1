@extends('layouts.app')

@section('content')
<div class="container">
    
    <h3>{{$shelter->name}}</h3>
    <a href="{{route('shelter.info',['id'=>$shelter->id])}}">避難所情報</a>
    @can('shelter-staff',$shelter-> id)
    <a href="{{route('shelter.edit.get',['id'=>$shelter->id])}}">避難所情報編集</a>
    @endcan
    <a href="{{route('shelter.join',['id'=>$shelter->id])}}">避難所職員、利用者登録</a>
    <a href="{{route('shelter.register.get')}}">避難所作成</a>
    <a href="{{route('shelter.search.get')}}">避難所検索</a>

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