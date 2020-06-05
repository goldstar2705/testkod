<?php
ob_start();
define('API_KEY','1192617124:AAHVjATs1DUsGJvh_JH6TAz-yjNVRajsfc0');
//-----------------------------------------------------------------------------------------
//Admembergbot :
function mahdi($method,$datas=[]){
    $url = "https://api.telegram.org/bot".API_KEY."/".$method;
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
    $res = curl_exec($ch);
    if(curl_error($ch)){
        var_dump(curl_error($ch));
    }else{
        return json_decode($res);
    }
}
//-----------------------------------------------------------------------------------------
// @Aqili_botlar :
// msg
$Dev = array("669114984"); // Admin IDsi
$usernamebot = "Add_membersChannelBot";  //Botingiz useri
$channel = "Ref_tv";    //Kanalingiz useri
$channelcode = "Ref_tv";  // Tanga kodi tashaladigan kanal useri
$web = "https://lordmizban.ir/Mrbertbot";  //Bu joyga tegmang! Bot ishlamaydi
$token = API_KEY;
//-----------------------------------------------------------------------------------------------
$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$from_id = $message->from->id;
$chat_id = $message->chat->id;
$message_id = $message->message_id;
$first_name = $message->from->first_name;
$last_name = $message->from->last_name;
$username = $message->from->username;
$textmassage = $message->text;
$firstname = $update->callback_query->from->first_name;
$usernames = $update->callback_query->from->username;
$chatid = $update->callback_query->message->chat->id;
$fromid = $update->callback_query->from->id;
$membercall = $update->callback_query->id;
//------------------------------------------------------------------------
$data = $update->callback_query->data;
$messageid = $update->callback_query->message->message_id;
$tc = $update->message->chat->type;
$gpname = $update->callback_query->message->chat->title;
//------------------------------------------------------------------------
$forward_from = $update->message->forward_from;
$forward_from_id = $forward_from->id;
$forward_from_username = $forward_from->username;
$forward_from_first_name = $forward_from->first_name;
$reply = $update->message->reply_to_message->forward_from->id;
$reply_username = $update->message->reply_to_message->forward_from->username;
$reply_first = $update->message->reply_to_message->forward_from->first_name;
// ========================================================================
$forchannel = json_decode(file_get_contents("https://api.telegram.org/bot".$token."/getChatMember?chat_id=@".$channel."&user_id=".$from_id));
$tch = $forchannel->result->status;
$forchannelq = json_decode(file_get_contents("https://api.telegram.org/bot".$token."/getChatMember?chat_id=@".$channel."&user_id=".$fromid));
$tchq = $forchannelq->result->status;
//=================================================================================================
//@Aqili_botlar:
function SendMessage($chat_id, $text){
mahdi('sendMessage',[
'chat_id'=>$chat_id,
'text'=>$text,
'parse_mode'=>'MarkDown']);
}
 function Forward($berekoja,$azchejaei,$kodompayam)
{
mahdi('ForwardMessage',[
'chat_id'=>$berekoja,
'from_chat_id'=>$azchejaei,
'message_id'=>$kodompayam
]);
}
function  getUserProfilePhotos($token,$from_id) {
  $url = 'https://api.telegram.org/bot'.$token.'/getUserProfilePhotos?user_id='.$from_id;
  $result = file_get_contents($url);
  $result = json_decode ($result);
  $result = $result->result;
  return $result;
}
function getChatMembersCount($chat_id,$token) {
  $url = 'https://api.telegram.org/bot'.$token.'/getChatMembersCount?chat_id=@'.$chat_id;
  $result = file_get_contents($url);
  $result = json_decode ($result);
  $result = $result->result;
  return $result;
}
function getChatstats($chat_id,$token) {
  $url = 'https://api.telegram.org/bot'.$token.'/getChatAdministrators?chat_id=@'.$chat_id;
  $result = file_get_contents($url);
  $result = json_decode ($result);
  $result = $result->ok;
  return $result;
}
//--------------------------------------------------------------
@$user = json_decode(file_get_contents("data/user.json"),true);
@$juser = json_decode(file_get_contents("data/$from_id.json"),true);
@$cuser = json_decode(file_get_contents("data/$fromid.json"),true);
//===================================================================
if(!in_array($from_id, $user["userlist"]) == true) {
$user["userlist"][]="$from_id";
$user = json_encode($user,true);
file_put_contents("data/user.json",$user);
mkdir("start");
    }
//==================================================================
if(in_array($from_id, $user["blocklist"])) {
mahdi('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"Siz bloklangansiz! Botni boshqa ishlatolmaysiz! Admin bilan boglaning",
'reply_markup'=>json_encode(['KeyboardRemove'=>[
],'remove_keyboard'=>true
])
    		]);
}
if($textmassage=="/start" && $tc == "private"){	
if(in_array($from_id, $user["userlist"]) == true) {
mahdi('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"Assalomu Alaykum!
    Siz ushbu bot yordamida kanalingizga 100% Ozbek va aktiv odamlarni qosholasiz!

    Pastdagi tugmalardan birini bosing:",
   	'reply_markup'=>json_encode([
  	'inline_keyboard'=>[
    [
   ['text'=>"💸 Tanga ishlash",'callback_data'=>'takecoin']
   ],
    [
   ['text'=>"🎯 Kanal qoshish",'callback_data'=>'takemember'],['text'=>"👤 Profilim",'callback_data'=>'accont']
   ],
   [
   ['text'=>"👥 Referal",'callback_data'=>'member'],['text'=>"💶 Tanga sotib olish",'callback_data'=>'bycoin']
   ],
      [
   ['text'=>"💰 Tanga otkazish",'callback_data'=>'sendcoin'],['text'=>"💼 Buyurtmalar",'callback_data'=>'suporder']
   ],
      [
   ['text'=>"🤖 Admin",'callback_data'=>'sup'],['text'=>"🎩 Qoidalar",'callback_data'=>'help']
   ],
      [
   ['text'=>"🤑 Bepul tangalar",'callback_data'=>'code']
   ],
   ],
	  	'resize_keyboard'=>true,
  	])
  	]);
$juser["userfild"]["$from_id"]["file"]="none";
$juser = json_encode($juser,true);
file_put_contents("data/$from_id.json",$juser);
}
else
{
mahdi('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"Salom $first_name 😊

📣 Ushbu bot bilan siz kanalingizga bepul Ozbek azo toplashingiz mumkin

💰 Tangani toplashni boshlang va keyin Ozbek azolarini yiging!",
   	'reply_markup'=>json_encode([
  	'inline_keyboard'=>[
    [
   ['text'=>"💸 Tanga ishlash",'callback_data'=>'takecoin']
   ],
    [
   ['text'=>"🎯 Kanal qoshish",'callback_data'=>'takemember'],['text'=>"👤 Profilim",'callback_data'=>'accont']
   ],
   [
   ['text'=>"👥 Referal",'callback_data'=>'member'],['text'=>"💶 Tanga sotib olish",'callback_data'=>'bycoin']
   ],
      [
   ['text'=>"💰 Tanga otkazish",'callback_data'=>'sendcoin'],['text'=>"💼 Buyurtmalar",'callback_data'=>'suporder']
   ],
      [
   ['text'=>"🤖 Admin",'callback_data'=>'sup'],['text'=>"🎩 Qoidalar",'callback_data'=>'help']
   ],
      [
   ['text'=>"🤑 Bepul tangalar",'callback_data'=>'code']
   ],
    ],
	  	'resize_keyboard'=>true,
  	])
  	]);
$juser = json_decode(file_get_contents("data/$from_id.json"),true);
$juser["userfild"]["$from_id"]["invite"]="0";
$juser["userfild"]["$from_id"]["coin"]="0";
$juser["userfild"]["$from_id"]["setchannel"]="Siz kanalga azo bolmadingiz!";
$juser["userfild"]["$from_id"]["setmember"]="Siz kanalga azo bolmadingiz!";
$juser = json_encode($juser,true);
file_put_contents("data/$from_id.json",$juser);
}
}
elseif(strpos($textmassage , '/start ') !== false  ) {
$start = str_replace("/start ","",$textmassage);
if(in_array($from_id, $user["userlist"])) {
mahdi('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"Salom $first_name 😊

📣 Ushbu bot bilan siz kanalingizga bepul Ozbek azo toplashingiz mumkin

💰 Tangani toplashni boshlang va keyin Ozbek azolarini yiging!",
	   	'reply_markup'=>json_encode([
  	'inline_keyboard'=>[
    [
   ['text'=>"💸 Tanga ishlash",'callback_data'=>'takecoin']
   ],
    [
   ['text'=>"🎯 Kanal qoshish",'callback_data'=>'takemember'],['text'=>"👤 Profilim",'callback_data'=>'accont']
   ],
   [
   ['text'=>"👥 Referal",'callback_data'=>'member'],['text'=>"💶 Tanga sotib olish",'callback_data'=>'bycoin']
   ],
      [
   ['text'=>"💰 Tanga otkazish",'callback_data'=>'sendcoin'],['text'=>"💼 Buyurtmalar",'callback_data'=>'suporder']
   ],
      [
   ['text'=>"🤖 Admin",'callback_data'=>'sup'],['text'=>"🎩 Qoidalar",'callback_data'=>'help']
   ],
      [
   ['text'=>"🤑 Bepul tangalar",'callback_data'=>'code']
   ],
    ],
	  	'resize_keyboard'=>true,
  	])
  	]);
}
else
{
$juser = json_decode(file_get_contents("data/$from_id.json"),true);
$inuser = json_decode(file_get_contents("data/$start.json"),true);
$member = $inuser["userfild"]["$start"]["invite"];
$coin = $inuser["userfild"]["$start"]["coin"];
$memberplus = $member + 1;
$coinplus = $coin  +1;
	mahdi('sendmessage',[
	'chat_id'=>$start,
	'text'=>"Siz dostingizni taklif qildingiz!
📌 Taklif qilingan dostlaringiz soni: $memberplus. Taklif uchun sizga $coinplus  tanga berildi!",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"🔙 Menyu ",'callback_data'=>'panel']
				   ],
                     ]
               ])
 ]);
 mahdi('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"Salom $first_name 😊

📣 Ushbu bot bilan siz kanalingizga bepul Ozbek azo toplashingiz mumkin

💰 Tangani toplashni boshlang va keyin Ozbek azolarini yiging!",
   	'reply_markup'=>json_encode([
  	'inline_keyboard'=>[
    [
   ['text'=>"💸 Tanga ishlash",'callback_data'=>'takecoin']
   ],
    [
   ['text'=>"🎯 Kanal qoshish",'callback_data'=>'takemember'],['text'=>"👤 Profilim",'callback_data'=>'accont']
   ],
   [
   ['text'=>"👥 Referal",'callback_data'=>'member'],['text'=>"💶 Tanga sotib olish",'callback_data'=>'bycoin']
   ],
      [
   ['text'=>"💰 Tanga otkazish",'callback_data'=>'sendcoin'],['text'=>"💼 Buyurtmalar",'callback_data'=>'suporder']
   ],
      [
   ['text'=>"🤖 Admin",'callback_data'=>'sup'],['text'=>"🎩 Qoidalar",'callback_data'=>'help']
   ],
      [
   ['text'=>"🤑 Bepul tangalar",'callback_data'=>'code']
   ],
    ],
	  	'resize_keyboard'=>true,
  	])
  	]);	
