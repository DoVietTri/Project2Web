<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;
use Auth;

class ContactController extends Controller
{
    public function getContact() {
    	return view('client.pages.contact');
    }

    public function postContact(Request $request) {
        $contact = new Contact;
        $contact->message = $request->txtMessage;
        $contact->user_id = Auth::user()->id;
        
        
        if ($contact->save()) {
            \Session::flash('toastr', [
                'type' => 'success',
                'message' => 'Phản hồi của bạn đã được gửi đi !'
            ]);
            return redirect()->route('index');
        } else {
            \Session::flash('toastr', [
                'type' => 'error',
                'message' => 'Đã có lỗi xảy ra !'
            ]);
            return redirect()->back();
        }	     
    }
}
