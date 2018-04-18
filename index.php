<?php
// あ
// ////////////////////////
// 外部ファイル読み込み
// ////////////////////////
include ('pager_class.php');
// ページャーのクラスを作る
// 1ページに表示するデータ数
$hen_Pager = new clfu_Pager ( 3 );
$hen_a = $hen_Pager->fu_doIt ( 333 );
echo <<<eof999
<link rel='stylesheet' type='text/css' href='pager.css'>
<!--<script src="fod_css_hoka/ph_0000.js"></script>-->
<script type="text/javascript">
<!--
// JavaScript Documente
//console.log("Hello world");
	// ペジャーの処理
	function java_page_cyenzi( hen_p ) {
		form07=document.getElementById('form_zikou');
		//alert(form07.action+"?get_page="+hen_p);
		form07.action=form07.action+"?get_page="+hen_p
		//form07.post_page.value=hen_p;
		form07.submit();
	}
// -->
</script>
<noscript>
JavaScript対応ブラウザで表示してください。
</noscript>
<style>
/* ココがコメント */
</style>
<form id="form_zikou" action="./" method="POST">
</FORM>
{$hen_a}
eof999;
//$_SESSION['sess_page']=(int)( 33 / $hen_Pager_num +0.9 );
//print_r($_POST);
//print_r($_GET);