$inuser["userfild"]["$start"]["invite"]="$memberplus";
$inuser["userfild"]["$start"]["coin"]="$coinplus";
$inuser = json_encode($inuser,true);
file_put_contents("data/$start.json",$inuser);
$juser["userfild"]["$from_id"]["invite"]="0";
$juser["userfild"]["$from_id"]["coin"]="0";
$juser["userfild"]["$from_id"]["setchannel"]="Siz kanalga azo bolmadingiz!";
$juser["userfild"]["$from_id"]["setmember"]="Siz kanalga azo bolmadingiz!";
$juser["userfild"]["$from_id"]["inviter"]="$start";
$juser = json_encode($juser,true);
file_put_contents("data/$from_id.json",$juser);	
}
}
elseif($cuser["userfild"]["$fromid"]["channeljoin"] == true){
$allchannel = $cuser["userfild"]["$fromid"]["channeljoin"];
for($z = 0;$z <= count($allchannel) -1;$z++){
$getchannel = json_decode(file_get_contents("https://api.telegram.org/bot".$token."/getChatMember?chat_id=@".$allchannel[$z]."&user_id=".$fromid));
$okchannel = $getchannel->result->status;
if($okchannel != 'member' && $okchannel != 'creator' && $okchannel != 'administrator'){
break;
}
}
if($allchannel[$z] == true){
     mahdi('answercallbackquery', [
              'callback_query_id' =>$membercall,
            'text' => "💿 Siz kanalni tark etdingiz @$allchannel[$z] va -5 tanga jarima oldingiz",
            'show_alert' =>false
         ]);  
unset($cuser["userfild"]["$fromid"]["channeljoin"][$z]);
$cuser["userfild"]["$fromid"]["channeljoin"]=array_values($cuser["userfild"]["$fromid"]["channeljoin"]);  
$coin = $cuser["userfild"]["$fromid"]["coin"];
$pluscoin = $coin - 5;
$cuser["userfild"]["$fromid"]["coin"]="$pluscoin";
$cuser = json_encode($cuser,true);
file_put_contents("data/$fromid.json",$cuser);      
}
}
if($data=="panel"){
mahdi('editmessagetext',[
        'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"Menyuga qaytdik.

Kerakli bolimni tanlang:",
   	'reply_markup'=>json_encode([
  	'inline_keyboard'=>[
    [
   ['text'=>"💸 Tanga ishlash",'callback_data'=>'takecoin']
   ],
    [
   ['text'=>"🎯 Kanal qoshish",'callback_data'=>'takemember'],['text'=>"👤 Profilim",'callback_data'=>'accont']
   ],
   [
   ['text'=>"👥 Referal",'callback_data'=>'member'],['text'=>"💶 Tanga sotib olish",'callback_data'=>'bycoin']
   ],
      [
   ['text'=>"💰 Tanga otkazish",'callback_data'=>'sendcoin'],['text'=>"💼 Buyurtmalar",'callback_data'=>'suporder']
   ],
      [
   ['text'=>"🤖 Admin",'callback_data'=>'sup'],['text'=>"🎩 Qoidalar",'callback_data'=>'help']
   ],
      [
   ['text'=>"🤑 Bepul tangalar",'callback_data'=>'code']
   ],
    ],
	  	'resize_keyboard'=>true,
  	])
  	]);	
$cuser = json_decode(file_get_contents("data/$fromid.json"),true);
$cuser["userfild"]["$fromid"]["file"]="none";
$cuser = json_encode($cuser,true);
file_put_contents("data/$fromid.json",$cuser);
}
elseif($data=="takecoin" ){
$rules = $cuser["userfild"]["$fromid"]["acceptrules"];
if($rules == false){
mahdi('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"
STOP!

   Avval qoidalarni yaxshilab oqib chiqing! Keyin esa tanga ishlang!

1- Avval bizning kanalga obuna boling! @Ref_tv
2- Kanallarga qoshiling tanga yeging!
3- Kanaldan chiqib ketsangiz 5 tanga shtraf!
4- Buyurtmachilar uchun:
Agar shtarafinfiz ko'payib ketsa admin bilan bog'laning!
 Botni kanalda VIP admin qiling!

📌 Elon: BU YERDA REKLAMA JOYLASHINGIZ MUMKUN!

Reklama joylash uchun adminga yozing: @GOLD_STARUZ

Qoidalar tugmasi orqali barcha vazifalarni togri bajaring!",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
				   ['text'=>"💸 Tanga ishlash",'callback_data'=>"takecoin"],['text'=>"🔙 Menyu",'callback_data'=>'panel']
				   ],
[
				   ['text'=>"🎩 Qoidalar",'callback_data'=>'help']
				   ],
                     ]
               ])
	]);	
$cuser["userfild"]["$fromid"]["acceptrules"]="true";
$cuser = json_encode($cuser,true);
file_put_contents("data/$fromid.json",$cuser);
		   }
else
{
if($tchq != 'member' && $tchq != 'creator' && $tchq != 'administrator'){
$join = $cuser["userfild"]["$fromid"]["canceljoin"];
if($join == false){
mahdi('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"🤖 Birinch bolib bizning kanalga obuna boling!",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
				   ['text'=>"Obuna bolish",'url'=>"https://t.me/$channel"],['text'=>"💰 Tekshirish",'callback_data'=>'mainchannel']
				   ],
				   [
				   ['text'=>"💸 Tanga ishlash",'callback_data'=>'takecoin'],['text'=>"🔙 Menyu",'callback_data'=>'panel']
				   ],
                     ]
               ])
			   ]);
$cuser["userfild"]["$fromid"]["canceljoin"]="true";
$cuser = json_encode($cuser,true);
file_put_contents("data/$fromid.json",$cuser);		   
}
else
{
$allchannel = $user["channellist"];
for($z = 0;$z <= count($allchannel);$z++){
$getchannel = json_decode(file_get_contents("https://api.telegram.org/bot".$token."/getChatMember?chat_id=".$allchannel[$z]."&user_id=".$fromid));
$okchannel = $getchannel->result->status;
if($okchannel != 'member' && $okchannel != 'creator' && $okchannel != 'administrator'){
break;
}
}
if ($allchannel[$z] == true){
$url = file_get_contents("https://api.telegram.org/bot$token/getChat?chat_id=$allchannel[$z]");
$getchat = json_decode($url, true);
$name = $getchat["result"]["title"]; 
$username = $getchat["result"]["username"]; 
$id = $getchat["result"]["id"]; 
$description = $getchat["result"]["description"];
mahdi('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"Kanal nomi : $name
Kanal userneymi :  @$username
Kanal IDsi : $id
Kanal haqida : $description
💸 Kanalga obuna boling va botga qaytib Tekshirish tugmasini bosing.
         Kanalga qoshilganga biz 1 tanga beramiz!
🔺 Kanaldan chiqib ketsangiz 5 tanga ushlab qolinadi
Agarda kanal 18+ yoki yomon kanal bolsa Yomon kanal tugmasini bosing!",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
				   ['text'=>"📣 Obuna bolish",'url'=>"https://t.me/$username"],['text'=>"Tekshirish",'callback_data'=>'truechannel']
				   ],
				   [
				   ['text'=>"➡  Otkazib yuborish",'callback_data'=>'nextchannel'],['text'=>"🔙 Menyu",'callback_data'=>'panel']
				   ],
				   				   [
				   ['text'=>"Yomon kanal",'callback_data'=>'badchannel']
				   ],
                     ]
               ])
			   ]);
$cuser["userfild"]["$fromid"]["getjoin"]="$username";
$cuser["userfild"]["$fromid"]["arraychannel"]="$z";
$cuser = json_encode($cuser,true);
file_put_contents("data/$fromid.json",$cuser);	
}
else
{
mahdi('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"Xozircha yangi kanallar yoq! Foydalanuvchilar  buyurtma berganda kanal shu yerda paydo bo'ladi!  Keyinroq tekshirib ko'ring",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
				   ['text'=>"💸 Tanga ishlash",'callback_data'=>'takecoin'],['text'=>"🔙 Menyu",'callback_data'=>'panel']
				   ],
                     ]
               ])
			   ]);
}
}
}
else
{
$allchannel = $user["channellist"];
for($z = 0;$z <= count($allchannel);$z++){
$getchannel = json_decode(file_get_contents("https://api.telegram.org/bot".$token."/getChatMember?chat_id=".$allchannel[$z]."&user_id=".$fromid));
$okchannel = $getchannel->result->status;
if($okchannel != 'member' && $okchannel != 'creator' && $okchannel != 'administrator'){
break;
}
}
if ($allchannel[$z] == true){
$url = file_get_contents("https://api.telegram.org/bot$token/getChat?chat_id=$allchannel[$z]");
$getchat = json_decode($url, true);
$name = $getchat["result"]["title"]; 
$username = $getchat["result"]["username"]; 
$id = $getchat["result"]["id"]; 
$description = $getchat["result"]["description"];
mahdi('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"Kanal nomi : $name
Kanal userneymi :  @$username
Kanal IDsi : $id
Kanal haqida : $description
💸 Kanalga obuna boling va botga qaytib Tekshirish tugmasini bosing.
         Kanalga qoshilganga biz 1 tanga beramiz!
🔺 Kanaldan chiqib ketsangiz 5 tanga ushlab qolinadi
Agarda kanal 18+ yoki yomon kanal bolsa Yomon kanal tugmasini bosing!",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
				   ['text'=>"📣 Obuna bolish",'url'=>"https://t.me/$username"],['text'=>"Tekshirish",'callback_data'=>'truechannel']
				   ],
				   [
				   ['text'=>"➡  Otkazib yuborish",'callback_data'=>'nextchannel'],['text'=>"🔙 Menyu",'callback_data'=>'panel']
				   ],
				   [
				   ['text'=>"Yomon kanal",'callback_data'=>'badchannel']
				   ],
                     ]
               ])
			   ]);
