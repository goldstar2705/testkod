<?php
ob_start();


define('API_KEY','1192617124:AAHVjATs1DUsGJvh_JH6TAz-yjNVRajsfc0');

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
//-------------------------------------//
$Dev = array("669114984"); //
$usernamebot = "Add_membersChannelBot";
$channel = "Telememberchannel";
$channelcode = "member_coin";
$web = "https://lordmizban.ir/Mrbertbot";
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
// ======================================================================
$forchannel = json_decode(file_get_contents("https://api.telegram.org/bot".$token."/getChatMember?chat_id=@".$channel."&user_id=".$from_id));
$tch = $forchannel->result->status;
$forchannelq = json_decode(file_get_contents("https://api.telegram.org/bot".$token."/getChatMember?chat_id=@".$channel."&user_id=".$fromid));
$tchq = $forchannelq->result->status;
//================================================================================================//
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
mkdir("data");
mkdir("ref_tv");
    }
//=================================================================
if(in_array($from_id, $user["blocklist"])) {
mahdi('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"Sen botdan foydalana olmaysan! Blockdasan!",
'reply_markup'=>json_encode(['KeyboardRemove'=>[
],'remove_keyboard'=>true
])
    		]);
}
if($textmassage=="/static" && $tc == "private"){	
if(in_array($from_id, $user["userlist"]) == true) {
$all = count($user["userlist"]);
$order = count($user["channellist"]);
mahdi('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"🤖 Statistika: 
		
📌Hamma userlar $all ta

📌Hamma kanallar: $order ta",
		]);
		}
}
if($textmassage=="/start" && $tc == "private"){	
if(in_array($from_id, $user["userlist"]) == true) {
mahdi('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"$first_name Botning asosiy menyusi ga xush kelibsiz

🔻 Quyidagi tugmalardan foydalaning",
   	'reply_markup'=>json_encode([
  	'inline_keyboard'=>[
   [
   ['text'=>"💰Tanga yig`ish",'callback_data'=>'takecoin']
   ],
    [
   ['text'=>"👤Odam yig`ish",'callback_data'=>'takemember'],['text'=>"🔖 Profilim",'callback_data'=>'accont']
   ],
   [
   ['text'=>"🗣 Referal ssilka",'callback_data'=>'member'],['text'=>"💳 Tanga sotib olish",'callback_data'=>'bycoin']
   ],
      [
   ['text'=>"↗️ Tangani sovg`a qilish",'callback_data'=>'sendcoin'],['text'=>"📍Buyurtmalar",'callback_data'=>'suporder']
   ],
      [
   ['text'=>"👨‍💻Admin bilan bog'lanish",'callback_data'=>'sup'],['text'=>"🚦Qoidalar",'callback_data'=>'help'],['text'=>"😎Maxsus kod",'callback_data'=>'code']
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
	'text'=>"Salom $first_name botimizga xush kelibsiz 😊
Bu bot orqali siz kanalingizga O'zbek Faol  foydalanuvchilarni qõshib olishingiz mumkin🎖!
Bizda reklama xizmati ham mavjud reklama bermoqchi bo'lsangiz admin bilan bog'laning $
 Botdan tõliq foydalanish uchun @$channel kanalimizga a`zo bõling ",
   	'reply_markup'=>json_encode([
  	'inline_keyboard'=>[
   [
   ['text'=>"💰Tanga yig`ish",'callback_data'=>'takecoin']
   ],
    [
   ['text'=>"👤Odam yig`ish",'callback_data'=>'takemember'],['text'=>"🔖 Profilim",'callback_data'=>'accont']
   ],
   [
   ['text'=>"🗣 Referal ssilka",'callback_data'=>'member'],['text'=>"💳 Tanga sotib olish",'callback_data'=>'bycoin']
   ],
      [
   ['text'=>"↗️ Tangani sovg`a qilish",'callback_data'=>'sendcoin'],['text'=>"📍Buyurtmalar",'callback_data'=>'suporder']
   ],
      [
   ['text'=>"👨‍💻Admin bilan bog'lanish",'callback_data'=>'sup'],['text'=>"🚦Qoidalar",'callback_data'=>'help'],['text'=>"😎Maxsus kod",'callback_data'=>'code']
   ],
  	],
	  	'resize_keyboard'=>true,
  	])
  	]);
$juser = json_decode(file_get_contents("data/$from_id.json"),true);	
$juser["userfild"]["$from_id"]["invite"]="0";
$juser["userfild"]["$from_id"]["coin"]="0";
$juser["userfild"]["$from_id"]["setchannel"]="Mavjud emas";
$juser["userfild"]["$from_id"]["setmember"]="Mavjud emas";
$juser = json_encode($juser,true);
file_put_contents("data/$from_id.json",$juser);
}
}
elseif(strpos($textmassage , '/start ') !== false  ) {
$start = str_replace("/start ","",$textmassage);
if(in_array($from_id, $user["userlist"])) {
mahdi('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"$first_name G`irrom qila olmaysiz shu Hol takrorlansa Botdan Haydalasiz!

🔻 Quyidagi tugmalardan foydalaning",
	   	'reply_markup'=>json_encode([
  	'inline_keyboard'=>[
   [
   ['text'=>"💰Tanga yig`ish",'callback_data'=>'takecoin']
   ],
    [
   ['text'=>"👤Odam yig`ish",'callback_data'=>'takemember'],['text'=>"🔖 Profilim",'callback_data'=>'accont']
   ],
   [
   ['text'=>"🗣 Referal ssilka",'callback_data'=>'member'],['text'=>"💳 Tanga sotib olish",'callback_data'=>'bycoin']
   ],
      [
   ['text'=>"↗️ Tangani sovg`a qilish",'callback_data'=>'sendcoin'],['text'=>"📍Buyurtmalar",'callback_data'=>'suporder']
   ],
      [
   ['text'=>"👨‍💻Admin bilan bog'lanish",'callback_data'=>'sup'],['text'=>"🚦Qoidalar",'callback_data'=>'help'],['text'=>"😎Maxsus kod",'callback_data'=>'code']
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
$coinplus = $coin  + 1;
	mahdi('sendmessage',[
	'chat_id'=>$start,
	'text'=>"Siz botga taklif qildingiz va sizga 1 tanga berildi✔️

 👤 Jami tõplagan referallaringiz: $memberplus ta
💰  Jami tõplagan tangalaringiz: $coinplus tanga",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"🔙Bosh menyu",'callback_data'=>'panel']
				   ],
                     ]
               ])
 ]);
 mahdi('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"Salom $first_name botimizga xush kelibsiz 😊
Bu bot orqali siz kanalingiz Uzbek Faol foydalanuvchilar foydalanuvchilar qõshib olishingiz mumkin🎖!
 Botdan tõliq foydalanish uchun @$channel kanalimizga a`zo bõling ",
   	'reply_markup'=>json_encode([
  	'inline_keyboard'=>[
   [
   ['text'=>"💰Tanga yig`ish",'callback_data'=>'takecoin']
   ],
    [
   ['text'=>"👥Buyurtma berish",'callback_data'=>'takemember'],['text'=>"🔖 Profilim",'callback_data'=>'accont']
   ],
   [
   ['text'=>"🗣 Referal ssilka",'callback_data'=>'member'],['text'=>"💳 Tanga sotib olish",'callback_data'=>'bycoin']
   ],
      [
   ['text'=>"↗️ Tangani sovg`a qilish",'callback_data'=>'sendcoin'],['text'=>"📍Buyurtmalar",'callback_data'=>'suporder']
   ],
      [
   ['text'=>"👨‍💻Admin bilan bog'lanish",'callback_data'=>'sup'],['text'=>"🚦Qoidalar",'callback_data'=>'help'],['text'=>"😎Maxsus kod",'callback_data'=>'code']
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
$juser["userfild"]["$from_id"]["setchannel"]="Kiritilmagan!";
$juser["userfild"]["$from_id"]["setmember"]="Kiritilmagan!";
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
            'text' => "📌 Siz @$allchannel[$z] Shu kanalidan chiqib ketdingiz va Sizga 5 tanga jarima solindi! ",
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
               'text'=>"$firstname Botning asosiy menyusiga qaytdingiz!

🔻 Quyidagi tugmalardan foydalaning!",
   	'reply_markup'=>json_encode([
  	'inline_keyboard'=>[
   [
   ['text'=>"💰Tanga yig`ish",'callback_data'=>'takecoin']
   ],
    [
   ['text'=>"👤Odam yig`ish",'callback_data'=>'takemember'],['text'=>"🔖 Profilim",'callback_data'=>'accont']
   ],
   [
   ['text'=>"🗣Referal ssilka",'callback_data'=>'member'],['text'=>"💳 Tanga sotib olish",'callback_data'=>'bycoin']
   ],
      [
   ['text'=>"↗️Tangani sovg`a qilish",'callback_data'=>'sendcoin'],['text'=>"📍 Buyurtmalar",'callback_data'=>'suporder']
   ],
      [
   ['text'=>"👨‍💻Admin bilan bog'lanish",'callback_data'=>'sup'],['text'=>"🚦Qoidalar",'callback_data'=>'help'],['text'=>"😎Maxsus kod",'callback_data'=>'code']
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
               'text'=>"Kanallarga qõshilib 💰Tanga ishlashdan oldin qoidalarni õqib chiqing! Sõng✅ Tanga yigish ni bosib tanga yigishni boshlashingiz mumkin!",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
				   ['text'=>"✅ Tanga yig`ish",'callback_data'=>"takecoin"],['text'=>"🔙 Bosh menyu",'callback_data'=>'panel']
				   ],
[
				   ['text'=>"🚦 Qoidalar",'callback_data'=>'help']
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
               'text'=>"🎉 Ajoyib imkoniyat 🎉

Bot sizga taqdim qilgan kanallarga qõshilib tanga ishlashingiz mumkin, Kanallarga azo bõlib botdan 💰Tekshirish tugmasi orqali azo bõlganingizni tekshirsangiz azo bõlgan bõlsangiz bot sizga avtomatik 3 tanga beradi!

‼️ Diqqat agar kanalga azo bõlib tangani ham olib kanaldan chiqib ketsangiz sizga 5 tanga jarima solinadi!

 📣 Va bundan tashqari maxsus  kodni Kanalimizdan bepul olishingiz ham mumkin!

1 ta maxsus kodni takroran ishlatish mumkin emas,
Kanalni kuzatib borsangiz har kuni kod tashlanadi yana bir imkoniyat bõladi!

E esdan kõtarilibdiku siz avval meni Yaratgan Insonlar kanaliga azo bõlishingiz kerak sõng tanga ishlay olasiz!",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
				   ['text'=>"📣 Kanal",'url'=>"https://t.me/$channel"],['text'=>"👤Mening kanalim",'callback_data'=>'mainchannel']
				   ],
				   [
				   ['text'=>"💰Tekshirish",'callback_data'=>'takecoin'],['text'=>"🔙 Bosh menyu",'callback_data'=>'panel']
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
               'text'=>"📣Kanal haqida
 📍Kanal nomi: $name
📍 Kanal Useri: @$username
📌 Kanal ID raqami : $id	
🔗 Kanal Ma`lumoti : $description

Ushbu kanalga azo bõling! 
Sõng botga qaytib kelib 💰Tekshirish tugmasini bosing!

Agarda Kanalni 18+ ga asoslangan yomon deb topsangiz 🛑 Yomon kanal tugmasini bosing va u kanal adminga yuboriladi! ",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
				   ['text'=>"📣 Kanal",'url'=>"https://t.me/$username"],['text'=>"💰 Tõg`ri kanal",'callback_data'=>'truechannel']
				   ],
				   [
				   ['text'=>"➡️ Keyingi kanal",'callback_data'=>'nextchannel'],['text'=>"🔙Bosh menyu",'callback_data'=>'panel']
				   ],
				   				   [
				   ['text'=>"🛑 Yomon kanal",'callback_data'=>'badchannel']
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
               'text'=>"📍 Boshqa kanal qolmadi! Birozdan qayta urunib kõring!",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
				   ['text'=>"🔄 Qayta urunish",'callback_data'=>'takecoin'],['text'=>"🔙 Bosh menyu",'callback_data'=>'panel']
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
               'text'=>"📣Kanal haqida
 📍Kanal nomi: $name
📍 Kanal Useri: @$username
📌 Kanal ID raqami : $id	
🔗 Kanal Ma`lumoti : $description

Ushbu kanalga azo bõling! 
Sõng botga qaytib kelib 💰Tekshirish tugmasini bosing!

Agarda Kanalni 18+ yoki Teroristlik ga asoslangan yomon deb topsangiz 🛑 Yomon kanal tugmasini bosing va u kanal Adminlar tomonidan kõrib chiqiladi! Agar no õrin  Yomon kanal deb topgan bõlsangiz Sizga 5 tanga jarima solinadi! Agar kanal asosli Yomon kanal bõlsa sizga 5 tanga Sovga qilinadi ",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
				   ['text'=>"📣 Kanal",'url'=>"https://t.me/$username"],['text'=>"💰 Tekshirish",'callback_data'=>'truechannel']
				   ],
				   [
				   ['text'=>"➡️Boshqa Kanal",'callback_data'=>'nextchannel'],['text'=>"🔙 Bosh menyu",'callback_data'=>'panel']
				   ],
				   				   				   [
				   ['text'=>"🛑 Yomon kanal",'callback_data'=>'badchannel']
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
               'text'=>"📍 Hozircha kanal qolmadi! Birozdan sõng qayta urunib kõring",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
				   ['text'=>"🔄 Qayta urunish",'callback_data'=>'takecoin'],['text'=>"🔙 Bosh menyu",'callback_data'=>'panel']
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
            'text' => "😡 A`zo bõlmay turib meni lox qilmoqchimisiz? Tanga yõq❌",
            'show_alert' =>true
        ]);
}
else
{
 mahdi('answercallbackquery', [
            'callback_query_id' =>$membercall,
            'text' => "🎉 Tabriklaymiz sizga 2 tanga berildi🎉",
            'show_alert' =>false
				   ]);
$cuser = json_decode(file_get_contents("data/$fromid.json"),true);
$coin = $cuser["userfild"]["$fromid"]["coin"];
$arraychannel = $cuser["userfild"]["$fromid"]["arraychannel"];
$coinchannel = $user["setmemberlist"];
$channelincoin = $coinchannel[$arraychannel];
$downchannel = $channelincoin - 1;
$pluscoin = $coin + 2;
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
               'text'=>"📣Kanal haqida
 📍Kanal nomi: $name
📍 Kanal Useri: @$username
📌 Kanal ID raqami : $id	
🔗 Kanal Ma`lumoti : $description

Ushbu kanalga azo bõling! 
Sõng botga qaytib kelib 💰Tekshirish tugmasini bosing!

Agarda Kanalni 18+ yoki Teroristlik ga asoslangan yomon deb topsangiz 🛑 Yomon kanal tugmasini bosing va u kanal Adminlar tomonidan kõrib chiqiladi! Agar no õrin  Yomon kanal deb topgan bõlsangiz Sizga 5 tanga jarima solinadi! Agar kanal asosli Yomon kanal bõlsa sizga 5 tanga Sovga qilinadi ",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
				   ['text'=>"📣 Kanal",'url'=>"https://t.me/$username"],['text'=>"💰 Tekshirish",'callback_data'=>'truechannel']
				   ],
				   [
				   ['text'=>"➡️Boshqa Kanal",'callback_data'=>'nextchannel'],['text'=>"🔙 Bosh menyu",'callback_data'=>'panel']
				   ],
				   				   				   [
				   ['text'=>"🛑 Yomon kanal",'callback_data'=>'badchannel']
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
               'text'=>"📍 Hozircha kanallar tugadi! Birozdan sõng qayta urunib kõring",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
				   ['text'=>"🔄 Qayta urunish",'callback_data'=>'takecoin'],['text'=>"🔙 Bosh menyu",'callback_data'=>'panel']
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
               'text'=>"📣Kanal haqida
 📍Kanal nomi: $name
📍 Kanal Useri: @$username
📌 Kanal ID raqami : $id	
🔗 Kanal Ma`lumoti : $description

Ushbu kanalga azo bõling! 
Sõng botga qaytib kelib 💰Tekshirish tugmasini bosing!

Agarda Kanalni 18+ yoki Teroristlik ga asoslangan yomon deb topsangiz 🛑 Yomon kanal tugmasini bosing va u kanal Adminlar tomonidan kõrib chiqiladi! Agar no õrin Yomon kanal deb topgan bõlsangiz Sizga 5 tanga jarima solinadi! Agar kanal asosli Yomon kanal bõlsa sizga 5 tanga Sovga qilinadi !",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
				   ['text'=>"📣 Kanal",'url'=>"https://t.me/$username"],['text'=>"💰 Tekshirish",'callback_data'=>'truechannel']
				   ],
				   [
				   ['text'=>"➡️Boshqa Kanal",'callback_data'=>'nextchannel'],['text'=>"🔙 Bosh menyu",'callback_data'=>'panel']
				   ],
				   				   				   [
				   ['text'=>"🛑 Yomon kanal",'callback_data'=>'badchannel']
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
               'text'=>"📍 Hozircha kanallar tugadi! Birozdan sõng qayta urunib kõring",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
				   ['text'=>"🔄 Qayta urunish",'callback_data'=>'takecoin'],['text'=>"🔙 Bosh menyu",'callback_data'=>'panel']
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
            'text' => "📌 Kanal Keyingi kanalga õzgartirildi...",
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
               'text'=>"📣Kanal haqida
 📍Kanal nomi: $name
📍 Kanal Useri: @$username
📌 Kanal ID raqami : $id	
🔗 Kanal Ma`lumoti : $description

Ushbu kanalga azo bõling! 
Sõng botga qaytib kelib 💰Tekshirish tugmasini bosing!

Agarda Kanalni 18+ yoki Teroristlik ga asoslangan yomon deb topsangiz 🛑 Yomon kanal tugmasini bosing va u kanal Adminlar tomonidan kõrib chiqiladi! Agar no õrin Yomon kanal deb topgan bõlsangiz Sizga 5 tanga jarima solinadi! Agar kanal asosli Yomon kanal bõlsa sizga 5 tanga Sovga qilinadi ! ",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
				   ['text'=>"📣 Kanal",'url'=>"https://t.me/$username"],['text'=>"💰 Tekshirish",'callback_data'=>'truechannel']
				   ],
				   [
				   ['text'=>"➡️Boshqa Kanal",'callback_data'=>'nextchannel'],['text'=>"🔙 Bosh menyu",'callback_data'=>'panel']
				   ],
				   				   				   [
				   ['text'=>"🛑 Yomon kanal",'callback_data'=>'badchannel']
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
               'text'=>"📍 Hozircha kanallar tugadi! Birozdan sõng qayta urunib kõring",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
				   ['text'=>"🔄 Qayta urunish",'callback_data'=>'takecoin'],['text'=>"🔙 Bosh menyu",'callback_data'=>'panel']
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
            'text' => "😡 A`zo bõlmay turib meni lox qilmoqchimisiz? Tanga yõq❌",
            'show_alert' =>true
        ]);
}
else
{
 mahdi('answercallbackquery', [
            'callback_query_id' =>$membercall,
            'text' =>"🎉 Tabriklaymiz sizga 4 tanga berildi🎉",
            'show_alert' =>false
        ]);
$coin = $cuser["userfild"]["$fromid"]["coin"];
$pluscoin = $coin + 4;
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
               'text'=>"📣Kanal haqida
 📍Kanal nomi: $name
📍 Kanal Useri: @$username
📌 Kanal ID raqami : $id	
🔗 Kanal Ma`lumoti : $description

Ushbu kanalga azo bõling! 
Sõng botga qaytib kelib 💰Tekshirish tugmasini bosing!

Agarda Kanalni 18+ yoki Teroristlik ga asoslangan yomon deb topsangiz 🛑 Yomon kanal tugmasini bosing va u kanal Adminlar tomonidan kõrib chiqiladi! Agar no õrin Yomon kanal deb topgan bõlsangiz Sizga 5 tanga jarima solinadi! Agar kanal asosli Yomon kanal bõlsa sizga 5 tanga Sovga qilinadi ! ",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
				   ['text'=>"📣 Kanal",'url'=>"https://t.me/$username"],['text'=>"💰 Tekshirish",'callback_data'=>'truechannel']
				   ],
				   [
				   ['text'=>"➡️Boshqa Kanal",'callback_data'=>'nextchannel'],['text'=>"🔙 Bosh menyu",'callback_data'=>'panel']
				   ],
				   				   				   [
				   ['text'=>"🛑 Yomon kanal",'callback_data'=>'badchannel']
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
               'text'=>"📍 Hozircha kanallar tugadi! Birozdan sõng qayta urunib kõring",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
				   ['text'=>"🔄 Qayta urunish",'callback_data'=>'takecoin'],['text'=>"🔙 Bosh menyu",'callback_data'=>'panel']
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
            'text' => "📌 Shikoyatingiz Adminga yuborildi! Admin kõrib chiqadi! Agar rostdanham Yomon kanal bõlsa Adminlar sizga 5 ta beradi! Agar Yomon kanal bõlmasa 5 tanga Jarima olasiz!",
            'show_alert' =>true
        ]);
	mahdi('sendmessage',[
	'chat_id'=>$Dev[0],
	'text'=>"⚠️Diqqat @$getjoinchannel ushbu kanal 
	@$usernames tomonidan Yomon kanal deb topildi!🔸Kanalni kõrib chiqing! Agar rostdanham Yomin kanal bõlsa 5 tanga berib quyingda no õrin bõlsa 5 tanga jarima
ID raqami $from_id🔹",
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
               'text'=>"🎫 Siz haqingizdagi ma`lumot:
			   
💰 Tangalaring: $coin tanga
📣Sõngi saqlangan kanalingiz: $setchannel
👤Oxirgi odamlarning soni: $setmember
🗣 Referallaringiz : $invite
📍 Nickingiz: $firstname
📍 Useringiz: @$usernames
📍 ID raqamingiz: $fromid",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   				   [
['text'=>"⭐️ Mening kanalim",'callback_data'=>'mechannel'],['text'=>"💳 Buyurtma",'callback_data'=>'order']
				   ],
				   [
['text'=>"🔙 Bosh menyu",'callback_data'=>'panel']
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
	'text'=>"📍Sizning kanalingiz:
	
$result

Shu kanal",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"🔙 Bosh menyu",'callback_data'=>'panel']
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
	'text'=>"📍Hali hech qanday kanal yõq kanal qõshish uchun tanga to'plash kerak!

Shu bilan bir vaqtda, har bir kanalga qõshilib tanga olishsangiz bo'ladi ",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"🔙 Bosh menyu",'callback_data'=>'panel'],['text'=>"💰 Tanga yig`ish",'callback_data'=>'takecoin']
				   ],
				   ]
            ])           
  	]);		
}
}
elseif($data=="order"){
$allchannel = $cuser["userfild"]["$fromid"]["listorder"];
for($z = 0;$z <= count($allchannel)-1;$z++){
$result = $at.$result."📍 ".$allchannel[$z]." Tugallanmagan!"."\n";
}
if($result == true){
mahdi('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
	'text'=>"📍 Sizning buyurtmalaringiz :

$result

Buyruq ko'rinishi tomosha qilish har bir buyurtma holatini kuzatib borish mumkin📌",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"🔙 Bosh menyu",'callback_data'=>'panel']
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
	'text'=>"Hali ro'yxatdan a'zosi jalb qilish uchun hech qanday kanal mavjud emas 📍 

📌 Siz 30 dan ortiq tanga yigib kanalingizga a'zo buyurtma qilishingiz mumkin! 
💰Tangalar  soni : $coin tanga",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"🔙 Bosh menyu",'callback_data'=>'panel'],['text'=>"👤Buyurtma berish",'callback_data'=>'takemember']
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
	'photo'=>"https://t.me/goldstar_net/24",
	'caption'=>"🎖 @Add_MembersChannelBot

Bu bot orqali kanalingizga Aktiv Faol o'zbek foydalanuvchilar qo'shishingiz mumkin 

Referal ssilkangiz :
https://t.me/$usernamebot?start=$fromid",
    		]);
	mahdi('sendmessage',[
	'chat_id'=>$chatid,
	'text'=>"📍 Yuqoridagi ssilkani Kanallarga Guruhlarga Va Dõstlaringizga yuboring!
	
📍 Sizning referal ssilkangizdan kirgan va oldin bu botdan foydalanmagan har bir dõstingiz uchun 2 tangadan oling!

💰Tõplagan tangalaringiz : $coin tanga
🗣Taklif qilgan dõstlaringiz : $invite ta",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"🔙 Bosh menyu",'callback_data'=>'panel']
				   ],
				   ]
            ])           
  	]);			
}
elseif($data=="sendcoin"){	

mahdi('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
	'text'=>"📍 Siz õz tangangizni yubormoqchi bõlgan dõstingizni Id raqamini yoki biror xabarini menga forward qilib yuboring!

Xisob bõlimida har bir foydalanuvchi tangalari alohida rõyhatga olingan!",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"🔙 Bosh menyu",'callback_data'=>'panel']
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
        	'text'=>"Qabul qilindi✅
			
U haqida malumot:
📍 Nicki : $forward_from_first_name
📍 Usernamesi: @$forward_from_username
📍 ID raqami: $forward_from_id

Endi unga õtkaziladigon tanga sonini yuboring!
💰 Sizda hozir: $coin tanga bor",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"🔙 Bosh Menyu
",'callback_data'=>'panel']
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
        	'text'=>"📍 Õzingizga tanga yuborish mumkin emas !

Boshqa bir foydalanuvchiga tanga yuborish uchun uni xabarini forward qilib yuboring  yoki ID  doimiy faoliyat yurituvchi raqamini yuboring",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"🔙Bosh menyu",'callback_data'=>'panel']
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
        	'text'=>"Qabul qilindi✅
			
U haqida malumot:
📍 Nicki : $name
📍Usernamesi : @$username
📍ID raqami : $id

Endi unga õtkaziladigon tanga sonini yuboring!
💰 Sizda hozir: $coin tanga bor",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"🔙Bosh menyu",'callback_data'=>'panel']
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
        	'text'=>"📍 ID raqam tõgri emas

📌 Diqqat bilan etibor berib yuboring!",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"🔙 Bosh menyu",'callback_data'=>'panel']
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
        	'text'=>"📍 ID kiritilmagan

📌 Diqqat bilan tekshirib yuqori aniqlikda kiriting iltimos",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"🔙 Bosh menyu",'callback_data'=>'panel']
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
        	'text'=>"📍 Õzingizga tanga yuborish mumkin emas !

Boshqa bir foydalanuvchiga tanga yuborish uchun uni xabarini forward qilib yuboring  yoki ID  doimiy faoliyat yurituvchi raqamini yuboring",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"🔙 Bosh menyu",'callback_data'=>'panel']
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
	'text'=>"Tanga õktazish muvaffaqiyat yakunlandi!

📌 Ma'lumotlar :
🔆 ID raqami: $userid
Õtkazilgan tanga soni💰: $textmassage tanga
Sizda qolgan tanga soni💰: $coinplus tanga",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"🔙Bosh menyu",'callback_data'=>'panel']
				   ],
				   ]
            ])           
  	]);	
		mahdi('sendmessage',[
	'chat_id'=>$userid,
	'text'=>"📍Sizga  $textmassage tanga õtkazildi!

📌 Tanga õtkazgan odam :
🔆 ID raqami: $from_id
 👤Õtkazuvchi: @$username",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"🔙 Bosh menyu",'callback_data'=>'panel']
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
	'text'=>"📍Õtkazish uchun yetarli tangalar  yõq 

💰Tangangiz $coin tanga",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"🔙Bosh menyu",'callback_data'=>'panel']
				   ],
				   ]
            ])           
  	]);	
}
}
elseif($data=="suporder"){
$allchannel = $cuser["userfild"]["$fromid"]["listorder"];
for($z = 0;$z <= count($allchannel)-1;$z++){
$result = $at.$result."📍 ".$allchannel[$z]." Yakunlanmagan!"."\n";
}
if($result == true){
mahdi('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"📍 Iltimos  kerakli kanal, va yuborish uchun 

Buyurtma holatini📌, olish
📣Misol : @$channel

➖➖➖➖
📍 Sizning buyurtmalar ro'yhati:

$result",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"🔙Bosh menyu",'callback_data'=>'panel']
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
               'text'=>"Siz hali ham maxsus dosyalanmış bõlishi kerak emas📍 

📌 Birinchi, rekord tartibi",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"🔙 Bosh menyu",'callback_data'=>'panel'],['text'=>"👤 Buyurtma berish",'callback_data'=>'takemember']
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
	'text'=>"🔆 Azo tõplash maqsadida amalga oshirilmoqda 

Sizning ma'lumot  

📍 ID channel : $textmassage
A'zolari qolgan soni📍: $setmember

📌 Har qanday muammoda 12 soatdan keyin faqat qōllab-quvvatlash bilan boglaning!",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"🔙 Bosh menyu",'callback_data'=>'panel']
				   ],
				   ]
            ])           
  	]);	
}
else
{
	mahdi('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"📍Buyurtma bajarildi",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"🔙 Bosh menyu",'callback_data'=>'panel']
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
	'text'=>"📍Bunday yuborish notog`ri hisoblanadi 

📌 Tõgri tushunishga harakat qiling iltimos 
📣Misol : @$channel",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"🔙 Bosh menyu",'callback_data'=>'panel']
				   ],
				   ]
            ])           
  	]);	
}
}
elseif($data=="takemember"){
$coin = $cuser["userfild"]["$fromid"]["coin"];
if($coin >= 20){
mahdi('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"📍Kanal qõshish mumkin! Kanalingiz @ username sini yuboring!
➕ Namuna @$channel",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"🔙Bosh menyu",'callback_data'=>'panel']
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
               'text'=>"📍 Kanal qõshish uchun tanga yetarli emas!
			   
ℹ️  Kanal qõshish uchun eng kamida 20 tanga bõlishi kerak! 

💰Tangalaringiz : $coin tanga",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"🔙 Bosh menyu",'callback_data'=>'panel'],['text'=>"💰 Tanga yig`ish",'callback_data'=>'takecoin']
				   ],
                     ]
               ])
			   ]);	
}
}
elseif ($juser["userfild"]["$from_id"]["file"] == 'setchannel') {
if(preg_match('/^(@)(.*)/s',$textmassage)){
$coin = $juser["userfild"]["$from_id"]["coin"];
$max = $coin / 3;
$maxmember = floor($max);
         mahdi('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"Kanal✅
			
📣 Kanal : $textmassage


ℹ️ Kanalingizga $maxmember ta odam qõshgani tangangiz yetadi!
💰Sizdagi tangalar : $coin tanga

👤 1 ta odam narxi = 3💰Tanga

Kerakli odam sonini yuboring✅ ",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"🔙 Bosh menyu",'callback_data'=>'panel']
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
        	'text'=>"📍Bunday yuborish notõg`ri hisoblanadi, 
➕ Misol 
Telememberchannel emas
 @$channel Shunday",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"🔙 Bosh menyu",'callback_data'=>'panel']
				   ],
                     ]
               ])
 ]);
}
}
elseif ($juser["userfild"]["$from_id"]["file"] == 'setmember') {
$coin = $juser["userfild"]["$from_id"]["coin"];
$setchannel = $juser["userfild"]["$from_id"]["setchannel"];
$max = $coin / 3;
$maxmember = floor($max);
if($maxmember >= $textmassage){
$howmember = getChatMembersCount($setchannel,$token);
$endmember = $howmember + $textmassage;
         mahdi('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"ℹ️ New : 

📣 Kanal: $setchannel
👤 Text: $textmassage
👥 Hozirgi odamlari : $howmember
📌 Qõshilgandan keyingi odamlar: $endmember 

Botni adminlikdan olmang! Agar adminlikdan olsangiz bot kanalingizga odam qõshmaydi!

Kanalingiz malumotlari tõgri bòlsa ✅Tõg`ri tugmasini bosing",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   				   [
['text'=>"✅ Tõg`ri",'callback_data'=>'trueorder']
				   ],
				   [
['text'=>"🔙 Bosh menyu",'callback_data'=>'panel'],['text'=>"🚦 Buyurtmalar",'callback_data'=>'help']
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
        	'text'=>"📍 $maxmember soni yoki undan kõproq yoki kõp azo olishingiz mumkin emas,
 a'zo sonini bir qator bunday kiriting
➕ Misol : 10",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"🔙 Bosh menyu",'callback_data'=>'panel']
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
            'text' => "Bot kanalda adminlar rõyxatiga olinmagan! Admin qilib qayta uruning!",
            'show_alert' =>true
        ]);
}
else
{
mahdi('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"✅Buyurtma muvaffaqiyatli rõyxatdan õtdi

📌 Eslatma Botni kanal adminlari qatoridan olmang!
Buyurtmangiz uzog'i bilan 3kunda bajariladi albatta hozircha
⚠️Qoidalar õqib chiqing bu keyinchalik qiyinchilikga duch kelganingizda sizga yordam beradi",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"🔙Bosh menyu",'callback_data'=>'panel'],['text'=>"🚦Qoidalar",'callback_data'=>'help']
				   ],
                     ]
               ])
			   ]);	
