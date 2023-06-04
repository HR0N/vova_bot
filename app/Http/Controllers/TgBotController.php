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
        set webhook - https://api.telegram.org/bot{token}/setWebhook
        custom set webhook / bot stopped - https://api.telegram.org/bot<your_token>/setWebHook?url=<hook_url>&allowed_updates=["callback_query","message"]
        to remove webhook - https://api.telegram.org/bot{token}/setWebhook?remove
        getWebHookUpdates - https://api.telegram.org/bot<bot token>/getUpdates
        основной пункт - сказать волшебное слово
    */
    public function bot_hook()
    {
        $botClass = new TgBotClass();
        $updates = $botClass->getUpdates()->getMessage();

        $chat_id = $updates->chat->id;
        $bot_added = $botClass->bot_add($updates) ? "success" : 'error';
        $bot_kicked = $botClass->bot_kick($updates) ? "success" : 'error';

        $botClass->sendMessage(env('TELEGRAM_GROUP_ID'), 'test');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $botClass = new TgBotClass();

        $botClass->sendMessage(env('TELEGRAM_GROUP_ID'), 'test');
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
}
