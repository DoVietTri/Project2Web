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

    public function getList() {
        $contact = Contact::with('user')->orderBy('id', 'DESC')->get();
        return view('admin.pages.contact.list', compact('contact'));
    }

    public function getDelete($id) {
        $contact = Contact::find($id);
        $contact->delete();
        return redirect()->route('admin.contact.getList')->with(['flash_level' => 'success', 'flash_message' => 'Xóa tin nhắn thành công']);
    }

    public function getContactFilter(Request $req, $status) {

        if ($req->ajax()) {
            if ($status == 2) {
                $filter = DB::table('contacts')->get();
                $html = view('admin.pages.contact.filter', compact('filter'));
            } else {
                $filter = DB::table('contacts')->where('status', $status)->get();
                $html = view('admin.pages.contact.filter', compact('filter'));
            }
            return response(['html' => $html]);
        }
    }
}
