<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display all contact submissions
     */
    public function index()
    {
        $contacts = Contact::orderBy('created_at', 'desc')->paginate(15);
        $unreadCount = Contact::where('read', false)->count();
        
        return view('admin.contacts', compact('contacts', 'unreadCount'));
    }

    /**
     * Show a specific contact submission
     */
    public function show($id)
    {
        $contact = Contact::findOrFail($id);
        
        // Mark as read
        if (!$contact->read) {
            $contact->update(['read' => true]);
        }
        
        return view('admin.contact-detail', compact('contact'));
    }

    /**
     * Mark contact as read/unread
     */
    public function toggleRead($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->update(['read' => !$contact->read]);
        
        return redirect()->back()->with('success', 'Contact status updated.');
    }

    /**
     * Delete a contact submission
     */
    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();
        
        return redirect()->route('admin.contacts')->with('success', 'Contact deleted successfully.');
    }
}
