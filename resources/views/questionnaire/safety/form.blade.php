@extends('layouts.app')

@section('content')
<div class="container">
    
    <form action="{{route('questionnaire.form.post',['type'=>'safety'])}}" method="POST">
        {{ csrf_field() }}
        <div>
            <label>Q1</label><br>
            <input type="radio" name="Q1" value="避難済み" checked="checked">避難済み
            <input type="radio" name="Q1" value="要救助">要救助
        </div>
        <div>
            <input type="submit" value="回答"/>
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