$cuser["userfild"]["$fromid"]["getjoin"]="$username";
$cuser["userfild"]["$fromid"]["arraychannel"]="$z";
$cuser = json_encode($cuser,true);
file_put_contents("data/$fromid.json",$cuser);
}
else
{
mahdi('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"Xozircha yangi kanallar yoq! Keyinroq kelib koring!",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
                    [
				   ['text'=>"💸 Tanga ishlash",'callback_data'=>'takecoin'],['text'=>"🔙 Menyu",'callback_data'=>'panel']
				   ],
                     ]
               ])
			   ]);
}
}
}
}
elseif($data=="truechannel" ){
$getjoinchannel = $cuser["userfild"]["$fromid"]["getjoin"];
$getchannel = json_decode(file_get_contents("https://api.telegram.org/bot".$token."/getChatMember?chat_id=@".$getjoinchannel."&user_id=".$fromid));
$okchannel = $getchannel->result->status;
if($okchannel != 'member' && $okchannel != 'creator' && $okchannel != 'administrator'){
        mahdi('answercallbackquery', [
            'callback_query_id' =>$membercall,
            'text' => "Siz kanalga azo bolmadingiz!",
            'show_alert' =>true
        ]);
}
else
{
 mahdi('answercallbackquery', [
            'callback_query_id' =>$membercall,
            'text' => "🎉 Tabriklaymiz! Siz kanalga obuna boldingiz va 1 tanga ishlab oldingiz!",
            'show_alert' =>false
				   ]);
$cuser = json_decode(file_get_contents("data/$fromid.json"),true);
$coin = $cuser["userfild"]["$fromid"]["coin"];
$arraychannel = $cuser["userfild"]["$fromid"]["arraychannel"];
$coinchannel = $user["setmemberlist"];
$channelincoin = $coinchannel[$arraychannel];
$downchannel = $channelincoin - 1;
$pluscoin = $coin + 1;
$cuser["userfild"]["$fromid"]["channeljoin"][]="$getjoinchannel";
$cuser["userfild"]["$fromid"]["coin"]="$pluscoin";
$cuser = json_encode($cuser,true);
file_put_contents("data/$fromid.json",$cuser);
if($downchannel > 0){
@$user = json_decode(file_get_contents("data/user.json"),true);
$user["setmemberlist"]["$arraychannel"]="$downchannel";
$user["setmemberlist"]=array_values($user["setmemberlist"]); 
$user = json_encode($user,true);
file_put_contents("data/user.json",$user);
@$user = json_decode(file_get_contents("data/user.json"),true);
$allchannel = $user["channellist"];
for($z = 0;$z <= count($allchannel);$z++){
$getchannel = json_decode(file_get_contents("https://api.telegram.org/bot".$token."/getChatMember?chat_id=".$allchannel[$z]."&user_id=".$fromid));
$okchannel = $getchannel->result->status;
if($okchannel != 'member' && $okchannel != 'creator' && $okchannel != 'administrator'){
break;
}
}
if ($allchannel[$z] == true){
$url = file_get_contents("https://api.telegram.org/bot$token/getChat?chat_id=$allchannel[$z]");
$getchat = json_decode($url, true);
$name = $getchat["result"]["title"]; 
$username = $getchat["result"]["username"]; 
$id = $getchat["result"]["id"]; 
$description = $getchat["result"]["description"];
mahdi('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"Kanal nomi : $name
Kanal userneymi :  @$username
Kanal IDsi : $id
Kanal haqida : $description
💸 Kanalga obuna boling va botga qaytib Tekshirish tugmasini bosing.
         Kanalga qoshilganga biz 1 tanga beramiz!
🔺 Kanaldan chiqib ketsangiz 5 tanga ushlab qolinadi
Agarda kanal 18+ yoki yomon kanal bolsa Yomon kanal tugmasini bosing!",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
				    ['text'=>"📣 Obuna bolish",'url'=>"https://t.me/$username"],['text'=>"Tekshirish",'callback_data'=>'truechannel']
				   ],
				   [
				   ['text'=>"➡  Otkazib yuborish",'callback_data'=>'nextchannel'],['text'=>"🔙 Menyu",'callback_data'=>'panel']
				   ],
				   [
				   ['text'=>"Yomon kanal",'callback_data'=>'badchannel']
				   ],
                     ]
               ])
			   ]);
$cuser = json_decode(file_get_contents("data/$fromid.json"),true);
$cuser["userfild"]["$fromid"]["getjoin"]="$username";
$cuser["userfild"]["$fromid"]["arraychannel"]="$z";
$cuser = json_encode($cuser,true);
file_put_contents("data/$fromid.json",$cuser);
}
else
{
mahdi('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"Xozircha kanallar yoq! Keyinroq kelib koring1",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
                    [
				   ['text'=>"💸 Tanga ishlash",'callback_data'=>'takecoin'],['text'=>"🔙 Menyu",'callback_data'=>'panel']
				   ],
                     ]
               ])
			   ]);
}
}
else
{
unset($user["setmemberlist"]["$arraychannel"]);
unset($user["channellist"]["$arraychannel"]);
$user["channellist"]=array_values($user["channellist"]); 
$user["setmemberlist"]=array_values($user["setmemberlist"]);  
$user = json_encode($user,true);
file_put_contents("data/user.json",$user);
@$user = json_decode(file_get_contents("data/user.json"),true);
$allchannel = $user["channellist"];
for($z = 0;$z <= count($allchannel);$z++){
$getchannel = json_decode(file_get_contents("https://api.telegram.org/bot".$token."/getChatMember?chat_id=".$allchannel[$z]."&user_id=".$fromid));
$okchannel = $getchannel->result->status;
if($okchannel != 'member' && $okchannel != 'creator' && $okchannel != 'administrator'){
break;
}
}
if ($allchannel[$z] == true){
$url = file_get_contents("https://api.telegram.org/bot$token/getChat?chat_id=$allchannel[$z]");
$getchat = json_decode($url, true);
$name = $getchat["result"]["title"]; 
$username = $getchat["result"]["username"]; 
$id = $getchat["result"]["id"]; 
$description = $getchat["result"]["description"];
mahdi('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"Kanal nomi : $name
Kanal userneymi :  @$username
Kanal IDsi : $id
Kanal haqida : $description
💸 Kanalga obuna boling va botga qaytib Tekshirish tugmasini bosing.
         Kanalga qoshilganga biz 1 tanga beramiz!
🔺 Kanaldan chiqib ketsangiz 5 tanga ushlab qolinadi
Agarda kanal 18+ yoki yomon kanal bolsa Yomon kanal tugmasini bosing!",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
				    ['text'=>"📣 Obuna bolish",'url'=>"https://t.me/$username"],['text'=>"Tekshirish",'callback_data'=>'truechannel']
				   ],
				   [
				   ['text'=>"➡  Otkazib yuborish",'callback_data'=>'nextchannel'],['text'=>"🔙 Menyu",'callback_data'=>'panel']
				   ],
				   [
				   ['text'=>"Yomon kanal",'callback_data'=>'badchannel']
				   ],
                     ]
               ])
			   ]);
$cuser = json_decode(file_get_contents("data/$fromid.json"),true);
$cuser["userfild"]["$fromid"]["getjoin"]="$username";
$cuser["userfild"]["$fromid"]["arraychannel"]="$z";
$cuser = json_encode($cuser,true);
file_put_contents("data/$fromid.json",$cuser);
}
else
{
mahdi('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"Yangi kanallar yoq! Keyinroq kelib koring!",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
                    [
				   ['text'=>"💸 Tanga ishlash",'callback_data'=>'takecoin'],['text'=>"🔙 Menyu",'callback_data'=>'panel']
				   ],
                     ]
               ])
			   ]);
}
}
}
}
elseif($data=="nextchannel" ){
 mahdi('answercallbackquery', [
            'callback_query_id' =>$membercall,
            'text' => "Otkazib yuborildi...",
            'show_alert' =>false
        ]);
$arraychannel = $cuser["userfild"]["$fromid"]["arraychannel"];
$plusarraychannel = $arraychannel + 1 ;
$allchannel = $user["channellist"];
for($z = $plusarraychannel;$z <= count($allchannel);$z++){
$getchannel = json_decode(file_get_contents("https://api.telegram.org/bot".$token."/getChatMember?chat_id=".$allchannel[$z]."&user_id=".$fromid));
$okchannel = $getchannel->result->status;
if($okchannel != 'member' && $okchannel != 'creator' && $okchannel != 'administrator'){
break;
}
}
if ($allchannel[$z] == true){
$url = file_get_contents("https://api.telegram.org/bot$token/getChat?chat_id=$allchannel[$z]");
$getchat = json_decode($url, true);
$name = $getchat["result"]["title"]; 
$username = $getchat["result"]["username"]; 
$id = $getchat["result"]["id"]; 
$description = $getchat["result"]["description"];
mahdi('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"Kanal nomi : $name
Kanal userneymi :  @$username
Kanal IDsi : $id
Kanal haqida : $description
💸 Kanalga obuna boling va botga qaytib Tekshirish tugmasini bosing.
         Kanalga qoshilganga biz 1 tanga beramiz!
🔺 Kanaldan chiqib ketsangiz 5 tanga ushlab qolinadi
Agarda kanal 18+ yoki yomon kanal bolsa Yomon kanal tugmasini bosing!",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
				    ['text'=>"📣 Obuna bolish",'url'=>"https://t.me/$username"],['text'=>"Tekshirish",'callback_data'=>'truechannel']
				   ],
				   [
				   ['text'=>"➡  Otkazib yuborish",'callback_data'=>'nextchannel'],['text'=>"🔙 Menyu",'callback_data'=>'panel']
				   ],
				   [
				   ['text'=>"Yomon kanal",'callback_data'=>'badchannel']
				   ],
                     ]
               ])
			   ]);
