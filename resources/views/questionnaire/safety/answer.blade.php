@extends('layouts.app')

@section('content')
<div class="container">
    
    <table>
    <tr><th>回答日時</th><td>{{ $answer-> created_at}}</td></tr>
    <tr><th>Q1</th><td>{{ $answer->  Q1}}</td></tr>
    </table>
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