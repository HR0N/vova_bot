<?php


namespace App\Services;




use App\Models\TgGroups;
use Telegram\Bot\Exceptions\TelegramResponseException;
use Telegram\Bot\Exceptions\TelegramSDKException;
use Telegram\Bot\Laravel\Facades\Telegram;

class TgBotClass {

    /**
     * @var \Telegram\Bot\Api
     * @var string
     */
    public $bot;
    public $bot_id;

    public function __construct()
    {
        /*  tg bot sdk get started - https://telegram-bot-sdk.com/docs/getting-started/installation */
        $this->bot = Telegram::bot('olx_bot');
        $this->bot_id = env('TELEGRAM_BOT_ID');   // відстежуваний id. для того, щоб бот розумів що це його додали або видалили з групи\̶к̶а̶н̶а̶л̶у̶
    }


    public function getUpdates(){
        $result = null;
        try {
            $result = $this->bot->getWebhookUpdate();
        } catch (TelegramSDKException $e) {
            $result = $e->getMessage();
        }
        return $result;
    }

    public function bot_add($updates){
        if(isset($updates->new_chat_member->id) && $updates->new_chat_member->id == $this->bot_id){
            $data = [];
            $data['group_title'] = $updates->chat->title;
            $data['group_id'] = $updates->chat->id;
            TgGroups::create($data);
            return true;
        }
        return false;
    }

    public function bot_kick($updates){
        if(isset($updates->left_chat_member->id) && $updates->left_chat_member->id == $this->bot_id){
            $chat_id = $updates->chat->id;
            TgGroups::where('group_id', $chat_id)->delete();
            return true;
        }
        return false;
    }

    public function sendMessage($group_id, $message){
        try {
            $this->bot->sendMessage(['chat_id' => $group_id, 'text' => $message, 'parse_mode' => 'HTML']);
        } catch (TelegramResponseException $exception) {    // TelegramResponseException must be imported
            //continue;
        }
    }

    public function replyMessage($chat_id, $message, $message_id){
        try {
            $this->bot->sendMessage(['chat_id' => $chat_id, 'text' => $message, 'reply_to_message_id' => $message_id, 'parse_mode' => 'HTML']);
        } catch (TelegramResponseException $exception) {    // TelegramResponseException must be imported
            //continue;
        }
    }

    public function sendMessage_mark($chat_id, $message, $keyboard){
        try {
            $this->bot->sendMessage(['chat_id' => $chat_id, 'text' => $message, 'reply_markup' => $keyboard,
                'parse_mode' => 'HTML']);
        } catch (TelegramResponseException $exception) {    // TelegramResponseException must be imported
            //continue;
        }
    }
}