$coin = $cuser["userfild"]["$fromid"]["coin"];
$setchannel = $cuser["userfild"]["$fromid"]["setchannel"];
$setmember = $cuser["userfild"]["$fromid"]["setmember"];
$pluscoin = $setmember * 5;
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
               'text'=>"👤Odam qõshish uchun tanga yetmayabdimi? 💰Tanga sotib olishingiz mumkin!💰Tanga sotib olish uchun 👨‍💻Admin bilan bog`laning",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   				   [
['text'=>"👨‍💻Admin",'url'=>"t.me/GOLD_STARUZ"],['text'=>"🚫Spamlar",'url'=>"t.me/GOLD_STARUZBOT"]
				   ],
				   [
['text'=>"🔙 Bosh menyu",'callback_data'=>'panel']
				   ],
                     ]
               ])
			   ]);	
}
elseif($data=="help"){
		mahdi('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"ℹ️ Bot haqida:
      
🤖 Bot  @GOLD_STARUZ ga tegishli

 Barcha huquqlar himoyalangan! 
Qandaydir muammoga duch kelsangiz adminga murojaat qiling.

🎉 @$channel  - Kanallarni rivojlantiruvchi loyiha!",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   				   [
['text'=>"📍Qonunlar Shartlar",'callback_data'=>'rules'],['text'=>"📍Pul qutisi + Ro`yhatadan o`tish",'callback_data'=>'coinandmember']
				   ],
				   				   				   [
['text'=>"📍Umumiy savollar",'callback_data'=>'qu'],['text'=>"📍Administratsiya qilish",'callback_data'=>'whyadmin']
				   ],
				   			   				   				   [
['text'=>"📍Bot haqida",'callback_data'=>'about'],['text'=>"📍Ishlatish qo`llanmasi",'callback_data'=>'howuser']
				   ],
				   			   				   				   [
['text'=>"📍Bot boshqaruvchi",'callback_data'=>'howadmin']
				   ],
				   [
['text'=>"🔙 Bosh menyu",'callback_data'=>'panel']
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
      
1⃣Agar siz robotga noma'qul bir kanalni rõyxatdan õtkazsangiz, sizning buyurtmangiz ham robot tomonidan bloklanadi

2⃣Agar siz bir necha marta xabar yuborib, robotga spam yuborsangiz robotdan blokirovka qilinasiz

3⃣ Buyurtmani bajarish uchun  + bolishiga bot javobgar emas.

4⃣ Agar tanga notõg'ri uzatilgan bo'lsa, qo'llab-quvvatlash hech qanday javobgarlikni o'z zimmasiga olmaydi, shuning uchun tanga ko'chirishda ehtiyot bo'ling.

5⃣ Ulangan tangalar to'liq avtomatlashtirilsa, biron bir muammoga duch kelsangiz yordamga murojaat qiling",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   				   [
['text'=>"📍Qonunlar Shartlar",'callback_data'=>'rules'],['text'=>"📍Pul qutisi + Ro`yhatadan o`tish",'callback_data'=>'coinandmember']
				   ],
				   				   				   [
['text'=>"📍Umumiy savollar",'callback_data'=>'qu'],['text'=>"📍Administratsiya qilish",'callback_data'=>'whyadmin']
				   ],
				   			   				   				   [
['text'=>"📍Bot haqida",'callback_data'=>'about'],['text'=>"📍Ishlatish qo`llanmasi",'callback_data'=>'howuser']
				   ],
				   			   				   				   [
['text'=>"📍Bot boshqaruvchi",'callback_data'=>'howadmin']
				   ],
				   [
['text'=>"🔙 Bosh menyu",'callback_data'=>'panel']
				   ],
                     ]
               ])
			   ]);	
}
elseif($data=="coinandmember"){
		mahdi('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"ℹ️ ️ Ro'yxatdan:
      
1⃣ Har bir kanalga obuna bo'lish orqali tanga oling
2️⃣ Siz qoshilgan kanaldan chiqib ketsangiz -4 tanga yoqotasiz
3⃣Har bir a'zoni kanalizga qo'shish uchun 2 ta tanga to'lashingiz kerak",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   				   [
['text'=>"📍Qonunlar Shartlar",'callback_data'=>'rules'],['text'=>"📍Pul qutisi + Ro`yhatadan o`tish",'callback_data'=>'coinandmember']
				   ],
				   				   				   [
['text'=>"📍Umumiy savollar",'callback_data'=>'qu'],['text'=>"📍Administratsiya qilish",'callback_data'=>'whyadmin']
				   ],
				   			   				   				   [
['text'=>"📍Bot haqida",'callback_data'=>'about'],['text'=>"📍Ishlatish qo`llanmasi",'callback_data'=>'howuser']
				   ],
				   			   				   				   [
['text'=>"📍Bot boshqaruvchi",'callback_data'=>'howadmin']
				   ],
				   [
['text'=>"🔙 Bosh menyu",'callback_data'=>'panel']
				   ],
                     ]
               ])
			   ]);	
}
elseif($data=="qu"){
		mahdi('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"ℹ️ Kop beriladigam savollar:
      
❓Buyurtmani qancha muddat ichida to'ldirasiz?
❗Bot foydalanuvchilari qanchalik kõp bõlsa shunchalik buyurtma tõldirilishi tezlashadi  shu tufayli buyurtma qanchada tõldirilishiga aniq muddat qõya olmaymiz! Chunki bu foydalanuvchilar Aktiv Uzbek bõladi!

❓Tanga qande sotib olsam boladi?
❗Agar tanga sotib olmoqchi bolsangiz admin bilan boglaning

❓Tangamni kimgadir topshirsam bo'ladimi?
❗Xa, Faqat u odamni sozini  Forward qilib yoki ID raqam orqali amalga oshirilishi mumkin",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   				   [
['text'=>"📍Qonunlar Shartlar",'callback_data'=>'rules'],['text'=>"📍Pul qutisi + Ro`yhatadan o`tish",'callback_data'=>'coinandmember']
				   ],
				   				   				   [
['text'=>"📍Umumiy savollar",'callback_data'=>'qu'],['text'=>"📍Administratsiya qilish",'callback_data'=>'whyadmin']
				   ],
				   			   				   				   [
['text'=>"📍Bot haqida",'callback_data'=>'about'],['text'=>"📍Ishlatish qo`llanmasi",'callback_data'=>'howuser']
				   ],
				   			   				   				   [
['text'=>"📍Bot boshqaruvchi",'callback_data'=>'howadmin']
				   ],
				   [
['text'=>"🔙 Bosh menyu",'callback_data'=>'panel']
				   ],
                     ]
               ])
			   ]);	
}
elseif($data=="whyadmin"){
		mahdi('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"ℹ️❓Nimaga bot adminlar qatoriga o'rnatish kerak?
      
📍 Sizning kanalingizdagi boshqaruvchingiz kanali a'zolaringiz ro'yxatini ko'rish va tanga olishni yoki tanga pasayishini hisoblash uchun administrator bo'lishi kerak.

❗Agar siz botni olib tashlasangiz, buyurtmani bot bekor qiladi va hisobingiz bloklanadi",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   				   [
['text'=>"📍Qonunlar Shartlar",'callback_data'=>'rules'],['text'=>"📍Pul qutisi + Ro`yhatadan o`tish",'callback_data'=>'coinandmember']
				   ],
				   				   				   [
['text'=>"📍Umumiy savollar",'callback_data'=>'qu'],['text'=>"📍Administratsiya qilish",'callback_data'=>'whyadmin']
				   ],
				   			   				   				   [
['text'=>"📍Bot haqida",'callback_data'=>'about'],['text'=>"📍Ishlatish qo`llanmasi",'callback_data'=>'howuser']
				   ],
				   			   				   				   [
['text'=>"📍Bot boshqaruvchi",'callback_data'=>'howadmin']
				   ],
				   [
['text'=>"🔙 Bosh menyu",'callback_data'=>'panel']
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
4️⃣ Keyin qidiruvni bosing bot manzilini kiriting [@WMeMBot]
5️⃣ Keyin botimiz chiqadi ustiga bosing hammasiga ruxsat berib Adminstrator qiling
📍 Axborotlashtirish va telekommunikatsiya texnologiyalari davlat ro'yxatiga Bot nomi joylashgan ekanligini ko'rasiz 

@$channel Kanallar uchun foydali loyiha🤟",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   				   [
['text'=>"📍Qonunlar Shartlar",'callback_data'=>'rules'],['text'=>"📍Pul qutisi + Ro`yhatadan o`tish",'callback_data'=>'coinandmember']
				   ],
				   				   				   [
['text'=>"📍Umumiy savollar",'callback_data'=>'qu'],['text'=>"📍Administratsiya qilish",'callback_data'=>'whyadmin']
				   ],
				   			   				   				   [
['text'=>"📍Bot haqida",'callback_data'=>'about'],['text'=>"📍Ishlatish qo`llanmasi",'callback_data'=>'howuser']
				   ],
				   			   				   				   [
['text'=>"📍Bot boshqaruvchi",'callback_data'=>'howadmin']
				   ],
				   [
['text'=>"🔙 Bosh menyu",'callback_data'=>'panel']
				   ],
                     ]
               ])
			   ]);	
}
elseif($data=="about"){
		mahdi('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"ℹ️ Ushbu robotdan qanday foydalanishni bilib oling:
      
1 tanga oling
Tangalarni to'plash uchun asosiy robot menyusidagi Tanga yigish tugmasidan foydalaning.Har bir kanaldan keyin robotga qaytib, tanga tugmasidan foydalaning.
Agar muammo yuzaga kelsa va an'anaviy bo'lmagan kanal yoki kanallar obuna bo'lsa va tanga olmasangiz, hisobot tugmasini bosing va keyingi tugmani bosing.

Ro'yxatdan bo'lish 2️⃣
Tangani qabul qilib taqsimlangandan so'ng, sizning kanalingizga a'zo bo'lish vaqti keldi. Sizning a'zoligingizni qabul qilish uchun kamida 10 ta tanga bo'lishi kerak.
 Buyurtma qilingan kanaldagi robot to'g'ri ishlashi uchun administrator bo'lishi kerak, agar robot o'chirilsa, buyurtma bekor qilinadi.
📍 Buyurtma beriladigan kanal umumiy kanal bo'lishi kerak

3-bo'lim
📍 Do'stlaringizni robotga o'zlarining maxsus havolalari bilan taklif qilish orqali pullarni olishingiz mumkin
Siz taklif qilayotganlar tomonidan pul sotib olsangiz, 20% sizga Porsche-ni sotib olingan miqdorda beradi.

4- Pulning nomi:
Agar siz robotga kiritadigan birinchi shaxs bo'lsangiz, tanga kodi qiymatini olishingiz mumkin bo'lgan koddir.
📍 Pul kodi @$channel kanalida joylashtirilgan va har bir tanga kodining qiymati administrator tomonidan o'rnatiladi",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   				   [
['text'=>"📍Qonunlar Shartlar",'callback_data'=>'rules'],['text'=>"📍Pul qutisi + Ro`yhatadan o`tish",'callback_data'=>'coinandmember']
				   ],
				   				   				   [
['text'=>"📍Umumiy savollar",'callback_data'=>'qu'],['text'=>"📍Administratsiya qilish",'callback_data'=>'whyadmin']
				   ],
				   			   				   				   [
['text'=>"📍Bot haqida",'callback_data'=>'about'],['text'=>"📍Ishlatish qo`llanmasi",'callback_data'=>'howuser']
				   ],
				   			   				   				   [
['text'=>"📍Bot boshqaruvchi",'callback_data'=>'howadmin']
				   ],
				   [
['text'=>"🔙 Bosh menyu",'callback_data'=>'panel']
				   ],
                     ]
               ])
			   ]);	
}
elseif($data=="howuser"){
		mahdi('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"Botning buyruq va shartlari:
      
1⃣Agar siz robotga noma'qul bir kanalni ro'yxatdan o'tkazsangiz, sizning buyurtmangiz ham robot tomonidan bloklanadi

2⃣Agar siz bir necha marta xabar yuborib, robotga spam yuborsangiz robotdan blokirovka qilinadi

3⃣ Buyurtmani bajarish uchun  + bolishiga bot javobgar emas.

4⃣ Agar tanga noto'g'ri uzatilgan bo'lsa, qo'llab-quvvatlash hech qanday javobgarlikni o'z zimmasiga olmaydi, shuning uchun tanga ko'chirishda ehtiyot bo'ling.

5⃣ Ulangan tangalar to'liq avtomatlashtirilsa, biron bir muammoga duch kelsangiz yordamga murojaat qiling! ",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   				   [
['text'=>"📍Qonunlar Shartlar",'callback_data'=>'rules'],['text'=>"📍Pul qutisi + Ro`yhatadan o`tish",'callback_data'=>'coinandmember']
				   ],
				   				   				   [
['text'=>"📍Umumiy savollar",'callback_data'=>'qu'],['text'=>"📍Administratsiya qilish",'callback_data'=>'whyadmin']
				   ],
				   			   				   				   [
['text'=>"📍Bot haqida",'callback_data'=>'about'],['text'=>"📍Ishlatish qo`llanmasi",'callback_data'=>'howuser']
				   ],
				   			   				   				   [
['text'=>"📍Bot boshqaruvchi",'callback_data'=>'howadmin']
				   ],
				   [
['text'=>"🔙 Bosh menyu",'callback_data'=>'panel']
				   ],
                     ]
               ])
			   ]);	
}
elseif($data=="code"){
mahdi('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"🎖 Xazina kodi bo'limiga xush kelibsiz

@$channelcode yuborilgan tanga kodini yuboring

Pullar kodini to'ldirish va o'chirish yoki biron narsa qo'shmasdan yuborishingiz mumkin

 Qo'llanmada tanga kodi haqida qo'shimcha ma'lumotni ko'ring",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"🔙 Bosh memyu",'callback_data'=>'panel'],['text'=>"📝Qoidalar",'callback_data'=>'help']
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
        	'text'=>"🎉 Muborak bo'lsin qadrdonim🎉

💰Siz 1-bõlib kodni yubordingiz va  $coincode tanga yutib oldingiz!",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"🔙 Bosh Menyu",'callback_data'=>'panel']
				   ],
                     ]
               ])
 ]);
          mahdi('sendmessage',[
        	'chat_id'=>"@$channelcode",
        	'text'=>"😎Maxsus Kod ishlatildi

📍 Va bu koddan qayta foydalanish mumkin emas 

🎖 1-Foydalangan g'olib:

📌Nick : $first_name
📌ID : $from_id
📌Username : $username
🤖  Bot : @$usernamebot",
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

📌 @$channelcode kanalini doimo kuzatib boring va 1-bõlib kodni yuboring va Tangani oling!",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"🔙Bosh Menyu",'callback_data'=>'panel']
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
               'text'=>"🎖 Adminga yozish bõlimizga xush kelibsiz!
               
               Xabaringizni yozing men Adminga yuboraman!",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"🔙Bosh Menyu",'callback_data'=>'panel']
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
        	'text'=>"📍Xabaringiz Adminga Yuborildi",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"🔙 Bosh Menyu",'callback_data'=>'panel']
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
        "text"=>"Sizning xabar yuborildi"
		]);
	mahdi('sendmessage',[
        "chat_id"=>$reply,
        "text"=>" 👤 Bu siz uchun zaxira

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
            'text' => "📍 Tangalar sotib qõshib bor ...",
            'show_alert' =>false
        ]);
		         mahdi('sendmessage',[
        	'chat_id'=>$inviter,
        	'text'=>"💰 Soni : $invitercoin tangalar

📍 Sifatida komissiyasi sotib olish sizdan qo'shilgan edi tangalar uchun",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"🔙 Bosh menyu",'callback_data'=>'panel']
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
elseif($textmassage=="/panel" or $textmassage=="panel" or $textmassage=="flils"){
if ($tc == "private") {
if (in_array($from_id,$Dev)){
mahdi('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"salom Admin bõlimiga xush kelibsiz",
         'reply_to_message_id'=>$message_id,
	  'reply_markup'=>json_encode([
    'keyboard'=>[
	  	  	 [
		['text'=>"📍Stat"],['text'=>"📍Qora rõyhat"]                  
		 ],
 	[
	  	['text'=>"📍Send"],['text'=>"📍For Send"]
	  ],
	   	[
['text'=>"📍List kanal"],['text'=>"📍Del kanal"]
	  ],
	  	   	[
['text'=>"📍Tanga qõshish"],['text'=>"📍Tanga ayrish"]
	  ],
	  	  	   	[
['text'=>"📍Maxsus Kod"],['text'=>"📍Tanga tarqat"]
	  ],
	  	  	  	  	   	[
['text'=>"📍Del Block"]
	  ]
   ],
      'resize_keyboard'=>true
   ])
 ]);
}
}
}
elseif($textmassage=="🔙 Orqaga"){
if ($tc == "private") {
if (in_array($from_id,$Dev)){
mahdi('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"Assalomu alaykum @GOLD_STARUZ  Asosiy bõlimga qaydingiz",
         'reply_to_message_id'=>$message_id,
	  'reply_markup'=>json_encode([
    'keyboard'=>[
	  	  	 [
		['text'=>"📍Stat"],['text'=>"📍Qora rõyhat"]                  
		 ],
 	[
	  	['text'=>"📍Send"],['text'=>"📍For Send"]
	  ],
	   	[
['text'=>"📍List kanal"],['text'=>"📍Del kanal"]
	  ],
	  	   	[
['text'=>"📍Tanga qõshish"],['text'=>"📍Tanga ayrish"]
	  ],
	  	  	   	[
['text'=>"📍Maxsus Kod"],['text'=>"📍Tanga tarqat"]
	  ],
	  	  	  	   	[
['text'=>"📍Del Block"]
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
elseif($textmassage=="📍Stat"){
if (in_array($from_id,$Dev)){
$all = count($user["userlist"]);
$order = count($user["channellist"]);
				mahdi('sendmessage',[
		'chat_id'=>$chat_id,
		'text'=>"🤖 Statistika: 
		
📌Hamma userlar $all ta

📌Hamma kanallar: $order ta",
                'hide_keyboard'=>true,
		]);
		}
}
elseif($textmassage=="📍Qora rõyhat"){
if (in_array($from_id,$Dev)){
				mahdi('sendmessage',[
		'chat_id'=>$chat_id,
		'text'=>"Qora rõyhatga qõshiladigon foydalanuvchi xabarini forward qilib yuboring",
   'reply_markup'=>json_encode([
    'keyboard'=>[
	[
	['text'=>"🔙 Orqaga"] 
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
if ($textmassage != "🔙 Orqaga") {
if ($forward_from == true) {
         mahdi('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"Qabul qilindi✔️

🔹 ID raqami: $forward_from_id
🔸 Usernamesi: @$forward_from_username

📍Endi botdan foydalana olmaydi!",
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
        	'text'=>"U muvaffaqiyat bilan  bloklandi✅

🔹ID : $textmassage",
	  'reply_to_message_id'=>$message_id,
 ]);
$juser["blocklist"][]="$textmassage";
$juser["userfild"]["$from_id"]["file"]="none";
$juser = json_encode($juser,true);
file_put_contents("data/$from_id.json",$juser);	
}
}
}
elseif ($textmassage == '📍Send' ) {
if (in_array($from_id,$Dev)){
         mahdi('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"Xabar matnini kiriting😉",
	  'reply_to_message_id'=>$message_id,
	   'reply_markup'=>json_encode([
    'keyboard'=>[
	[
	['text'=>"🔙 Orqaga"] 
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
if ($textmassage != "🔙 Orqaga") {
         mahdi('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"Xabar hammaga yuborildi✔️",
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
elseif ($textmassage == '📍For Send' ) {
if (in_array($from_id,$Dev)){
         mahdi('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"Xabarni yuboring! Men uni Forward xabar qilib hammaga yuboraman",
	  'reply_to_message_id'=>$message_id,
	   'reply_markup'=>json_encode([
    'keyboard'=>[
	[
	['text'=>"🔙 Orqaga"] 
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
if ($textmassage != "🔙 Orqaga") {
         mahdi('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"Forward xabar hammaga yuborildi✔",
	  'reply_to_message_id'=>$message_id,
 ]);
for($z = 0;$z <= count($numbers)-1;$z++){
Forward($numbers[$z], $chat_id,$message_id);
}
}
}
elseif($textmassage=="📍List kanal"){
if (in_array($from_id,$Dev)){
$order = $user["channellist"];
$ordercount = count($user["channellist"]);
for($z = 0;$z <= count($order)-1;$z++){
$result = $result.$order[$z]."\n";
}
				mahdi('sendmessage',[
		'chat_id'=>$chat_id,
		'text'=>"📍Botga hozir $ordercount ta kanal odam qõshish uchun zakaz bergan
		
Kanallar Username lari
$result",
                'hide_keyboard'=>true,
		]);
		}
}
elseif($textmassage=="📍Del kanal"){
if (in_array($from_id,$Dev)){
				mahdi('sendmessage',[
		'chat_id'=>$chat_id,
		'text'=>"📍 Õchiriladigon Kanal username sini yuboring 
Namuna : @$channel",
  'reply_markup'=>json_encode([
    'keyboard'=>[
	[
	['text'=>"🔙 Orqaga"] 
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
if ($textmassage != "🔙 Orqaga") {
         mahdi('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"Bõldi bu kanal õchirildi✅",
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
elseif($textmassage=="📍Tanga qõshish"){
if (in_array($from_id,$Dev)){
				mahdi('sendmessage',[
		'chat_id'=>$chat_id,
		'text'=>"Tanga qõshiladigon foydalanuvchi xabarini forward qilib yuboring🚀",
  'reply_markup'=>json_encode([
    'keyboard'=>[
	[
	['text'=>"🔙 Orqaga"] 
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
if ($textmassage != "🔙 Orqaga") {
if ($forward_from == true) {
         mahdi('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"Qabul qilindi✔️

🔹 ID raqami: $forward_from_id
🔸 Usernamesi: @$forward_from_username

✅Endi tanga sonini yuboring!",
	  'reply_to_message_id'=>$message_id,
	   'reply_markup'=>json_encode([
    'keyboard'=>[
	[
	['text'=>"🔙 Orqaga"] 
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
        	'text'=>"📍Qabul qilindi
🔹Ushbu foydalanuvchiga $textmassage tanga qõshildi",
	  'reply_to_message_id'=>$message_id,
	   'reply_markup'=>json_encode([
    'keyboard'=>[
	[
	['text'=>"🔙 Orqaga"] 
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
if ($textmassage != "🔙 Orqaga") {
$id = $juser["idforsend"];
         mahdi('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"📍Tanga soni $textmassage tanga!  ID raqami $id",
	  'reply_to_message_id'=>$message_id,
 ]);
          mahdi('sendmessage',[
        	'chat_id'=>$id,
        	'text'=>"📍 Sizga Admin tomonidan $textmassage tanga qõshildi",
			               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"🔙Bosh menyu",'callback_data'=>'panel']
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
elseif($textmassage=="📍Tanga ayrish"){
if (in_array($from_id,$Dev)){
				mahdi('sendmessage',[
		'chat_id'=>$chat_id,
		'text'=>"Tanga ayriladigon foydalanuvchini xabarini menga forward qilib yuboring🚀",
  'reply_markup'=>json_encode([
    'keyboard'=>[
	[
	['text'=>"🔙 Orqaga"] 
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
if ($textmassage != "🔙 Orqaga") {
if ($forward_from == true) {
         mahdi('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"Qabul qilindi✔️

🔹 ID raqami: $forward_from_id
🔸 Usernamesi: @$forward_from_username

📍Endi tanga sonini yuboring!",
	  'reply_to_message_id'=>$message_id,
	   'reply_markup'=>json_encode([
    'keyboard'=>[
	[
	['text'=>"🔙 Orqaga"] 
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
        	'text'=>"📍 Qabul qilindi
🔹Ushbu foydalanuvchidan $textmassage tanga ayrildi",
	  'reply_to_message_id'=>$message_id,
	   'reply_markup'=>json_encode([
    'keyboard'=>[
	[
	['text'=>"🔙 Orqaga"] 
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
if ($textmassage != "🔙 Orqaga") {
$id = $juser["idforsend"];
         mahdiphp('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"📍Tanga soni $textmassage tanga!  ID raqami $id ",
	  'reply_to_message_id'=>$message_id,
 ]);
          mahdi('sendmessage',[
        	'chat_id'=>$id,
        	'text'=>"📍 Sizdan Admin tomonidan $textmassage tanga olib tashlandi",
			               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"🔙Bosh menyu",'callback_data'=>'panel']
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
elseif($textmassage=="📍Maxsus Kod"){
if (in_array($from_id,$Dev)){
				mahdi('sendmessage',[
		'chat_id'=>$chat_id,
		'text'=>"Maxsus kodni kiriting! Maxsus kod Harf Yoki Raqam bõlishi mumkin!🚀
Maxsus kod [@$channelcode] kanalida elon qilinadi! ",
  'reply_markup'=>json_encode([
    'keyboard'=>[
	[
	['text'=>"🔙 Orqaga"] 
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
if ($textmassage != "🔙 Orqaga") {
         mahdi('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"📍 Maxsus kod yaratildi endi tanga sonini kiriring!",
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
if ($textmassage != "🔙 Orqaga") {
$code = $user["codecoin"];
         mahdi('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"📍 Maxsus kod @$channelcode ga yuborildi",
	  'reply_to_message_id'=>$message_id,
 ]);
          mahdi('sendmessage',[
        	'chat_id'=>"@$channelcode",
        	'text'=>"🎉 Do'stlarim maxsus kod yaratildi!🎉
🔆 Kodni oling va shoshiling⤵️

👑Masus kod: $code

💰  Tanga miqdori $textmassage tanga


🤖 Botga kirish👉: @$usernamebot",
 ]);
$user["howcoincode"]="$textmassage";
$user = json_encode($user,true);
file_put_contents("data/user.json",$user);
$juser["userfild"]["$from_id"]["file"]="none";
$juser = json_encode($juser,true);
file_put_contents("data/$from_id.json",$juser);	
}
}
elseif ($textmassage == '📍Tanga tarqat' ) {
if (in_array($from_id,$Dev)){
         mahdi('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"Tanga sonini kiriting! Hammaga tarqatiladi🚀",
	  'reply_to_message_id'=>$message_id,
	   'reply_markup'=>json_encode([
    'keyboard'=>[
	[
	['text'=>"🔙 Orqaga"] 
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
elseif ($juser["userfild"]["$from_id"]["file"] == 'sendcointoall') {
$juser["userfild"]["$from_id"]["file"]="none";
$juser = json_encode($juser,true);
file_put_contents("data/$from_id.json",$juser);	
if ($textmassage != "🔙 Orqaga") {
$numbers = $user["userlist"];
         mahdi('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"$textmessage tanga hammaga tarqatildi✔",
	  'reply_to_message_id'=>$message_id,
 ]);
for($z = 0;$z <= count($numbers)-1;$z++){
   mahdi('sendmessage',[
          'chat_id'=>$numbers[$z],        
		  'text'=>"🎉 Siz uchun maxsus Sovg`a🎉

💰 Sizning hisobingizga @GOLD_STARUZ tomonidan $textmassage tanga qõshildi!",
          'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"🔙Bosh menyu",'callback_data'=>'panel']
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
	'text'=>"Bot guruhlarda ishlamaydi! Botni lichkasiga /start deb yuboring",
	  	]);
}
elseif ($textmassage == '📍Del Block' ) {
if (in_array($from_id,$Dev)){
         mahdi('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"Block ichidagi foydalanuvchilar blockdan olindi",
	  'reply_to_message_id'=>$message_id,
 ]);
$user = (file_get_contents("data/user.json"));
file_put_contents("data/backup.json",$user);	
}
}
unlink("error_log");
/*

*/
?>
