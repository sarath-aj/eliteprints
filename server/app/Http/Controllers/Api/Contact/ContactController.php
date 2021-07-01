<?php

namespace App\Http\Controllers\Api\Contact;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use Mail;

class ContactController extends Controller
{
    public function saveContact(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required'
        ]);

        $contact = new Contact;

        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->subject = $request->subject;
        $contact->message = $request->message;

        $contact->save();

        \Mail::send(
            'contact_email',
            array(
                 'name' => $request->get('name'),
                 'email' => $request->get('email'),
                 'subject' => $request->get('subject'),
                 'sender_message' => $request->get('message'),
             ),
            function ($message) use ($request) {
                // $message->from($request->get('email'));
                $message->to(env('MAIL_TO_ADDRESS'));
                $message->subject('Contact Us Form Submission');
            }
        );

        return response()->json([
              'message' => 'success',
          ]);
    }
}