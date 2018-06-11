<?php

namespace App\Http\Controllers;

use App\MailExchange;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailExchangeController extends Controller
{

    public function getUnreadMessage(Request $request)
    {
        $mails = MailExchange::where('read_it', false)->where('email_from', $request->email)->orWhere('email_to', $request->email)->get();
        return response()->json(['mails' => $mails]);
    }

    public function mailsForUser(Request $request)
    {
        $mails = MailExchange::where('email_from', $request->email)->orWhere('email_to', $request->email)->orderBy('created_at', 'DESC')->get();
        return response()->json($mails);
    }


    public function store(Request $request)
    {
        $emails = $request->email_to;

        $this->validate($request, [
            'subject' => 'max:255',
            'msg' => 'required|max:1000'
        ]);


        $data = $request->all();

        foreach ($emails as $item) {
            $data['email_to'] = $item;
            MailExchange::create($data);

            $data['email'] = $data['email_from'];
            $data['phone'] = '';
            Mail::send('mail', $data, function ($message) use ($data) {
                $message->from($data['email_from']);
                $message->to($data['email_to']);
                $message->subject($data['subject']);
            });
        }

        return response()->json(['status' => true, 'message' => 'Сообщение отправлено!']);
    }


    public function show($id)
    {
        $emails = MailExchange::where('user_id', $id)->pluck('email_to');

        return response()->json(['emails' => $emails]);
    }


    public function updateMail(Request $request)
    {
        $mail = MailExchange::where('id', $request->id)->first();
        if ($mail) {
            $mail->read_it = true;
            $mail->save();
        }
        return response()->json([
            'status' => true
        ]);
    }

    function cleanData($value)
    {
        $arr = array_map("trim", $value);
        $arr = array_map("strip_tags", $arr);
        $arr = array_map("stripcslashes", $arr);
        return $arr;
    }

    public function destroy($id)
    {
        $mail = MailExchange::where('id', $id)->first();
        if ($mail) {
            $mail->delete();
            return response()->json(['status' => true, 'message' => 'Сообщение удалено!']);
        }
    }
}