$cuser["userfild"]["$fromid"]["getjoin"]="$username";
$cuser["userfild"]["$fromid"]["arraychannel"]="$z";
$cuser = json_encode($cuser,true);
file_put_contents("data/$fromid.json",$cuser);
}
else
{
mahdi('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"Yangi kanallar yoq! Keyinroq kelib koring!",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
                    [
				   ['text'=>"💸 Tanga ishlash",'callback_data'=>'takecoin'],['text'=>"🔙 Menyu",'callback_data'=>'panel']
				   ],
                     ]
               ])
			   ]);
}
}
elseif($data=="mainchannel" ){
$getchannel = json_decode(file_get_contents("https://api.telegram.org/bot".$token."/getChatMember?chat_id=@".$channel."&user_id=".$fromid));
$okchannel = $getchannel->result->status;
if($okchannel != 'member' && $okchannel != 'creator' && $okchannel != 'administrator'){
        mahdi('answercallbackquery', [
            'callback_query_id' =>$membercall,
            'text' => "Вы не подписаны на канал!",
            'show_alert' =>true
        ]);
}
else
{
 mahdi('answercallbackquery', [
            'callback_query_id' =>$membercall,
            'text' => "🎉 Tabriklaymiz sizga 1 tanga berildi!",
            'show_alert' =>false
        ]);
$coin = $cuser["userfild"]["$fromid"]["coin"];
$pluscoin = $coin + 1;
$cuser["userfild"]["$fromid"]["coin"]="$pluscoin";
$cuser["userfild"]["$fromid"]["channeljoin"][]="$channel";
$cuser = json_encode($cuser,true);
file_put_contents("data/$fromid.json",$cuser);
@$user = json_decode(file_get_contents("data/user.json"),true);
$allchannel = $user["channellist"];
for($z = 0;$z <= count($allchannel);$z++){
$getchannel = json_decode(file_get_contents("https://api.telegram.org/bot".$token."/getChatMember?chat_id=".$allchannel[$z]."&user_id=".$fromid));
$okchannel = $getchannel->result->status;
if($okchannel != 'member' && $okchannel != 'creator' && $okchannel != 'administrator'){
$omm = $allchannel[$z];
break;
}
}
if ($allchannel[$z] == true){
$url = file_get_contents("https://api.telegram.org/bot$token/getChat?chat_id=$allchannel[$z]");
$getchat = json_decode($url, true);
$name = $getchat["result"]["title"]; 
$username = $getchat["result"]["username"]; 
$id = $getchat["result"]["id"]; 
$description = $getchat["result"]["description"];
mahdi('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"Kanal nomi : $name
Kanal userneymi :  @$username
Kanal IDsi : $id
Kanal haqida : $description
💸 Kanalga obuna boling va botga qaytib Tekshirish tugmasini bosing.
         Kanalga qoshilganga biz 1 tanga beramiz!
🔺 Kanaldan chiqib ketsangiz 5 tanga ushlab qolinadi
Agarda kanal 18+ yoki yomon kanal bolsa Yomon kanal tugmasini bosing!",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
				    ['text'=>"📣 Obuna bolish",'url'=>"https://t.me/$username"],['text'=>"Tekshirish",'callback_data'=>'truechannel']
				   ],
				   [
				   ['text'=>"➡  Otkazib yuborish",'callback_data'=>'nextchannel'],['text'=>"🔙 Menyu",'callback_data'=>'panel']
				   ],
				   [
				   ['text'=>"Yomon kanal",'callback_data'=>'badchannel']
				   ],
                     ]
               ])
			   ]);
$cuser = json_decode(file_get_contents("data/$fromid.json"),true);
$cuser["userfild"]["$fromid"]["getjoin"]="$username";
$cuser = json_encode($cuser,true);
file_put_contents("data/$fromid.json",$cuser);
}
else
{
mahdi('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"Yangi kanallar yoq! Keyinroq kelib koring!",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
                    [
				   ['text'=>"💸 Tanga ishlash",'callback_data'=>'takecoin'],['text'=>"🔙 Menyu",'callback_data'=>'panel']
				   ],
                     ]
               ])
			   ]);
}
}
}
elseif($data=="badchannel"){
$getjoinchannel = $cuser["userfild"]["$fromid"]["getjoin"];
	 mahdi('answercallbackquery', [
	            'callback_query_id' =>$membercall,
            'text' => "Yomon kanal xaqida adminga xabar bering",
            'show_alert' =>true
        ]);
	mahdi('sendmessage',[
	'chat_id'=>$Dev[0],
	'text'=>"⚠️Yomon kanal  @$getjoinchannel

🔸 ID: $fromid
Foydalanuvchi: @ $usernames",
  	]);
}
elseif($data=="accont"){
$invite = $cuser["userfild"]["$fromid"]["invite"];
$coin = $cuser["userfild"]["$fromid"]["coin"];
$setchannel = $cuser["userfild"]["$fromid"]["setchannel"];
$setmember = $cuser["userfild"]["$fromid"]["setmember"];
mahdi('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"Siz haqingizdagi malumotlar:

💰 Tangalar soni: $coin
Taklif qilingan dostlaringiz soni: $invite
Sizning ismingiz: $firstname
Sizning useri: @$usernames
Sizning id: $fromid",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   				   [
['text'=>"Obunalar",'callback_data'=>'mechannel'],['text'=>"💳 Mening kanalim",'callback_data'=>'order']
				   ],
				   [
['text'=>"� Menyu",'callback_data'=>'panel']
				   ],
                     ]
               ])
			   ]);
}
elseif($data=="mechannel"){
$allchannel = $cuser["userfild"]["$fromid"]["channeljoin"];
for($z = 0;$z <= count($allchannel)-1;$z++){
$result = $at.$result."📍 "."@".$allchannel[$z]."\n";
}
if($result == true){
mahdi('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
	'text'=>"Siz obuna bolgan kanallar:

$result

Kanaldan chiqib ketsangiz -5 tanga",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"🔙 Menyu",'callback_data'=>'panel']
				   ],
				   ]
            ])           
  	]);		
}	
else
{
mahdi('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
	'text'=>"Siz xali kanal qoshmadingiz!",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"� Menyu",'callback_data'=>'panel'],['text'=>"💰 Tanga ishlash",'callback_data'=>'takecoin']
				   ],
				   ]
            ])           
  	]);		
}
}
elseif($data=="order"){
$allchannel = $cuser["userfild"]["$fromid"]["listorder"];
for($z = 0;$z <= count($allchannel)-1;$z++){
$result = $at.$result."📍 ".$allchannel[$z]." Obunachilar"."\n";
}
if($result == true){
mahdi('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
	'text'=>"Sizning zakazlaringiz:

$result",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"🔙 Menyu",'callback_data'=>'panel']
				   ],
				   ]
            ])           
  	]);		
}
else
{
$coin = $cuser["userfild"]["$fromid"]["coin"];
mahdi('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
	'text'=>"Siz hali buyurtmalar qilmadingiz!
    Agar sizda 10tangadan ortiq tangangiz bolsa buyurtma bering!
    Sizning tangalaringiz : $coin",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"� Menyu",'callback_data'=>'panel'],['text'=>"� Buyurtma berish",'callback_data'=>'takemember']
				   ],
				   ]
            ])           
  	]);
}
}
elseif($data=="member"){
$invite = $cuser["userfild"]["$fromid"]["invite"];
$coin = $cuser["userfild"]["$fromid"]["coin"];
		mahdi('sendphoto',[
	'chat_id'=>$chatid,
	'photo'=>new CURLFile("other/pic.jpg"),
	'caption'=>"Dostlaringizni taklif qiling! Xar bir dostingiz uchun 2 tangadan oling!:
    Sizning referal Havolangiz:
https://t.me/$usernamebot?start=$fromid",
    		]);
	mahdi('sendmessage',[
	'chat_id'=>$chatid,
'text'=>"Dostlaringizni taklif qiling! Xar bir dostingiz uchun 2 tangadan oling!:
    Sizning referal Havolangiz:
https://t.me/$usernamebot?start=$fromid
 Tangalar soni: $coin
 Takliflar soni: $invite

 Agar dostingiz tanga sotib olsa siz 20% bonus olasiz!",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"🔙 Menyu",'callback_data'=>'panel']
				   ],
				   ]
            ])           
  	]);			
}
elseif($data=="sendcoin"){	

mahdi('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
	'text'=>"Tangalarni dostingizga otkazish uchun dostingiz IDsini menga yuboring!",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"� Menyu",'callback_data'=>'panel']
				   ],
				   ]
            ])           
  	]);	
$cuser["userfild"]["$fromid"]["file"]="sendcoin";
$cuser = json_encode($cuser,true);
file_put_contents("data/$fromid.json",$cuser);		
}
elseif ($juser["userfild"]["$from_id"]["file"] == 'sendcoin') {
$coin = $juser["userfild"]["$from_id"]["coin"];
if($forward_from == true){
if($forward_from_id != $from_id){
         mahdi('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"Dostingiz topildi;

📌 U xaqida malumot:
📍 Ismi: $forward_from_first_name
Useri: @$forward_from_username
 ID: $forward_from_id

🔆 Yuboriladigan tanga sonini menga yuboring!
💰 Tangalaringiz soni: coin$",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"� Menyu",'callback_data'=>'panel']
				   ],
                     ]
               ])
 ]);
$juser["userfild"]["$from_id"]["file"]="setsendcoin";
$juser["userfild"]["$from_id"]["sendcoinid"]="$forward_from_id";
$juser = json_encode($juser,true);
file_put_contents("data/$from_id.json",$juser);	
}
else
{
	mahdi('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"Siz tangani ozingizga ozingiz yuborolmaysiz!",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"� Menyu",'callback_data'=>'panel']
				   ],
                     ]
               ])
 ]);
}
}
else
{
if($textmassage != $from_id){
if(is_numeric($textmassage)){
$stat = file_get_contents("https://api.telegram.org/bot$token/getChatMember?chat_id=$textmassage&user_id=".$textmassage);
$statjson = json_decode($stat, true);
$status = $statjson['ok'];
if($status == 1){
$name = $statjson['result']['user']['first_name'];
$username = $statjson['result']['user']['username'];
$id = $statjson['result']['user']['id'];
         mahdi('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"Dostingiz topildi;

📌 U xaqida malumot:
📍 Ismi: $forward_from_first_name
Useri: @$forward_from_username
 ID: $forward_from_id

🔆 Yuboriladigan tanga sonini yozing!
💰 Tangalaringiz soni: coin$",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"� Menyu",'callback_data'=>'panel']
				   ],
                     ]
               ])
 ]);
$juser["userfild"]["$from_id"]["file"]="setsendcoin";
$juser["userfild"]["$from_id"]["sendcoinid"]="$textmassage";
$juser = json_encode($juser,true);
file_put_contents("data/$from_id.json",$juser);	
}
else
{
         mahdi('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"Bunday ID yoq!",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"🔙 Menyu",'callback_data'=>'panel']
				   ],
                     ]
               ])
 ]);
}
}
else
{
         mahdi('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"Bunday ID telegramda mavjud emas!
            Iltimos etibor berib yozing!",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"🔙 Menyu",'callback_data'=>'panel']
				   ],
                     ]
               ])
 ]);
}
}
else
{
	mahdi('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"Siz tangani ozingizga ozingiz yuborolmaysiz!",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"� Menyu",'callback_data'=>'panel']
				   ],
                     ]
               ])
 ]);	
}
}
}	
elseif($juser["userfild"]["$from_id"]["file"] == "setsendcoin"){
$coin = $juser["userfild"]["$from_id"]["coin"];
$userid = $juser["userfild"]["$from_id"]["sendcoinid"];
$inuser = json_decode(file_get_contents("data/$userid.json"),true);
$coinuser = $inuser["userfild"]["$userid"]["coin"];
if($textmassage <= $coin && $coin > 0){
$coinplus = $coin - $textmassage;
$sendcoinplus = $coinuser + $textmassage;
	mahdi('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"Tangalar otkazildi!

 Otkazish haqida malumot:
 ID: $userid
 Otkazilgan tangalar soni: $textmassage
 Qolgan tangalar soni: $coinplus",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"🔙 Menyu",'callback_data'=>'panel']
				   ],
				   ]
            ])           
  	]);	
		mahdi('sendmessage',[
	'chat_id'=>$userid,
	'text'=>"Sizga dostingiz $textmassage tanga yubordi

Yuboruvchi xaqida malumot:
ID: $from_id
Username: @$username",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"🔙 Menyu",'callback_data'=>'panel']
				   ],
				   ]
            ])           
  	]);	
