<?php

include("Telegram.php");
include("function.php");


$bot_id = "367353494:AAFwdGa8qNyWrXe3AP7qK5dkqfPxgBMQeI8";

$bot = new Telegram($bot_id);

$res = $bot->getData();

$id =    $res['message']['chat']['id'];
$text =  $res['message']['text'];
$msgid = $res['message']['message_id'];
$repid = $res["message"]["reply_to_message"]["from"]["id"];
$m     = $res["message"]["from"]["id"];
$new_member = $res['message']['new_chat_member'];
$left_member = $res['message']['left_chat_member'];





if($text == "/any"){

$content = array('chat_id' => $id, 'text' => get_users());
$bot->sendMessage($content);



}


if($text == "/start"){


$option = array( array( $bot->buildInlineKeyboardButton("قناة ألبوت 😄", $url="http://telegram.me/DevMah")));
$keyb = $bot->buildInlineKeyBoard($option);
$content = array('chat_id' => $id, 'reply_markup' => $keyb, 'text' => get_welcome());
$bot->sendMessage($content);
new_user();

}



if($text == "مساعده"){
    
    $helpT = " اهلاً بك ❤️
ألأوامر الخاصه بلبوت هي 

▪️/add لتفعيل المجموعه 

▪️أطرد (بالرد فقط حالياً ) لطرد الاعضاء 

▪️/ترحيب + نص الترحيب ( لتغيير رسالة الترحيب الخاصه بالمجموعه )

▪️ / القوانين + القوانين لتغيير قوانين المجموعه 

▪️/alnk للسماح بنشر الروابط 

▪️/dlnk لمنع نشر الروابط 

لعرض القوانين ارسل القوانين فقط 😁
    ";
    
        $content = array('chat_id' => $id ,'reply_to_message_id' => $msgid , 'text' => $helpT);
        $bot->sendMessage($content);

    
}






if(strpos($text , '/welcome') !== false && $m == 302197964){

$text2 = str_replace('/welcome ','',$text);
$text3 = str_replace(PHP_EOL,'/n',$text2);

if(bot_welcome($text3) == true){
        $content = array('chat_id' => $id ,'reply_to_message_id' => $msgid , 'text' =>'تم ذلك');
        $bot->sendMessage($content);

}

}


if($bot->messageFromGroup()){
  if($text == "/add"){
if(check_group($id) == true){
  $content = array('chat_id' => $id ,'reply_to_message_id' => $msgid , 'text' => 'تم تفعيل المدير مسبقاً');
  $bot->sendMessage($content);
  die();

}
  add_group($id , $m);

  $content = array('chat_id' => $id ,'reply_to_message_id' => $msgid , 'text' => 'تم تفعيل المدير لهذه المجموعه');
  $bot->sendMessage($content);


  }
  if(strpos($text , 'telegram.me') !== false && check_link_allow($id) == "مسموح" ){
      $url = 'http://api.telegram.org/beta/bot367353494:AAFwdGa8qNyWrXe3AP7qK5dkqfPxgBMQeI8/deleteMessage?chat_id='.$id.'&message_id='.$msgid;
      file_get_contents($url);

     
  }
  if($text == "اطرد" && $m == sudo_id($id)){
      $content = array('chat_id' => $id , 'user_id' => $repid  );
      $kick = $bot->kickChatMember($content);

      if($kick == true){
          $content = array('chat_id' => $id ,'reply_to_message_id' => $msgid , 'text' =>'تم طرد هذا الشخص');
          $bot->sendMessage($content);

      }else{
          $content = array('chat_id' => $id ,'reply_to_message_id' => $msgid , 'text' =>'لا استطيع طرد هذا الشخص');
          $bot->sendMessage($content);

      }
  }



  if(strrpos($text , '/ترحيب') !== false && $m == sudo_id($id) ){

  $text2 = str_replace('/ترحيب ','',$text);
  $text3 =str_replace(PHP_EOL,"/n", $text2);

  if(change_welcome($id , $text3) == true){
        $content = array('chat_id' => $id ,'reply_to_message_id' => $msgid , 'text' =>'تم ذلك');
        $bot->sendMessage($content);

  }else{
            $content = array('chat_id' => $id ,'reply_to_message_id' => $msgid , 'text' =>' هنالك مشكله !!!!');
        $bot->sendMessage($content);

  }

  }


  if(strrpos($text , '/قوانين') !== false && $m == sudo_id($id) ){

  $text2 = str_replace('/قوانين ','',$text);
  $text3 =str_replace(PHP_EOL,"/n", $text2);

  if(change_rules($id , $text3) == true){
        $content = array('chat_id' => $id ,'reply_to_message_id' => $msgid , 'text' =>'تم ذلك');
        $bot->sendMessage($content);

  }else{
            $content = array('chat_id' => $id ,'reply_to_message_id' => $msgid , 'text' =>' هنالك مشكله !!!!');
        $bot->sendMessage($content);

  }

  }

  if($text == "قوانين"){

    $content = array('chat_id' => $id ,'reply_to_message_id' => $msgid , 'text' => rules_group($id));
    $bot->sendMessage($content);


  }


if($text == "/dlnk" && check_link_allow($id) == "مسموح"&& $m == sudo_id($id) ){

    change_link($id , 'ايقاف');
    $block = array('chat_id' => $id , 'reply_to_message' => $msgid   , 'text' => "تم حظر الروابط");
    $bot->sendMessage($block);
  

}

if($text ==  "/alnk" && check_link_allow($id) == "ايقاف"&& $m == sudo_id($id )){

    change_link($id , 'مسموح');
    $allow = array('chat_id' => $id , 'reply_to_message' => $msgid   , 'text' =>  "يمكن الان لأي عضو ان ينشر روابط");
    $bot->sendMessage($allow);
 

}





} // Group End

if($new_member){
          $content = array('chat_id' => $id  , 'text' =>welcome_group($id));
          $bot->sendMessage($content);

}elseif($left_member){
  $content = array('chat_id' => $id  , 'text' => "وداعاً");
  $bot->sendMessage($content);

}



?>
