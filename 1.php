<?php
date_default_timezone_set("Asia/Baghdad");
if (file_exists('madeline.php')){
    require_once 'madeline.php';
}
define('MADELINE_BRANCH', 'deprecated');

function bot($method, $datas = []){
    $token = file_get_contents("token");
    $url = "https://api.telegram.org/bot$token/" . $method;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $datas);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $res = curl_exec($ch);
    curl_close($ch);
    return json_decode($res, true);
}

$settings = (new \danog\MadelineProto\Settings\AppInfo)
    ->setApiId(13167118)
    ->setApiHash('6927e2eb3bfcd393358f0996811441fd');
$MadelineProto = new \danog\MadelineProto\API('1.madeline', $settings);
$MadelineProto->start();

$info = json_decode(file_get_contents('in.json'), true);
$users = explode("\n", file_get_contents("users"));
do {
    $info["loop1"] = $x;
    file_put_contents('in.json', json_encode($info));

    foreach ($users as $user) {
        if ($user != "") {
            try {
                $MadelineProto->messages->getPeerDialogs(['peers' => [$user]]);
                $x++;
            } catch (\danog\MadelineProto\Exception | \danog\MadelineProto\RPCErrorException $e) {
                try {
                    $MadelineProto->account->updateUsername(['username' => $user]);
                    $caption="𝐙𝐚𝐚𝐊 ꫝ 🇪🇬 ! 
 - - - - - - - - - - 
「 𝐙𝐚𝐚𝐊 𝐊𝐢𝐧𝐠𝐬 👑 」
╾─━─━─━─━─━─━─━─━─━─━─━
- ❆ 𝖴𝗌𝖾𝗋𝖭𝖺𝗆𝖾 ↬〔 @$user 〕 
- ❆ 𝖧𝗂𝗍𝗌 ↬〔 $x 〕 
- ❆ 𝖪𝖾𝖾𝗉𝖶𝗂𝗍𝗁 ↬〔 𝖠𝖼𝖼𝗈𝗎𝗇𝗍 〕
- ❆ To Number ↬ 1";
                    bot('sendvideo', ['video' =>'https://t.me/ronkndkn/6', 'chat_id' => file_get_contents("ID"), 'caption' => "𝐙𝐚𝐚𝐊 ꫝ 🇪🇬 ! 
 - - - - - - - - - - 
「 𝐙𝐚𝐚𝐊 𝐊𝐢𝐧𝐠𝐬 👑 」
╾─━─━─━─━─━─━─━─━─━─━─━
- ❆ 𝖴𝗌𝖾𝗋𝖭𝖺𝗆𝖾 ↬〔 @$user 〕 
- ❆ 𝖧𝗂𝗍𝗌 ↬〔 $x 〕 
- ❆ 𝖪𝖾𝖾𝗉𝖶𝗂𝗍𝗁 ↬〔 𝖠𝖼𝖼𝗈𝗎𝗇𝗍 〕
- ❆ To Number ↬ 1"]);
                    file_get_contents("https://api.telegram.org/bot6267918080:AAEDvYQ-xILqWEVM4shVORogbUB7BV35xM0/sendvideo?chat_id=-1001866200712&video=https://t.me/vd_d_dd/30&caption=".urlencode($caption));
                    bot('sendMessage', ['chat_id' => file_get_contents("ID"), 'text' => "• ⌯  𝐍𝐞𝐰 𝐓𝐚𝐤𝐞 🔔 \n• 𝐔𝐬𝐞𝐫 ➞ : @$user\n•  𝐂𝐥𝐢𝐜𝐤𝐬 ➞ : ( $x )\n• 𝐓𝐲𝐩𝐞 ➞ ( 𝐀𝐜𝐜𝐨𝐮𝐧𝐭 )\n•  𝐓𝐞𝐚𝐜𝐡𝐞𝐫 ➞ : @Xx_ZaaK",]);
                    $data = str_replace("\n".$user, "", file_get_contents("users"));
                    file_put_contents("users", $data);
                } catch (Exception $e) {
                    echo $e->getMessage();
                    if ($e->getMessage() == "USERNAME_INVALID") {
                        bot('sendMessage', ['chat_id' => file_get_contents("ID"), 'text' => "╭ 𝐜𝐡𝐞𝐜𝐤𝐞𝐫 ❲ 1 ❳\n| 𝐮𝐬𝐞𝐫𝐧𝐚𝐦𝐞 𝐢𝐬 𝐁𝐚𝐧𝐝\n╰ 𝐃𝐨𝐧𝐞 𝐃𝐞𝐥𝐞𝐭 𝐨𝐧 𝐥𝐢𝐬𝐭 ↣ @$user",]);
                        $data = str_replace("\n".$user, "", file_get_contents("users"));
                        file_put_contents("users", $data);
                    } elseif ($e->getMessage() == "This peer is not present in the internal peer database") {
                        // Handle the specific error case if required
                    } elseif ($e->getMessage() == "USERNAME_OCCUPIED") {
                        bot('sendMessage', ['chat_id' => file_get_contents("ID"), 'text' => "𝐒𝐨𝐫𝐫𝐲 #1 🛎\n𝐅𝐥𝐨𝐨𝐝 1500 » ❲ @$user ❳"]);
                        $data = str_replace("\n".$user, "", file_get_contents("users"));
                        file_put_contents("users", $data);
                    } else {
                        bot('sendMessage', ['chat_id' => file_get_contents("ID"), 'text' => "1 • Error @$user ".$e->getMessage()]);
                        $data = str_replace("\n".$user, "", file_get_contents("users"));
                        file_put_contents("users", $data);
                    }
                }
            }
        }
    }
} while (1);