<?php

namespace App\Http\Controllers;

use App\Console\Commands\StartCommand;
use CURLFile;
use Telegram\Bot\Api;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Telegram\Bot\Laravel\Facades\Telegram;
use Telegram\Bot\FileUpload\InputFile;
use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;
use Illuminate\Support\Facades\Log;

class BotController extends Controller
{
    public function index()
    {

        // describe bot telegram
        // $response = Telegram::getMe();
        // $botId = $response->getId();
        // $firstName = $response->getFirstName();
        // $username = $response->getUsername();

        $chat_id = '1561198017';
        $photo_url = 'https://upload.wikimedia.org/wikipedia/commons/9/99/Sample_User_Icon.png';
        $bot_token = '7649729929:AAGH2318iVTQsfRBks6U_mhv9T3ShzrUvxc';
        $telegram = new Api($bot_token);
        $telegram->setWebhook(["url" => "https://api.telegram.org/bot7649729929:AAGH2318iVTQsfRBks6U_mhv9T3ShzrUvxc"]);
        // return $telegram->getMe();

        // method send message
        $response = $telegram->sendMessage([
            'chat_id' => '1561198017',
            'text' => 'Hello World'
        ]);


        // method for forward message
        // $response = $telegram->forwardMessage([
        //     'chat_id' => '1561198017',
        //     'from_chat_id' => '1561198017',
        //     'message_id' => '1'
        // ]);
        // $messageId = $response->getMessageId();
        // return $messageId;


        //method send photo
        // $response = $telegram->sendPhoto([
        //     'chat_id' => $chat_id,
        //     'photo' => InputFile::create($photo_url, "test"),
        //     'caption' => 'Here is the image you requested!',
        // ]);

        // $messageId = $response->getMessageId();
        // return $messageId;


        //method send action
        // $telegram->sendChatAction([
        //     'chat_id' => $chat_id,
        //     'action' => 'typing',
        // ]);

        //method get user profile photo
        // $response = $telegram->getUserProfilePhotos(['user_id' => $chat_id]);
        // $photos_count = $response->getTotalCount();
        // $photos = $response->getPhotos();
        // return $photos;

        //method update information
        // $response = $telegram->getUpdates();
        // return $response;
    }

    public function handle(Request $request)
    {
        $update = Telegram::getWebhookUpdate();
        Log::debug('logger webhook update', [$update]);
        return response()->json(['status' => 'logged successfully']);

    }

    public function setWebhook()
    {
        $url = config('telegram.bots.mybot.webhook_url');
        return Telegram::setWebhook(['url' => $url]);
    }

    public function updated(Request $request)
    {
        $activity = Telegram::getWebhookUpdate();
        Log::debug($activity->toArray());
    }

    public function main(Request $request)
    {
        $update = Telegram::getWebhookUpdate();
        Log::debug('logger webhook update', [$update]);
        return response()->json(['status' => 'logged successfully']);
    }

}