$juser["userfild"]["$from_id"]["file"]="none";
$juser["userfild"]["$from_id"]["coin"]="$coinplus";
$juser = json_encode($juser,true);
file_put_contents("data/$from_id.json",$juser);	
$inuser["userfild"]["$userid"]["coin"]="$sendcoinplus";
$inuser = json_encode($inuser,true);
file_put_contents("data/$userid.json",$inuser);	
}
else
{
	mahdi('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"📍Sizda otkazish uchun tangalar yetmaydi!

📌 Tangalaringiz soni  : $coin",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"🔙 Назад",'callback_data'=>'panel']
				   ],
				   ]
            ])           
  	]);	
}
}
elseif($data=="suporder"){
$allchannel = $cuser["userfild"]["$fromid"]["listorder"];
for($z = 0;$z <= count($allchannel)-1;$z++){
$result = $at.$result."📍 ".$allchannel[$z]." Участники"."\n";
}
if($result == true){
mahdi('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"Obunachilarni olish uchun kanalingiz userini yuboring

📌 Quyidagicha yozing:
Masalan:  @Ref_tv

➖➖➖➖
� Sizning buyurtmalaringiz :$result",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"🔙 Menyu",'callback_data'=>'panel']
				   ],
                     ]
               ])
			   ]);
$cuser["userfild"]["$fromid"]["file"]="setorder";
$cuser = json_encode($cuser,true);
file_put_contents("data/$fromid.json",$cuser);
}
else
{
mahdi('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"�Siz hali obunachilarga buyurtma bermadingiz!
               Buyurtma berish narxi:
               1ta obunachi 2tanga �",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"🔙 Mneyu",'callback_data'=>'panel'],['text'=>"👤 Buyurtma",'callback_data'=>'takemember']
				   ],
                     ]
               ])
			   ]);	
}
}
elseif($juser["userfild"]["$from_id"]["file"] == "setorder"){
$searchchannel = array_search($textmassage,$user["channellist"]);
$setmember = $user["setmemberlist"][$searchchannel];
if(preg_match('/^(@)(.*)/s',$textmassage)){
if($searchchannel == true){
	mahdi('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"Buyurtmangiz haqida

 Malumot:

 Kanalingiz: $textmassage
 Buyurtma qilingan obunachilar soni: $setmember

 Agarda savollar bolsa adminga yozin biz 48 soat ichida javob yozamiz!",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"🔙 Menyu",'callback_data'=>'panel']
				   ],
				   ]
            ])           
  	]);	
}
else
{
	mahdi('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"📍 Sizning buyurtmangiz bajarildi! ",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"🔙 Menyu",'callback_data'=>'panel']
				   ],
				   ]
            ])           
  	]);		
}
}
else
{
		mahdi('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"Bunday kanal yoq!
    Quyidagicha yozing:
Masalan : @$channel",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"� Menyu",'callback_data'=>'panel']
				   ],
				   ]
            ])           
  	]);	
}
}
elseif($data=="takemember"){
$coin = $cuser["userfild"]["$fromid"]["coin"];
if($coin >= 10){
mahdi('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"Kanalingiz userini menga yuboring va obunachilarga ega boling!
➕ Masalan : @$channel",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"🔙 Menyu",'callback_data'=>'panel']
				   ],
                     ]
               ])
			   ]);
$cuser["userfild"]["$fromid"]["file"]="setchannel";
$cuser = json_encode($cuser,true);
file_put_contents("data/$fromid.json",$cuser);
}
else
{
mahdi('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"Tangalar juda kam!
               Buyurtma berish uchun eng kamida 10ta tanga bolishi kerak!
               1ta obunachi 2tanga turadi!

 Tangalar soni : $coin",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"🔙 Menyu",'callback_data'=>'panel'],['text'=>"💰 Заработать монеты",'callback_data'=>'takecoin']
				   ],
                     ]
               ])
			   ]);
}
}
elseif ($juser["userfild"]["$from_id"]["file"] == 'setchannel') {
if(preg_match('/^(@)(.*)/s',$textmassage)){
$coin = $juser["userfild"]["$from_id"]["coin"];
$max = $coin / 2;
$maxmember = floor($max);
         mahdi('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"Qabul qilindi

Kanalga obunachilar: $textmassage

Nechta obunachiga ega bo'lmoqchisiz?
Siz xozir maksimum $maxmember obunachiga buyurtma berolasiz!
1ta obunachi 2tanga turadi!
Tangalaringiz soni: $coin
Quyidagicha yozing:
➕ Masalan: 10",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"🔙 Menyu",'callback_data'=>'panel']
				   ],
                     ]
               ])
 ]);
$juser["userfild"]["$from_id"]["file"]="setmember";
$juser["userfild"]["$from_id"]["setchannel"]="$textmassage";
$juser = json_encode($juser,true);
file_put_contents("data/$from_id.json",$juser);	
}
else
{
	mahdi('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>":Notogri!
            Quyidagicha yozing:
➕ Masalan @$channel",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"🔙 Menyu",'callback_data'=>'panel']
				   ],
                     ]
               ])
 ]);
}
}
elseif ($juser["userfild"]["$from_id"]["file"] == 'setmember') {
$coin = $juser["userfild"]["$from_id"]["coin"];
$setchannel = $juser["userfild"]["$from_id"]["setchannel"];
$max = $coin / 2;
$maxmember = floor($max);
if($maxmember >= $textmassage){
$howmember = getChatMembersCount($setchannel,$token);
$endmember = $howmember + $textmassage;
         mahdi('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"Buyurtma haqida malumot:

 Kanal: $setchannel
 Buyurtma qilingan obunachilar soni: $textmassage
 Hozirgi obunachilar soni: $howmember
 Buyurtmadan song boladigan obunachilar soni: $endmember

 Barchasi togri bolsa botni kanalingizda VIP admin qiling!",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   				   [
['text'=>"Tayyor",'callback_data'=>'trueorder']
				   ],
				   [
['text'=>"🔙 Menyu",'callback_data'=>'panel'],['text'=>"🚦 Qoidalar",'callback_data'=>'help']
				   ],
                     ]
               ])
 ]);
$juser["userfild"]["$from_id"]["file"]="none";
$juser["userfild"]["$from_id"]["setmember"]="$textmassage";
$juser = json_encode($juser,true);
file_put_contents("data/$from_id.json",$juser);
}
else
{
	mahdi('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"ERROR 404
 Sizning balansingizdan kelib chiqib xozir siz Maksimum $maxmember obunachi buyurtma berolasiz!
 Masalan: 10",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"🔙 Menyu",'callback_data'=>'panel']
				   ],
                     ]
               ])
 ]);
}
}
elseif($data=="trueorder"){
$setchannel = $cuser["userfild"]["$fromid"]["setchannel"];
$admin = getChatstats(@$setchannel,$token);
if($admin != true){
	       mahdi('answercallbackquery', [
            'callback_query_id' =>$membercall,
            'text' => "Botga Vip admin bering!",
            'show_alert' =>true
        ]);
}
else
{
mahdi('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"Sizning buyurtmangiz qabul qilindi!


📌 Etibor bering: siz botni adminlikdan yoki kanaldan olib tashlasangiz buyurtmangiz bekor qilinadi! Siz esa bloklanasiz!

⚠️ Qoidalar tugmasini bosing!",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"🔙 Menyu",'callback_data'=>'panel'],['text'=>"🚦 Qoidalar",'callback_data'=>'help']
				   ],
                     ]
               ])
			   ]);	
