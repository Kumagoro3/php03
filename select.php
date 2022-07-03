<?php
//0. SESSION開始！！
session_start();

include("funcs.php");

//1.  DB接続します
sschk();
$pdo = db_conn();

//２．データ取得SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table");
$status = $stmt->execute();

//３．データ表示
$view="";
if($status==false) {
    //execute（SQL実行時にエラーがある場合）
    sql_error($stmt);

}else{
  //Selectデータの数だけ自動でループしてくれる
  //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
  if ($_SESSION["kanri_flg"] !=1){
  while( $res = $stmt->fetch(PDO::FETCH_ASSOC)){
    $view .= '<a href="detail.php?id='.h($res["id"]).'">';
    $view .= h($res["id"]).", ".h($res["name"]).", ".h($res["url"]).", ".h($res["naiyou"]);
    $view .= "</a>";
    $view .= '<br>';
  }}else{
    while( $res = $stmt->fetch(PDO::FETCH_ASSOC)){
      $view .= '<a href="detail.php?id='.h($res["id"]).'">';
      $view .= h($res["id"]).", ".h($res["name"]).", ".h($res["url"]).", ".h($res["naiyou"]);
      $view .= "</a>";
      $view .= '<a href="delete.php?id='.h($res["id"]).'">';
      $view .= "[削除]<br>";
      $view .= '</a>';
}}}
?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>ブックマーク書籍表示</title>
<link rel="stylesheet" href="css/range.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<style>div{padding: 10px;font-size:16px;}</style>
</head>
<body id="main">
<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
      <a class="navbar-brand" href="index.php">あなたがブックマークした本</a>
      </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->

<div>
    <div class="container jumbotron"><p>ID,書籍名,URL,コメント</p><?=$view?></div>
</div>
<!-- Main[End] -->

</body>
</html>
