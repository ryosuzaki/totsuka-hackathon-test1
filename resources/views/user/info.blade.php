@extends('layouts.app')

@section('content')
<div class="container">
    
<h1>利用者情報</h1>
<table>
	<caption>基本情報</caption>
	<tr><th>氏名</th><td>山田太郎</td></tr>
	<tr><th>性別</th><td>男</td></tr>
	<tr><th>生年月日</th><td>1950年7月9日</td></tr>
	<tr><th>住所</th><td>〒xxx-xxxx　○○県○○市○○区○○町xx-xx</td></tr>
	<tr><th>電話番号</th><td>(xxx)xxx-xxxx</td></tr>
	<tr><th>位置情報サービス</th><td>ON</td></tr>
</table>
<br><br>
<table>
	<caption>家族情報</caption>
	<tr><th>氏名</th><td>山田一郎</td></tr>
	<tr><th>性別</th><td>男</td></tr>
	<tr><th>年齢</th><td>23歳</td></tr>
	<tr><th>家族関係</th><td>息子</td></tr>
	<tr><th>住所</th><td>〒xxx-xxxx　○○県○○市○○区○○町xx-xx</td></tr>
	<tr><th>電話番号</th><td>xxx-xxxx-xxxx</td></tr>
	<tr><th>メールアドレス</th><td>xxxxx@xxxxx.xxx</td></tr>
</table>
<br><br>
<table>
	<caption>住まい</caption>
	<tr><th>同居人の有無</th><td>有</td></tr>
	<tr><th>最寄りの避難所・避難場所</th><td>○○</td></tr>
</table>
<br><br>
<table>
	<caption>医療</caption>
	<tr><th>平熱</th><td>36.2</td></tr>
	<tr><th>身長</th><td>170.0cm</td></tr>
	<tr><th>体重</th><td>65kg</td></tr>
</table>
<br><br>
<table>
	<caption>薬の使用状況</caption>
	<tr><th>アレルギー歴</th><td>○○、○○</td></tr>
	<tr><th>既往歴</th><td>○○、○○</td></tr>
	<tr><th>手術歴</th><td>○○</td></tr>
	<tr><th>かかりつけの病院</th><td>○○</td></tr>
</table>
<br><br>
<table>
	<caption>福祉</caption>
	<tr><th>障害の有無</th><td>聴覚、視覚、右足</td></tr>
	<tr><th>要支援・要介護認定</th><td>有</td></tr>
	<tr><th>介護者の有無と続柄</th><td>有（サービス提供者）</td></tr>
	<tr><th>介護サービス利用の有無</th><td>有</td></tr>
	<tr><th>サービス内容</th><td>居宅サービス</td></tr>
	<tr><th>利用サービス施設名称</th><td>横浜市福祉サービス協会戸塚介護事務所</td></tr>
	<tr><th>福祉用具</th><td>杖</td></tr>
	<tr><th>在宅酸素療法</th><td>無</td></tr>
	<tr><th>介助者</th><td>有（息子）</td></tr>
</table>
<br><br>
<table>
	<caption>利用するアプリ内容</caption>
	<tr><th>平常時安否確認</th><td>利用しない</td></tr>
	<tr><th>災害時安否確認</th><td>通常版</td></tr>
	<tr><th>健康管理</th><td>利用する</td></tr>
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