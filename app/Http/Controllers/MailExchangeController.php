<?php

namespace App\Http\Controllers;

use App\MailExchange;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailExchangeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    public function mailsForUser(Request $request)
    {
        $mails = MailExchange::where('email_from', $request->email)->orWhere('email_to', $request->email)->orderBy('created_at', 'DESC')->get();
        return response()->json($mails);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'email_to' => 'required|email',
            'email_from' => 'required|email',
            'subject'=>'max:255',
            'message' => 'required|max:1000'
        ]);

        MailExchange::create($request->all());

        $data = $request->all();

        Mail::send('sendMails', $data, function ($message) use ($data) {
            $message->from($data['email_from']);
            $message->to($data['email_to']);
            $message->subject($data['subject']);
        });
        return response()->json(['status' => true, 'message' => 'Сообщение отправлено!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mail = MailExchange::where('id', $id)->first();
        if ($mail) {
            $mail->delete();
            return response()->json(['status' => true, 'message' => 'Сообщение удалено!']);
        }
    }
}