$coin = $cuser["userfild"]["$fromid"]["coin"];
$setchannel = $cuser["userfild"]["$fromid"]["setchannel"];
$setmember = $cuser["userfild"]["$fromid"]["setmember"];
$pluscoin = $setmember * 2;
$coinplus = $coin - $pluscoin;
$cuser["userfild"]["$fromid"]["coin"]="$coinplus";
$cuser["userfild"]["$fromid"]["listorder"][]="$setchannel -> $setmember";
$cuser = json_encode($cuser,true);
file_put_contents("data/$fromid.json",$cuser);
$user["channellist"][]="$setchannel";
$user["setmemberlist"][]="$setmember";
$user = json_encode($user,true);
file_put_contents("data/user.json",$user);
}
}
elseif($data=="bycoin"){
		mahdi('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"Tanga sotib olmoqchi bolsangiz adminga yozing! @GOLD_STARUZ !",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   				   [
['text'=>"Xaqiqiy pul ishlash",'url'=>"t.me/GOLD_STARUZBOT"],['text'=>"Xaqiqiy pul ishlash",'url'=>"t.me/GOLD_STARUZBOT"]
				   ],
				   [
['text'=>"🔙 Menyu",'callback_data'=>'panel']
				   ],
                     ]
               ])
			   ]);	
}
elseif($data=="help"){
		mahdi('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"Qoidalar bolimiga xush kelibsiz!

📍 Kerakli bolimni tanlang:",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   				   [
['text'=>"Qoidalar",'callback_data'=>'rules'],['text'=>"Tangalar va Obunachilar",'callback_data'=>'coinandmember']
				   ],
				   				   				   [
['text'=>"Kop beriladigan savollar!",'callback_data'=>'qu'],['text'=>"Nega admin beramiz",'callback_data'=>'whyadmin']
				   ],
				   			   				   				   [
['text'=>"Bot haqida",'callback_data'=>'about'],['text'=>"Botdan foydalanish",'callback_data'=>'howuser']
				   ],
				   			   				   				   [
['text'=>"Qanday botni admin qilamiz",'callback_data'=>'howadmin']
				   ],
				   [
['text'=>"🔙 Menyu",'callback_data'=>'panel']
				   ],
                     ]
               ])
			   ]);	
}
elseif($data=="rules"){
		mahdi('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"ℹ️ Botning buyruq va shartlari:

1⃣Agar siz robotga nomaqul bir kanalni rõyxatdan õtkazsangiz, sizning buyurtmangiz ham bot tomonidan bloklanadi

2⃣Agar siz bir necha marta xabar yuborib, botga spam yuborsangiz botdan blokirovka qilinasiz

3⃣ Buyurtmani bajarish uchun  + bolishiga bot javobgar emas.

4⃣ Agar tanga notõgri uzatilgan bolsa, admin hech qanday javobgarlikni oz zimmasiga olmaydi, shuning uchun tanga kochirishda ehtiyot boling.

5⃣ Ulangan tangalar toliq avtomatlashtirilsa, biron bir muammoga duch kelsangiz adminga murojaat qiling",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   				   [
['text'=>"Qoidalar",'callback_data'=>'rules'],['text'=>"Tangalar va Obunachilar",'callback_data'=>'coinandmember']
				   ],
				   				   				   [
['text'=>"Kop beriladigan savollar!",'callback_data'=>'qu'],['text'=>"Nega admin beramiz",'callback_data'=>'whyadmin']
				   ],
				   			   				   				   [
['text'=>"Bot haqida",'callback_data'=>'about'],['text'=>"Botdan foydalanish",'callback_data'=>'howuser']
				   ],
				   			   				   				   [
['text'=>"Qanday botni admin qilamiz",'callback_data'=>'howadmin']
				   ],
				   [
['text'=>"🔙 Menyu",'callback_data'=>'panel']
				   ],
                     ]
               ])
			   ]);	
}
elseif($data=="coinandmember"){
		mahdi('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"ℹ️ Tanga va Obunachilar:

1⃣ Har bir kanalga obuna bolish orqali tanga oling
2️⃣ Siz qoshilgan kanaldan chiqib ketsangiz -5 tanga yoqotasiz
3⃣Har bir azoni kanalizga qoshish uchun 2 ta tanga tolashingiz kerak",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   				   [
 ['text'=>"Qoidalar",'callback_data'=>'rules'],['text'=>"Tangalar va Obunachilar",'callback_data'=>'coinandmember']
				   ],
				   				   				   [
['text'=>"Kop beriladigan savollar!",'callback_data'=>'qu'],['text'=>"Nega admin beramiz",'callback_data'=>'whyadmin']
				   ],
				   			   				   				   [
['text'=>"Bot haqida",'callback_data'=>'about'],['text'=>"Botdan foydalanish",'callback_data'=>'howuser']
				   ],
				   			   				   				   [
['text'=>"Qanday botni admin qilamiz",'callback_data'=>'howadmin']
				   ],
				   [
['text'=>"🔙 Menyu",'callback_data'=>'panel']
				   ],
                     ]
               ])
			   ]);	
}
elseif($data=="qu"){
		mahdi('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"Часто задаваемые вопросы:

ℹ️ Kop beriladigam savollar:

❓Buyurtmani qancha muddat ichida toldirasiz?
❗️Bot foydalanuvchilari qanchalik kõp bõlsa shunchalik buyurtma tõldirilishi tezlashadi  shu tufayli buyurtma qanchada tõldirilishiga aniq muddat qõya olmaymiz! Chunki bu foydalanuvchilar Aktiv Uzbek va Real foydalanuvchi bõladi!

❓Tanga qanday sotib olsam boladi?
❗️Agar tanga sotib olmoqchi bolsangiz admin bilan boglaning

❓Tangamni kimgadir topshirsam boladimi?
❗️Xa, Faqat u odamni sozini  Forward qilib yoki ID raqam orqali amalga oshirilishi mumkin
2tadan kop akkaunt ochgan foydalanuvchi bloklanadi!",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   				   [
['text'=>"Qoidalar",'callback_data'=>'rules'],['text'=>"Tangalar va Obunachilar",'callback_data'=>'coinandmember']
				   ],
				   				   				   [
['text'=>"Kop beriladigan savollar!",'callback_data'=>'qu'],['text'=>"Nega admin beramiz",'callback_data'=>'whyadmin']
				   ],
				   			   				   				   [
['text'=>"Bot haqida",'callback_data'=>'about'],['text'=>"Botdan foydalanish",'callback_data'=>'howuser']
				   ],
				   			   				   				   [
['text'=>"Qanday botni admin qilamiz",'callback_data'=>'howadmin']
				   ],
				   [
['text'=>"🔙 Menyu",'callback_data'=>'panel']
				   ],
                     ]
               ])
			   ]);
}
elseif($data=="whyadmin"){
		mahdi('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"ℹ️❓Nimaga botni adminlar qatorig ornatish kerak?
               
📍 Sizning kanalingizdagi boshqaruvchingiz kanali azolaringiz royxatini korish va tanga olishni yoki tanga pasayishini hisoblash uchun administrator bolishi kerak. Buni kanalingizga hech qanday ziyon tomoni yo'q!!!

❗️Agar siz botni olib tashlasangiz, buyurtmani bot bekor qiladi va hisobingiz bloklanadi",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   				   [
['text'=>"Qoidalar",'callback_data'=>'rules'],['text'=>"Tangalar va Obunachilar",'callback_data'=>'coinandmember']
				   ],
				   				   				   [
['text'=>"Kop beriladigan savollar!",'callback_data'=>'qu'],['text'=>"Nega admin beramiz",'callback_data'=>'whyadmin']
				   ],
				   			   				   				   [
['text'=>"Bot haqida",'callback_data'=>'about'],['text'=>"Botdan foydalanish",'callback_data'=>'howuser']
				   ],
				   			   				   				   [
['text'=>"Qanday botni admin qilamiz",'callback_data'=>'howadmin']
				   ],
				   [
['text'=>"🔙 Menyu",'callback_data'=>'panel']
				   ],
                     ]
               ])
			   ]);
}
elseif($data=="howadmin"){
		mahdi('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"ℹ️ Botni adminstrator qilish

1️⃣ Birinchi Kanal Sozlamalarini bosing
2️⃣ Keyin adminstrators qatorini bosing
3️⃣ Keyin adminstrators qõshish belgisini bosing!
4️⃣ Keyin qidiruvni bosing bot manzilini kiriting [@xojakamizbot]
5️⃣ Keyin botimiz chiqadi ustiga bosing hammasiga ruxsat berib  VIP Adminstrator qiling

@Aqili_botlar Kanallar uchun foydali loyiha🤟",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   				   [
 ['text'=>"Qoidalar",'callback_data'=>'rules'],['text'=>"Tangalar va Obunachilar",'callback_data'=>'coinandmember']
				   ],
				   				   				   [
['text'=>"Kop beriladigan savollar!",'callback_data'=>'qu'],['text'=>"Nega admin beramiz",'callback_data'=>'whyadmin']
				   ],
				   			   				   				   [
['text'=>"Bot haqida",'callback_data'=>'about'],['text'=>"Botdan foydalanish",'callback_data'=>'howuser']
				   ],
				   			   				   				   [
['text'=>"Qanday botni admin qilamiz",'callback_data'=>'howadmin']
				   ],
				   [
['text'=>"🔙 Menyu",'callback_data'=>'panel']
				   ],
                     ]
               ])
			   ]);
}
elseif($data=="about"){
		mahdi('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"Bu bot sizning kanalingizga 100% Ozbek obunachilarni taqdim etadi!",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   				   [
['text'=>"Qoidalar",'callback_data'=>'rules'],['text'=>"Tangalar va Obunachilar",'callback_data'=>'coinandmember']
				   ],
				   				   				   [
['text'=>"Kop beriladigan savollar!",'callback_data'=>'qu'],['text'=>"Nega admin beramiz",'callback_data'=>'whyadmin']
				   ],
				   			   				   				   [
['text'=>"Bot haqida",'callback_data'=>'about'],['text'=>"Botdan foydalanish",'callback_data'=>'howuser']
				   ],
				   			   				   				   [
['text'=>"Qanday botni admin qilamiz",'callback_data'=>'howadmin']
				   ],
                     ]
               ])
			   ]);
}
elseif($data=="howuser"){
		mahdi('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"Ushbu botdan qanday foydalanishni bilib oling:

1-Tanga olish
Tangalarni toplash uchun asosiy bot menyusidagi Tanga ishlash tugmasidan foydalaning. Har bir kanaldan keyin botga qaytib, Tekshirish tugmasidan foydalaning.
Agar muammo yuzaga kelsa va ananaviy bolmagan kanal yoki kanallar obuna bolsa va tanga olmasangiz, hisobot tugmasini bosing va keyingi tugmani bosing.

2-Royxatdan otqizish
Tangani qabul qilib taqsimlangandan song, sizning kanalingizga azolarni buyurtma qilish vaqti keladi. Sizning azoligingizni qabul qilish uchun kamida 10 ta tanga bolishi kerak.
 Buyurtma qilingan kanaldagi bot togri ishlashi uchun administrator bolishi kerak, agar bot ochirilsa, buyurtma bekor qilinadi.
📍 Buyurtma beriladigan kanal umumiy kanal b'lishi kerak

3-Referal
📍 Dostlaringizni botga o'zlaringizning maxsus havolalaring bilan taklif qilish orqali tangalarni olishingiz mumkin
Siz taklif qilgan dostlaringiz tomonidan tanga sotib olinsa, 20% sizga tanga sotib olingan miqdorda beradi.

4-Bepul tangalar:
Agar siz botga kiritadigan birinchi shaxs bolsangiz, tanga kodi qiymatini olishingiz mumkin boladi.
📍Tanga kodi @Ref_tv kanalida joylashtirilgan va har bir tanga kodining qiymati administrator tomonidan ornatiladi",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   				   [
['text'=>"Qoidalar",'callback_data'=>'rules'],['text'=>"Tangalar va Obunachilar",'callback_data'=>'coinandmember']
				   ],
				   				   				   [
['text'=>"Kop beriladigan savollar!",'callback_data'=>'qu'],['text'=>"Nega admin beramiz",'callback_data'=>'whyadmin']
				   ],
				   			   				   				   [
['text'=>"Bot haqida",'callback_data'=>'about'],['text'=>"Botdan foydalanish",'callback_data'=>'howuser']
				   ],
				   			   				   				   [
['text'=>"Qanday botni admin qilamiz",'callback_data'=>'howadmin']
				   ],
                     ]
               ])
			   ]);	
}
elseif($data=="code"){
mahdi('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"Maxsus kod yani Bepul tanga bolimiga xush kelibsiz!

Menga @$channelcode  kanaliga yuborilga maxsus kodni yuboring1

📌 Agar siz birinchi bolib menga kodni yuborsangiz bepul tangalar olasiz!

📣 Barcha malumotlar: Qoidalar bolimida!",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"🔙 Menyu",'callback_data'=>'panel'],['text'=>"🚦 Qoidalar",'callback_data'=>'help']
				   ],
                     ]
               ])
			   ]);	
$cuser["userfild"]["$fromid"]["file"]="takecodecoin";
$cuser = json_encode($cuser,true);
file_put_contents("data/$fromid.json",$cuser);
}
elseif ($juser["userfild"]["$from_id"]["file"] == 'takecodecoin') {
$code = $user["codecoin"];
if ($textmassage == $code) {
$coincode = $user["howcoincode"];
         mahdi('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"Tabriklayman!

Siz $coincode tanga yutib oldingiz!",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"🔙 Menyu",'callback_data'=>'panel']
				   ],
                     ]
               ])
 ]);
          mahdi('sendmessage',[
        	'chat_id'=>"@$channelcode",
        	'text'=>"😎 Maxsus kod ishlatildi!

✅Nick :  $first_name             ᅠ
✅ID : $from_id

Bot: @$usernamebot",
 ]);
