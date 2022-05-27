<?php
  $id = $_POST['id'];
  $list = array("id" => $id, "school" => "テックアカデミー", "skill" => "PHPプログラミングスキル" );
  header("Content-type: application/json; charset=UTF-8");
  echo json_encode($list);
  exit;