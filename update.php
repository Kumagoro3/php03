<?php
//0. SESSION開始！！
session_start();

//1. POSTデータ取得
$name   = $_POST["name"];
$url  = $_POST["url"];
$naiyou = $_POST["naiyou"];
// $age    = $_POST["age"];   //今回追加してます
$id    = $_POST["id"];   //idを取得

//2. DB接続します
include("funcs.php");  //funcs.phpを読み込む（関数群）
sschk();
$pdo = db_conn();      //DB接続関数

//３．データ登録SQL作成
$sql = "update gs_bm_table set name=:name, url=:url, naiyou=:naiyou where id=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':name',  $name,   PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':url', $url,  PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':naiyou',$naiyou, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':id',$id,  PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //実行


//４．データ登録処理後
if($status==false){
    sql_error($stmt);
}else{
    redirect("select.php");
}

?>