unset($user["codecoin"]);
unset($user["howcoincode"]);
$user = json_encode($user,true);
file_put_contents("data/user.json",$user);
$coin = $juser["userfild"]["$from_id"]["coin"];
$coinplus = $coin + $coincode;
$juser["userfild"]["$from_id"]["coin"]="$coinplus";
$juser["userfild"]["$fromid"]["file"]="none";
$juser = json_encode($juser,true);
file_put_contents("data/$from_id.json",$juser);
}
else
{
	mahdi('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"😔Kod notog`ri yoki uni sizdan oldin ishlatib bõlishgan!

📌 @Ref_tv kanalini doimo kuzatib boring va 1-bõlib kodni yuboring va Tangani oling.",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"🔙 Menyu",'callback_data'=>'panel']
				   ],
                     ]
               ])
 ]);
}
}
elseif($data=="sup"){
mahdi('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"Savollar bolsa yozib qoldiring biz javob berishga xarakat qilamiz!",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"🔙 Menyu",'callback_data'=>'panel']
				   ],
                     ]
               ])
			   ]);	
$cuser["userfild"]["$fromid"]["file"]="sendsup";
$cuser = json_encode($cuser,true);
file_put_contents("data/$fromid.json",$cuser);	
}
elseif ($juser["userfild"]["$from_id"]["file"] == 'sendsup') {
         mahdi('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"Xabar yuborildi javobni kuting1",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"🔙 Menyu",'callback_data'=>'panel']
				   ],
                     ]
               ])
 ]);
mahdi('ForwardMessage',[
'chat_id'=>$Dev[0],
'from_chat_id'=>$chat_id,
'message_id'=>$message_id
]);
}
	elseif($update->message && $update->message->reply_to_message && in_array($from_id,$Dev) && $tc == "private"){
	mahdi('sendmessage',[
        "chat_id"=>$chat_id,
        "text"=>"Sizning xabaringiz foydalanuvchiga yuborildi;"
		]);
	mahdi('sendmessage',[
        "chat_id"=>$reply,
        "text"=>" Sizga admin tomonifan javob keldi:

`$textmassage`",
'parse_mode'=>'MarkDown'
		]);
}
if(file_get_contents("data/$fromid.txt") == "true"){
$pluscoin = file_get_contents("data/".$fromid."coin.txt");
$inviter = $cuser["userfild"]["$fromid"]["inviter"];
$invitercoin = $pluscoin / 100 * 20;
	       mahdi('answercallbackquery', [
            'callback_query_id' =>$membercall,
            'text' => "Добавление купленных монет ...",
            'show_alert' =>false
        ]);
		         mahdi('sendmessage',[
        	'chat_id'=>$inviter,
        	'text'=>"Количество: $invitercoin монет

 Ваши монеты были добавлены к вашим монетам в качестве ресурса покупки",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"🔙 Назад",'callback_data'=>'panel']
				   ],
                     ]
               ])
 ]);
$coin = $cuser["userfild"]["$fromid"]["coin"];
$coinplus = $coin + $pluscoin;
$cuser["userfild"]["$fromid"]["coin"]="$coinplus";
$cuser = json_encode($cuser,true);
file_put_contents("data/$fromid.json",$cuser);
$inuser = json_decode(file_get_contents("data/$inviter.json"),true);
$coininviter = $inuser["userfild"]["$inviter"]["coin"];
$coinplusinviter = $coininviter + $invitercoin ;
$inuser["userfild"]["$inviter"]["coin"]="$coinplusinviter";;
$inuser = json_encode($inuser,true);
file_put_contents("data/$inviter.json",$inuser);
unlink("data/".$fromid."coin.txt");
unlink("data/$fromid.txt");
}
//==============================================================
//panel admin
elseif($textmassage=="/panel" or $textmassage=="panel" or $textmassage=="Admin"){
if ($tc == "private") {
if (in_array($from_id,$Dev)){
mahdi('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"Xush kelibsiz janob admin!",
         'reply_to_message_id'=>$message_id,
	  'reply_markup'=>json_encode([
    'keyboard'=>[
	  	  	 [
		['text'=>"Statistika"],['text'=>"Bloklash"]
     ],
   [
      ['text'=>"Xabar yuborish"],['text'=>"Forward"]
    ],
       [
['text'=>"Buyurtmalar"],['text'=>"Buyurtmani ochirish"]
    ],
           [
['text'=>"Tanga qoshish"],['text'=>"Tanga ushlab qolish"]
    ],
               [
['text'=>"Maxsus kod"],['text'=>"Barchaga tanga yuborish"]
    ],
                       [
['text'=>"Qoshimcha"]
	  ]
   ],
      'resize_keyboard'=>true
   ])
 ]);
}
}
}
elseif($textmassage=="Menyu 🔙"){
if ($tc == "private") {
if (in_array($from_id,$Dev)){
mahdi('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"Menyudamiz:",
         'reply_to_message_id'=>$message_id,
	  'reply_markup'=>json_encode([
    'keyboard'=>[
	  	  	 [
		['text'=>"Statistika"],['text'=>"Bloklash"]
     ],
   [
      ['text'=>"Xabar yuborish"],['text'=>"Forward"]
    ],
       [
['text'=>"Buyurtmalar"],['text'=>"Buyurtmani ochirish"]
    ],
           [
['text'=>"Tanga qoshish"],['text'=>"Tanga ushlab qolish"]
    ],
               [
['text'=>"Maxsus kod"],['text'=>"Barchaga tanga yuborish"]
    ],
                       [
['text'=>"Qoshimcha"]
	  ]
   ],
      'resize_keyboard'=>true
   ])
 ]);
$juser["userfild"]["$from_id"]["file"]="none";
$juser = json_encode($juser,true);
file_put_contents("data/$from_id.json",$juser);		
}
}
}
elseif($textmassage=="Statistika"){
if (in_array($from_id,$Dev)){
$all = count($user["userlist"]);
$order = count($user["channellist"]);
				mahdi('sendmessage',[
		'chat_id'=>$chat_id,
		'text'=>"Botning statistikasi:

 Foydalanuvchilar soni: $all

 Buyurtmalar soni: $order ",
                'hide_keyboard'=>true,
		]);
		}
}
elseif($textmassage=="Bloklash"){
if (in_array($from_id,$Dev)){
				mahdi('sendmessage',[
		'chat_id'=>$chat_id,
		'text'=>"Bloklanadigan foydalanuvchi ID raqamini yuboring;",
   'reply_markup'=>json_encode([
    'keyboard'=>[
	[
	['text'=>"Menyu 🔙"]
	]
   ],
      'resize_keyboard'=>true
   ])
		]);
$juser["userfild"]["$from_id"]["file"]="block";
$juser = json_encode($juser,true);
file_put_contents("data/$from_id.json",$juser);		
		}
}
elseif ($juser["userfild"]["$from_id"]["file"] == 'block') {
if ($textmassage != "Назад 🔙") {
if ($forward_from == true) {
         mahdi('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"Foydalanuvchi bloklandi;

Malumot: $forward_from_id
Username: @$forward_from_username",
	  'reply_to_message_id'=>$message_id,
 ]);
$juser["blocklist"][]="$forward_from_id";
$juser["userfild"]["$from_id"]["file"]="none";
$juser = json_encode($juser,true);
file_put_contents("data/$from_id.json",$juser);	
}
else
{
	         mahdi('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"Bloklandi!;

Malumot: $textmassage",
	  'reply_to_message_id'=>$message_id,
 ]);
$juser["blocklist"][]="$textmassage";
$juser["userfild"]["$from_id"]["file"]="none";
$juser = json_encode($juser,true);
file_put_contents("data/$from_id.json",$juser);	
}
}
}
elseif ($textmassage == 'Xabar yuborish' ) {
if (in_array($from_id,$Dev)){
         mahdi('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"Matn yuboring!;",
	  'reply_to_message_id'=>$message_id,
	   'reply_markup'=>json_encode([
    'keyboard'=>[
	[
	['text'=>"Menyu 🔙"]
	]
   ],
      'resize_keyboard'=>true
   ])
 ]);
$juser["userfild"]["$from_id"]["file"]="sendtoall";
$juser = json_encode($juser,true);
file_put_contents("data/$from_id.json",$juser);	
}
}
elseif ($juser["userfild"]["$from_id"]["file"] == 'sendtoall') {
$juser["userfild"]["$from_id"]["file"]="none";
$numbers = $user["userlist"];
$juser = json_encode($juser,true);
file_put_contents("data/$from_id.json",$juser);	
if ($textmassage != "Назад 🔙") {
         mahdi('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"Barchaga yuborildi;",
	  'reply_to_message_id'=>$message_id,
 ]);
for($z = 0;$z <= count($numbers)-1;$z++){
     mahdi('sendmessage',[
          'chat_id'=>$numbers[$z],        
		  'text'=>"$textmassage",
        ]);
}
}
}
elseif ($textmassage == 'Forward' ) {
if (in_array($from_id,$Dev)){
         mahdi('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"Menga forward qiling;",
	  'reply_to_message_id'=>$message_id,
	   'reply_markup'=>json_encode([
    'keyboard'=>[
	[
	['text'=>"Menyu 🔙"]
	]
   ],
      'resize_keyboard'=>true
   ])
 ]);
$juser["userfild"]["$from_id"]["file"]="fortoall";
$juser = json_encode($juser,true);
file_put_contents("data/$from_id.json",$juser);		
}
}
elseif ($juser["userfild"]["$from_id"]["file"] == 'fortoall') {
$juser["userfild"]["$from_id"]["file"]="none";
$numbers = $user["userlist"];
$juser = json_encode($juser,true);
file_put_contents("data/$from_id.json",$juser);		
if ($textmassage != "Назад 🔙") {
         mahdi('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"Forward yuborildi;",
	  'reply_to_message_id'=>$message_id,
 ]);
for($z = 0;$z <= count($numbers)-1;$z++){
Forward($numbers[$z], $chat_id,$message_id);
}
}
}
elseif($textmassage=="Buyurtmalar"){
if (in_array($from_id,$Dev)){
$order = $user["channellist"];
$ordercount = count($user["channellist"]);
for($z = 0;$z <= count($order)-1;$z++){
$result = $result.$order[$z]."\n";
}
				mahdi('sendmessage',[
		'chat_id'=>$chat_id,
		'text'=>"Buyurtmalar soni: $ordercount

📌 Buyurtmalar:
$result",
                'hide_keyboard'=>true,
		]);
		}
}
elseif($textmassage=="Buyurtmani ochirish"){
if (in_array($from_id,$Dev)){
				mahdi('sendmessage',[
		'chat_id'=>$chat_id,
		'text'=>"Ochirmoxchi bolgan kanal userini menga yuboring:
Masalan: @$channel",
  'reply_markup'=>json_encode([
    'keyboard'=>[
	[
	['text'=>"Menyu 🔙"]
	]
   ],
      'resize_keyboard'=>true
   ])
		]);
$juser["userfild"]["$from_id"]["file"]="remorder";
$juser = json_encode($juser,true);
file_put_contents("data/$from_id.json",$juser);		
		}
}
elseif ($juser["userfild"]["$from_id"]["file"] == 'remorder') {
if ($textmassage != "Menyu 🔙") {
         mahdi('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"Buyurtma ochirildi",
	  'reply_to_message_id'=>$message_id,
 ]);
$how = array_search($textmassage,$user["channellist"]);
unset($user["setmemberlist"][$how]);
unset($user["channellist"][$how]);
$user["channellist"]=array_values($user["channellist"]); 
$user["setmemberlist"]=array_values($user["setmemberlist"]);
$user = json_encode($user,true);
file_put_contents("data/user.json",$user);  
$juser["userfild"]["$from_id"]["file"]="none";
$juser = json_encode($juser,true);
file_put_contents("data/$from_id.json",$juser);		
}
}
elseif($textmassage=="Tanga qoshish"){
if (in_array($from_id,$Dev)){
				mahdi('sendmessage',[
		'chat_id'=>$chat_id,
		'text'=>"Menga foydalanuvchi ID sini yuboring;",
  'reply_markup'=>json_encode([
    'keyboard'=>[
	[
	['text'=>"Menyu 🔙"]
	]
   ],
      'resize_keyboard'=>true
   ])
		]);
$juser["userfild"]["$from_id"]["file"]="adminsendcoin";
$juser = json_encode($juser,true);
file_put_contents("data/$from_id.json",$juser);	
		}
}
elseif ($juser["userfild"]["$from_id"]["file"] == 'adminsendcoin') {
if ($textmassage != "Назад 🔙") {
if ($forward_from == true) {
         mahdi('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"Foydalanuvchi topildi!;

ID: $forward_from_id
USERNAME: @$forward_from_username

📍Yuboriladigan tangalar sonini menga yuboring!",
	  'reply_to_message_id'=>$message_id,
	   'reply_markup'=>json_encode([
    'keyboard'=>[
	[
	['text'=>"Menyu 🔙"]
	]
   ],
      'resize_keyboard'=>true
   ])
 ]);
$juser["idforsend"]="$forward_from_id";
$juser["userfild"]["$from_id"]["file"]="sethowsendcoin";
$juser = json_encode($juser,true);
file_put_contents("data/$from_id.json",$juser);	
}
else
{
	         mahdi('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"Yuboriladigan tangalar sonini kiriting

Tangalar soni: $textmassage",
	  'reply_to_message_id'=>$message_id,
	   'reply_markup'=>json_encode([
    'keyboard'=>[
	[
	['text'=>"Menyu 🔙"]
	]
   ],
      'resize_keyboard'=>true
   ])
 ]);
$juser["idforsend"]="$textmassage";
$juser["userfild"]["$from_id"]["file"]="sethowsendcoin";
$juser = json_encode($juser,true);
file_put_contents("data/$from_id.json",$juser);	
}
}
}
elseif ($juser["userfild"]["$from_id"]["file"] == 'sethowsendcoin') {
if ($textmassage != "Назад 🔙") {
$id = $juser["idforsend"];
         mahdi('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"$textmassage tanga $id ga yetkazildi",
	  'reply_to_message_id'=>$message_id,
 ]);
          mahdi('sendmessage',[
        	'chat_id'=>$id,
        	'text'=>"$textmassage tangani adminlar sizga yuborishti!",
			               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"🔙 Menyu",'callback_data'=>'panel']
				   ],
                     ]
               ])
 ]);
