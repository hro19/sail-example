<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function send()
    {
        $to = 'recipient@example.com'; // 送信先のメールアドレス
        $subject = 'テストメール';
        $body = 'これはLaravelから送信されたテストメールです。';

        Mail::raw($body, function ($message) use ($to, $subject) {
            $message->to($to)
                    ->subject($subject);
        });

        return 'メールが送信されました。Mailpitで確認してください。';
    }
}