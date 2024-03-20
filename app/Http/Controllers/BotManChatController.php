<?php

namespace App\Http\Controllers;

use BotMan\BotMan\Messages\Incoming\Answer;
use Illuminate\Http\Request;

class BotManChatController extends Controller
{
    public function handle()
    {
        $botman = app('botman');

        $botman->hears('{message}', function ($botman, $message) {
            if (strtolower($message) == 'hi' || strtolower($message) == 'hello') {
                $this->askName($botman);
            } else if (strtolower($message) == 'help') {
                $botman->reply('
                                Nhập "home" để mở hộp thoại về trang chủ <br>
                                Nhập "shop" để xem về hướng dẫn sản phẩm. <br>
                                Nhập "cart" để xem về hướng dẫn giỏ hàng. <br>
                                Nhập "contact" để xem về hướng dẫn liên hệ. <br>
                                Nhập "hi" để bắt đầu cuộc hội thoại <br>
                                Nhập "help" để mở hộp thoại trợ giúp <br>
                ');
            } else if (strtolower($message) == 'home') {
                $botman->reply('Bạn có thể xem chi tiết trang chủ bằng cách truy cập vào đường link sau: [http://127.0.0.1:8000/shop]');
            } else if (strtolower($message) == 'shop') {
                $botman->reply('Bạn có thể xem chi tiết sản phẩm tại trang Shop bằng cách truy cập vào đường link sau: [http://127.0.0.1:8000/shop]');
            } else if (strtolower($message) == 'contact') {
                $botman->reply('Bạn có thể xem chi tiết liên hệ tại trang Shop bằng cách truy cập vào đường link sau: [http://127.0.0.1:8000/contact]');
            } else if (strtolower($message) == 'cart') {
                $botman->reply('Bạn có thể xem chi tiết trang giỏ hàng bằng cách truy cập vào đường link sau: [http://127.0.0.1:8000/cart]');
            } else {
                $botman->reply('Nhập "hi" để bắt đầu cuộc hội thoại, hoặc nhập "help" để truy cập các lệnh.');
            }
        });

        $botman->fallback(function ($bot) {
            $bot->reply("Xin lỗi, tôi không hiểu câu hỏi của bạn. Hãy hỏi lại câu khác!");
        });

        $botman->listen();
    }

    public function askName($botman)
    {
        $botman->ask('Hello! Tên bạn là gì?', function (Answer $answer, $conversation) {
            $name = $answer->getText();

            $this->say('Rất vui được gặp bạn ' . $name);

            $conversation->ask('Bạn có thể cung cấp email cho tôi không.', function (Answer $answer, $conversation) {
                $email = $answer->getText();

                $this->say('Email:' . $email);

                $conversation->ask('Xác nhận nếu thông tin email là chính xác. Bạn có thể xác nhận là "yes" hoặc "no".', function (Answer $answer, $conversation) {
                    $cofirmEmail = $answer->getText();

                    if ($cofirmEmail == 'yes' || $cofirmEmail == 'Yes') {
                        $this->say('Chúng tôi sẽ liên hệ với bạn về vấn đề bạn gặp sớm nhất có thể.');
                    }
                });
            });
        });
    }
}