$inuser = json_decode(file_get_contents("data/$id.json"),true);
$coin = $inuser["userfild"]["$id"]["coin"];
$coinplus = $coin + $textmassage;
$inuser["userfild"]["$id"]["coin"]="$coinplus";
$inuser = json_encode($inuser,true);
file_put_contents("data/$id.json",$inuser);
}
}
elseif($textmassage=="Tanga ushlab qolish"){
if (in_array($from_id,$Dev)){
				mahdi('sendmessage',[
		'chat_id'=>$chat_id,
		'text'=>"Menga foydalanuvchi ID sini yuboring;",
  'reply_markup'=>json_encode([
    'keyboard'=>[
	[
	['text'=>"Menyu 🔙"]
	]
   ],
      'resize_keyboard'=>true
   ])
		]);
$juser["userfild"]["$from_id"]["file"]="adminsendcoin2";
$juser = json_encode($juser,true);
file_put_contents("data/$from_id.json",$juser);		
		}
}
elseif ($juser["userfild"]["$from_id"]["file"] == 'adminsendcoin2') {
if ($textmassage != "Назад 🔙") {
if ($forward_from == true) {
         mahdi('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"Foydalanuvchi topildi!;

ID: $forward_from_id
USERNAME: @$forward_from_username

Ushlab qolinadigan tangalar sonini menga yuboring",
	  'reply_to_message_id'=>$message_id,
	   'reply_markup'=>json_encode([
    'keyboard'=>[
	[
	['text'=>"Menyu 🔙"]
	]
   ],
      'resize_keyboard'=>true
   ])
 ]);
$juser["idforsend"]="$forward_from_id";
$juser["userfild"]["$from_id"]["file"]="sethowsendcoin2";
$juser = json_encode($juser,true);
file_put_contents("data/$from_id.json",$juser);	
}
else
{
	         mahdi('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"Ushlab qolinadigan tangalar sonini kiriting

Tangalar soni: $textmassage",
	  'reply_to_message_id'=>$message_id,
	   'reply_markup'=>json_encode([
    'keyboard'=>[
	[
	['text'=>"Menyu 🔙"]
	]
   ],
      'resize_keyboard'=>true
   ])
 ]);
$juser["idforsend"]="$textmassage";
$juser["userfild"]["$from_id"]["file"]="sethowsendcoin2";
$juser = json_encode($juser,true);
file_put_contents("data/$from_id.json",$juser);	
}
}
}
elseif ($juser["userfild"]["$from_id"]["file"] == 'sethowsendcoin2') {
if ($textmassage != "Menyu 🔙") {
$id = $juser["idforsend"];
         mahdiphp('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"$textmassage tanga $id dan ushlab qolindi",
	  'reply_to_message_id'=>$message_id,
 ]);
          mahdi('sendmessage',[
        	'chat_id'=>$id,
        	'text'=>"$textmassage sizdan ushlab qolindi.",
			               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"🔙 Menyu",'callback_data'=>'panel']
				   ],
                     ]
               ])
 ]);
$inuser = json_decode(file_get_contents("data/$id.json"),true);
$coin = $inuser["userfild"]["$id"]["coin"];
$coinplus = $coin - $textmassage;
$inuser["userfild"]["$id"]["coin"]="$coinplus";
$inuser = json_encode($inuser,true);
file_put_contents("data/$id.json",$inuser);
}
}
elseif($textmassage=="КодМонеты"){
if (in_array($from_id,$Dev)){
				mahdi('sendmessage',[
		'chat_id'=>$chat_id,
		'text'=>"     Maxsus kodni kiriting1
Kod [@$channelcode] ga yuboriladi",
  'reply_markup'=>json_encode([
    'keyboard'=>[
	[
	['text'=>"Menyu 🔙"]
	]
   ],
      'resize_keyboard'=>true
   ])
		]);
$juser["userfild"]["$from_id"]["file"]="setcodecoin";
$juser = json_encode($juser,true);
file_put_contents("data/$from_id.json",$juser);	
		}
}
elseif ($juser["userfild"]["$from_id"]["file"] == 'setcodecoin') {
if ($textmassage != "Назад 🔙") {
         mahdi('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"Nechi tanga oynamoxchisiz?",
	  'reply_to_message_id'=>$message_id,
 ]);
$user["codecoin"]="$textmassage";
$user = json_encode($user,true);
file_put_contents("data/user.json",$user);
$juser["userfild"]["$from_id"]["file"]="howcodecoin";
$juser = json_encode($juser,true);
file_put_contents("data/$from_id.json",$juser);	
}
}
elseif ($juser["userfild"]["$from_id"]["file"] == 'howcodecoin') {
if ($textmassage != "Назад 🔙") {
$code = $user["codecoin"];
         mahdi('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"📍Maxsus kod @$channelcode ga yuborildi!!",
	  'reply_to_message_id'=>$message_id,
 ]);
          mahdi('sendmessage',[
        	'chat_id'=>"@$channelcode",
        	'text'=>"🎉Siz uchun MAXSUS KOD!🎉
🔆 Kod homiysi @ReferalNo_1   ⤵️

👑 Kod: $code

💰Tangalar soni: $textmassage


🤖 Kodni botga yuboring!👉: @$usernamebot",
 ]);
$user["howcoincode"]="$textmassage";
$user = json_encode($user,true);
file_put_contents("data/user.json",$user);
$juser["userfild"]["$from_id"]["file"]="none";
$juser = json_encode($juser,true);
file_put_contents("data/$from_id.json",$juser);	
}
}
elseif ($textmassage == 'Barchaga tanga yuborish' ) {
if (in_array($from_id,$Dev)){
         mahdi('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"Nechi tanga yubormoxchisiz?",
	  'reply_to_message_id'=>$message_id,
	   'reply_markup'=>json_encode([
    'keyboard'=>[
	[
	['text'=>"Menyu 🔙"]
	]
   ],
      'resize_keyboard'=>true
   ])
 ]);
$juser["userfild"]["$from_id"]["file"]="sendcointoall";
$juser = json_encode($juser,true);
file_put_contents("data/$from_id.json",$juser);		
}
}
elseif ($juser["userfild"]["$from__id"]["file"] == 'sendcointoall') {
$juser["userfild"]["$from_id"]["file"]="none";
$juser = json_encode($juser,true);
file_put_contents("data/$from_id.json",$juser);
if ($textmassage != "Menyu 🔙") {
$numbers = $user["userlist"];
         mahdi('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"Umumiy tanga yuborildi",
	  'reply_to_message_id'=>$message_id,
 ]);
for($z = 0;$z <= count($numbers)-1;$z++){
   mahdi('sendmessage',[
          'chat_id'=>$numbers[$z],
		  'text'=>"SAAALOOM!

💰 $textmassage tangani sizga admin yubordi!",
          'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"🔙 Menyu",'callback_data'=>'panel']
				   ],
                     ]
               ])
        ]);
$juser = json_decode(file_get_contents("data/$numbers[$z].json"),true);
$coin = $juser["userfild"]["$numbers[$z]"]["coin"];
$coinplus = $coin + $textmassage;
$juser["userfild"]["$numbers[$z]"]["coin"]="$coinplus";
$juser = json_encode($juser,true);
file_put_contents("data/$numbers[$z].json",$juser);
}
}
}
elseif($update->message->text != true){
	mahdi('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"Iltimos, faqat bot tugmalaridan foydalaning

Tugmalarni korish uchun /start-ni bosing",
	  	]);
}
elseif ($textmassage == 'Qoshimcha' ) {
if (in_array($from_id,$Dev)){
         mahdi('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"Men chunmadm...",
	  'reply_to_message_id'=>$message_id,
 ]);
$user = (file_get_contents("data/user.json"));
file_put_contents("data/backup.json",$user);
}
}
unlink("error_log");

?>
