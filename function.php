<?php

// Get The Welcome From json file
function get_welcome(){
  $jsonString = file_get_contents('bot.json');
  $data = json_decode($jsonString);
  foreach ($data->bot as $is) {

  if($is->bot == "true"){
      $x = str_replace('/n' ,PHP_EOL, $is->welcome);

    return $x;

  }
  }
}

function new_user(){

  $jsonString = file_get_contents('bot.json');
  $data = json_decode($jsonString);
  foreach ($data->bot as $is) {

  if($is->bot == "true"){
    $data = file_get_contents("bot.json");
    $newdata = str_replace($is->users, $is->welcome + 1 , $data);
    file_put_contents("bot.json", $newdata);

    return true;

  }
  }
}



function get_users(){
  $jsonString = file_get_contents('bot.json');
  $data = json_decode($jsonString);
  foreach ($data->bot as $is) {

  if($is->bot == "true"){

    return $is->users;

  }
  }
}

function rules_group($id){
  $jsonString = file_get_contents('bot.json');
  $data = json_decode($jsonString);
  foreach ($data->bot as $is) {

  if($is->group == $id){
      $x = str_replace('/n' ,PHP_EOL, $is->rules);
    return $x;

  }
  }
}

function change_rules($groupID , $newvalue){

  $jsonString = file_get_contents('bot.json');
  $data = json_decode($jsonString);
  foreach ($data->bot as $is) {

  if($is->group == $groupID){
    $data = file_get_contents("bot.json");
    $newdata = str_replace($is->rules, $newvalue, $data);
    file_put_contents("bot.json", $newdata);

    return true;

  }
  }
}

function check_link_allow($id){
  $jsonString = file_get_contents('bot.json');
  $data = json_decode($jsonString);
  foreach ($data->bot as $is) {

  if($is->group == $id ){

    return $is->link;

  }
  }
}

function check_group($id){
  $jsonString = file_get_contents('bot.json');
  $data = json_decode($jsonString);
  foreach ($data->bot as $is) {

  if($is->group == $id){

    return $is->group;

  }
  }}

function sudo_id($id){
  $jsonString = file_get_contents('bot.json');
  $data = json_decode($jsonString);
  foreach ($data->bot as $is) {

  if($is->group == $id){

    return $is->sudo;

  }
  }
}

function welcome_group($id){
  $jsonString = file_get_contents('bot.json');
  $data = json_decode($jsonString);
  foreach ($data->bot as $is) {

  if($is->group == $id){
      $x = str_replace('/n' ,PHP_EOL, $is->welcome);
    return $x;

  }
  }
}


function bot_welcome($newvalue){

  $jsonString = file_get_contents('bot.json');
  $data = json_decode($jsonString);
  foreach ($data->bot as $is) {

  if($is->bot == "true"){
    $data = file_get_contents("bot.json");
    $newdata = str_replace($is->welcome, $newvalue, $data);
    file_put_contents("bot.json", $newdata);

    return true;

  }
  }
}


function change_welcome($groupID , $newvalue){

  $jsonString = file_get_contents('bot.json');
  $data = json_decode($jsonString);
  foreach ($data->bot as $is) {

  if($is->group == $groupID){
    $data = file_get_contents("bot.json");
    $newdata = str_replace($is->welcome, $newvalue, $data);
    file_put_contents("bot.json", $newdata);

    return true;

  }
  }
}

############### Change Welcome Function End ##############################

function change_leave($groupID , $newvalue){

  $jsonString = file_get_contents('bot.json');
  $data = json_decode($jsonString);
  foreach ($data->bot as $is) {

  if($is->group == $groupID){
    $data = file_get_contents("bot.json");
    $newdata = str_replace($is->leave, $newvalue, $data);
    file_put_contents("bot.json", $newdata);


  }
  }
}

############### Change Welcome Function End ##############################

function change_link($groupID , $newvalue){

  $jsonString = file_get_contents('bot.json');
  $data = json_decode($jsonString);
  foreach ($data->bot as $is) {

  if($is->group == $groupID){
    $data = file_get_contents("bot.json");
    $newdata = str_replace($is->link, $newvalue, $data);
    file_put_contents("bot.json", $newdata);


  }
  }
}

############### Change Welcome Function End ##############################




function add_group($id , $admin_id){
  $fileName = 'bot.json';
  $lineNumber = 17;
  $changeTo = ',{
    "group" : "'.$id.'" ,
    "welcome" : "أهلاً بك في هذه المجموعه",
    "leave"   : "الى اللقاء",
    "sudo"   : "'.$admin_id.'",
    "rules"  : "لا يوجد قوانين",
    "media"  : "مسموح",
    "link"    : "مسموح"
  }

  ';

  $contents = file($fileName);

  $new_contents = array();
  foreach ($contents as $key => $value) {
    $new_contents[] = $value;
    if ($key == $lineNumber) {
      $new_contents[] = $changeTo;
    }
  }

  file_put_contents($fileName, implode('',$new_contents));

}



 ?>
