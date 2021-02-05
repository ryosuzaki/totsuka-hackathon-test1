@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
    <table>
    <tr>
        <th>避難所コード</th>
        <th>作成日時</th>
        <th>更新日時</th>
        <th>避難所名</th>
        <th>詳細情報</th>
    </tr>
    <tr>
        <td>{{ $shelter_info-> code}}</td>
        <td>{{ $shelter_info-> created_at }}</td>
        <td>{{ $shelter_info-> updated_at }}</td>
        <td>{{ $shelter_info-> name}}</td>
        <td>{{ $shelter_info-> info}}</td>
    </tr>
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
