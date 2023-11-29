<?php

namespace App\Http\Controllers;

use App\Services\ParsingClass;
use App\Services\TgBotClass;
use Illuminate\Http\Request;
use Telegram\Bot\Exceptions\TelegramSDKException;
use Telegram\Bot\Laravel\Facades\Telegram;

class TgBotController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return 'test';
    }

    /*
        only POST methods allowed
        bot settings => config => telegram.php
        add exception in VerifyCsrfToken, example - https://stackoverflow.com/questions/46266553/why-does-the-laravel-api-return-a-419-status-code-on-post-and-put-methods
        hooks - https://stackoverflow.com/questions/42554548/how-to-set-telegram-bot-webhook
        405 Method Not Allowed - https://github.com/irazasyed/telegram-bot-sdk/issues/719
        hook info - https://api.telegram.org/bot<your_token>/getWebhookInfo
        set webhook - https://api.telegram.org/bot<your_token>/setWebHook?url=<hook_url>
        custom set webhook / bot stopped - https://api.telegram.org/bot<your_token>/setWebHook?url=<hook_url>&allowed_updates=["callback_query","message"]
        remove webhook - https://api.telegram.org/bot<token>/setWebhook?remove
        getWebHookUpdates - https://api.telegram.org/bot<bot token>/getUpdates
        основной пункт - сказать волшебное слово
    */
    public function bot_hook()
    {
        $botClass = new TgBotClass();
        $botClass->bot = Telegram::bot('olx_bot');
        $updates = $botClass->getUpdates()->getMessage();


        $chat_id = $updates->chat->id;
//        $bot_added = $botClass->bot_add($updates) ? "success" : 'error';
//        $bot_kicked = $botClass->bot_kick($updates) ? "success" : 'error';

        $botClass->sendMessage($chat_id, strval($chat_id));
    }
    public function bot_hook2()
    {
        $botClass = new TgBotClass();
        $botClass->bot = Telegram::bot('olx_bot2');
        $updates = $botClass->getUpdates()->getMessage();


        $text = $updates->text;
        $chat_id = $updates->chat->id;
        $message_id = $updates->message_id;

        if (strpos($text, 'Bemowo') !== false || strpos($text, 'Bemowo') !== false) {
            $botClass->forwardMessage(env('TELEGRAM_GROUP_ID_BEMOWO'), $chat_id, $message_id);
        }
        if (strpos($text, 'Białołęka') !== false || strpos($text, 'Bialolelka') !== false) {
            $botClass->forwardMessage(env('TELEGRAM_GROUP_ID_BIALOLEKA'), $chat_id, $message_id);
        }
        if (strpos($text, 'Bielany') !== false || strpos($text, 'Bielany') !== false) {
            $botClass->forwardMessage(env('TELEGRAM_GROUP_ID_BIELANY'), $chat_id, $message_id);
        }
        if (strpos($text, 'Mokotów') !== false || strpos($text, 'Mokotow') !== false) {
            $botClass->forwardMessage(env('TELEGRAM_GROUP_ID_MOKOTOW'), $chat_id, $message_id);
        }
        if (strpos($text, 'Ochota') !== false || strpos($text, 'Ochota') !== false) {
            $botClass->forwardMessage(env('TELEGRAM_GROUP_ID_OCHOTA'), $chat_id, $message_id);
        }
        if (strpos($text, 'Praga-Południe') !== false || strpos($text, 'Praga-Poludnie') !== false) {
            $botClass->forwardMessage(env('TELEGRAM_GROUP_ID_PRAGA_POLUDNIE'), $chat_id, $message_id);
        }
        if (strpos($text, 'Praga-Północ') !== false || strpos($text, 'Praga-Polnoc') !== false) {
            $botClass->forwardMessage(env('TELEGRAM_GROUP_ID_PRAGA_POLNOC'), $chat_id, $message_id);
        }
        if (strpos($text, 'Rembertów') !== false || strpos($text, 'Rembertow') !== false) {
            $botClass->forwardMessage(env('TELEGRAM_GROUP_ID_REMBERTOW'), $chat_id, $message_id);
        }
        if (strpos($text, 'Targówek') !== false || strpos($text, 'Targowec') !== false) {
            $botClass->forwardMessage(env('TELEGRAM_GROUP_ID_TARGOWEK'), $chat_id, $message_id);
        }
        if (strpos($text, 'Ursus') !== false || strpos($text, 'Ursus') !== false) {
            $botClass->forwardMessage(env('TELEGRAM_GROUP_ID_URSUS'), $chat_id, $message_id);
        }
        if (strpos($text, 'Ursynów') !== false || strpos($text, 'Ursynow') !== false) {
            $botClass->forwardMessage(env('TELEGRAM_GROUP_ID_URSYNOW'), $chat_id, $message_id);
        }
        if (strpos($text, 'Wola') !== false || strpos($text, 'Wola') !== false) {
            $botClass->forwardMessage(env('TELEGRAM_GROUP_ID_WOLA'), $chat_id, $message_id);
        }
        if (strpos($text, 'Wesoła') !== false || strpos($text, 'Wesola') !== false) {
            $botClass->forwardMessage(env('TELEGRAM_GROUP_ID_WESOLA'), $chat_id, $message_id);
        }
        if (strpos($text, 'Włochy') !== false || strpos($text, 'Wlochy') !== false) {
            $botClass->forwardMessage(env('TELEGRAM_GROUP_ID_WLOCHY'), $chat_id, $message_id);
        }
        if (strpos($text, 'Wilanów') !== false || strpos($text, 'Wilanow') !== false) {
            $botClass->forwardMessage(env('TELEGRAM_GROUP_ID_WILANOW'), $chat_id, $message_id);
        }
        if (strpos($text, 'Wawer') !== false || strpos($text, 'Wawer') !== false) {
            $botClass->forwardMessage(env('TELEGRAM_GROUP_ID_WAWER'), $chat_id, $message_id);
        }
        if (strpos($text, 'Śródmieście') !== false || strpos($text, 'Srodmiescie') !== false) {
            $botClass->forwardMessage(env('TELEGRAM_GROUP_ID_SRODMIESCIE'), $chat_id, $message_id);
        }
        if (strpos($text, 'Żoliborz') !== false || strpos($text, 'Zoliborz') !== false) {
            $botClass->forwardMessage(env('TELEGRAM_GROUP_ID_ZOLIBORZ'), $chat_id, $message_id);
        }


        if (strpos(strtolower($text), 'ad-content') !== false) {
            $botClass->forwardMessage(env('TELEGRAM_GROUP_ID_BEMOWO'), $chat_id, $message_id);
            $botClass->forwardMessage(env('TELEGRAM_GROUP_ID_BIALOLEKA'), $chat_id, $message_id);
            $botClass->forwardMessage(env('TELEGRAM_GROUP_ID_BIELANY'), $chat_id, $message_id);
            $botClass->forwardMessage(env('TELEGRAM_GROUP_ID_MOKOTOW'), $chat_id, $message_id);
            $botClass->forwardMessage(env('TELEGRAM_GROUP_ID_OCHOTA'), $chat_id, $message_id);
            $botClass->forwardMessage(env('TELEGRAM_GROUP_ID_PRAGA_POLUDNIE'), $chat_id, $message_id);
            $botClass->forwardMessage(env('TELEGRAM_GROUP_ID_PRAGA_POLNOC'), $chat_id, $message_id);
            $botClass->forwardMessage(env('TELEGRAM_GROUP_ID_REMBERTOW'), $chat_id, $message_id);
            $botClass->forwardMessage(env('TELEGRAM_GROUP_ID_TARGOWEK'), $chat_id, $message_id);
            $botClass->forwardMessage(env('TELEGRAM_GROUP_ID_URSUS'), $chat_id, $message_id);
            $botClass->forwardMessage(env('TELEGRAM_GROUP_ID_URSYNOW'), $chat_id, $message_id);
            $botClass->forwardMessage(env('TELEGRAM_GROUP_ID_WOLA'), $chat_id, $message_id);
            $botClass->forwardMessage(env('TELEGRAM_GROUP_ID_WESOLA'), $chat_id, $message_id);
            $botClass->forwardMessage(env('TELEGRAM_GROUP_ID_WLOCHY'), $chat_id, $message_id);
            $botClass->forwardMessage(env('TELEGRAM_GROUP_ID_WILANOW'), $chat_id, $message_id);
            $botClass->forwardMessage(env('TELEGRAM_GROUP_ID_WAWER'), $chat_id, $message_id);
            $botClass->forwardMessage(env('TELEGRAM_GROUP_ID_SRODMIESCIE'), $chat_id, $message_id);
            $botClass->forwardMessage(env('TELEGRAM_GROUP_ID_ZOLIBORZ'), $chat_id, $message_id);
        }
        if (strpos(strtolower($text), 'ma-content') !== false) {
            $botClass->forwardMessage(env('TELEGRAM_GROUP_ID_BEMOWO'), $chat_id, $message_id);
            $botClass->forwardMessage(env('TELEGRAM_GROUP_ID_BIALOLEKA'), $chat_id, $message_id);
            $botClass->forwardMessage(env('TELEGRAM_GROUP_ID_BIELANY'), $chat_id, $message_id);
            $botClass->forwardMessage(env('TELEGRAM_GROUP_ID_MOKOTOW'), $chat_id, $message_id);
            $botClass->forwardMessage(env('TELEGRAM_GROUP_ID_OCHOTA'), $chat_id, $message_id);
            $botClass->forwardMessage(env('TELEGRAM_GROUP_ID_PRAGA_POLUDNIE'), $chat_id, $message_id);
            $botClass->forwardMessage(env('TELEGRAM_GROUP_ID_PRAGA_POLNOC'), $chat_id, $message_id);
            $botClass->forwardMessage(env('TELEGRAM_GROUP_ID_REMBERTOW'), $chat_id, $message_id);
            $botClass->forwardMessage(env('TELEGRAM_GROUP_ID_TARGOWEK'), $chat_id, $message_id);
            $botClass->forwardMessage(env('TELEGRAM_GROUP_ID_URSUS'), $chat_id, $message_id);
            $botClass->forwardMessage(env('TELEGRAM_GROUP_ID_URSYNOW'), $chat_id, $message_id);
            $botClass->forwardMessage(env('TELEGRAM_GROUP_ID_WOLA'), $chat_id, $message_id);
            $botClass->forwardMessage(env('TELEGRAM_GROUP_ID_WESOLA'), $chat_id, $message_id);
            $botClass->forwardMessage(env('TELEGRAM_GROUP_ID_WLOCHY'), $chat_id, $message_id);
            $botClass->forwardMessage(env('TELEGRAM_GROUP_ID_WILANOW'), $chat_id, $message_id);
            $botClass->forwardMessage(env('TELEGRAM_GROUP_ID_WAWER'), $chat_id, $message_id);
            $botClass->forwardMessage(env('TELEGRAM_GROUP_ID_SRODMIESCIE'), $chat_id, $message_id);
            $botClass->forwardMessage(env('TELEGRAM_GROUP_ID_ZOLIBORZ'), $chat_id, $message_id);
        }

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function test()
    {
        $pq = new ParsingClass();
        $pq->parse();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function olx_parse1()
    {
        $pq = new ParsingClass();
        $pq->parse();
    }
}
