@extends('layouts.app')

@section('content')
<div class="container">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a href="#health_tab" class="nav-link active" data-toggle="tab">健康管理アンケート</a>
        </li>
        <li class="nav-item">
            <a href="#safety_tab" class="nav-link" data-toggle="tab">安否確認アンケート</a>
        </li>
    </ul>
    <div class="tab-content">
        <div id="health_tab" class="tab-pane active">
            
        </div>
        <div id="safety_tab" class="tab-pane">
            <table class="table sortable-table">
                <thead>
                    <tr><th>回答日時</th><th>回答</th></tr>
                </thead>
                <tbody>
                    @foreach ($safety_answers as $answer)
                    <tr><td><a href="{{route('questionnaire.answer',['type'=>'safety','user_id'=>$answer->user_id,'answer_id'=>$answer->id])}}">{{$answer->created_at}}</a></td><td>{{$answer->Q1}}</td></tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script type="module">
    $(document).ready(function() {
        $('.sortable-table').tablesorter();
    });
    </script>

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