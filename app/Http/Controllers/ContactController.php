<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    //show contact page
    public function show()
    {
        return view('user.contact.contact');
    }

    // send to user from admin
     public function store(Request $request) {
        // dd($request->all());
        $validated = $request->validate([
            'title' => 'required',
            'message' => 'required'
        ]);
        

        $validated['user_id'] = auth()->id();
        
        Contact::create($validated);

        return back()->with('sendsuccess', 'Your message has been sent successfully.');
    }

    // admin ->contactlsit
    public function contactList()
    {
            $messages = Contact::select('contacts.*', 'users.name as user_name', 'users.email as user_email')
                ->leftJoin('users', 'contacts.user_id', 'users.id')
                ->when(request('searchKey'), function($query) {
                    $query->orWhere('users.name', 'like', '%' . request('searchKey') . '%')
                        ->orWhere('users.email', 'like', '%' . request('searchKey') . '%')
                        ->orWhere('contacts.subject', 'like', '%' . request('searchKey') . '%')
                        ->orWhere('contacts.message', 'like', '%' . request('searchKey') . '%');
                })
                ->paginate(4);
        return view('admin.contact.adminContact',compact('messages'));
    }

    // admin->contactdetail
    // Detail Message
    public function detail($id) {
        $message = Contact::select('contacts.*', 'users.name as user_name', 'users.email as user_email')
            ->leftJoin('users', 'contacts.user_id', 'users.id')
            ->where('contacts.id', $id)
            ->first();
        return view('admin.contact.detail', compact('message'));
    }

    // Delete Message
    public function delete($id) {
        Contact::find($id)->delete();
        return back()->with('deletesuccess', 'Message has been deleted successfully.');
    }
}
