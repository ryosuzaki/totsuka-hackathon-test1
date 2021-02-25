@extends('layouts.app')

@section('content')
<div class="container">
    
    <form action="{{route('shelter.search.post')}}" method="post">
        {{ csrf_field() }}
        <div>
            <label>サポートチームID</label><br>
            <input type="text" name="id">
        </div>
        <div>
            <input type="submit" value="避難所情報へ"/>
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
@endsection