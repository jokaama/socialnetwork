<?php
include_once "PDO.php";

function GetOneUserFromId($id)
{
  global $PDO;
  $response = $PDO->query("SELECT * FROM user WHERE id = $id");
  return $response->fetch();
}

function GetAllUsers()
{
  global $PDO;
  $response = $PDO->query("SELECT * FROM user ORDER BY nickname ASC");
  return $response->fetchAll();
}

function GetUserIdFromUserAndPassword($login, $password)
{
  global $PDO;
  $preparedRequest = $PDO->prepare("select * from user where nickname=:nickname and password=:password");
  $preparedRequest->execute(
    array(
      "nickname" => $login,
      "password" => $password
    )
  );
  $users = $preparedRequest->fetchAll();
  if (count($users) == 1) {
    $user = $users[0];
    return $user['id'];
  } else {
    return -1; //On retourne -1 car on est sur qu'il n'y aura pas d'id négatif.
  }
}
