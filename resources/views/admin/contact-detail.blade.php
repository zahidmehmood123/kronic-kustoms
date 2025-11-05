@extends('admin.layout')

@section('title', 'Contact Detail')

@section('breadcrumb')
    <a href="{{ route('admin.dashboard') }}">📊 Dashboard</a>
    <span>/</span>
    <a href="{{ route('admin.contacts') }}">📧 Contact Submissions</a>
    <span>/</span>
    <span class="active">Contact Details - {{ $contact->name }}</span>
@endsection

@section('content')
    <div class="card">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h2>Contact Submission Details</h2>
            <div>
                <a href="{{ route('admin.contacts') }}" class="btn-submit" style="display: inline-block; text-decoration: none; background: #555; margin-right: 10px;">← Back to List</a>
                <form method="POST" action="{{ route('admin.contacts.toggleRead', $contact->id) }}" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn-submit" style="background: {{ $contact->read ? '#555' : '#FF0000' }};">
                        {{ $contact->read ? '✗ Mark as Unread' : '✓ Mark as Read' }}
                    </button>
                </form>
                <form method="POST" action="{{ route('admin.contacts.destroy', $contact->id) }}" style="display: inline; margin-left: 10px;" onsubmit="return confirm('Are you sure you want to delete this contact?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-submit" style="background: #ff4444;">
                        🗑️ Delete
                    </button>
                </form>
            </div>
        </div>

        <div style="background: #555; padding: 20px; border-radius: 8px; margin-bottom: 20px;">
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px;">
                <div>
                    <strong style="color: #FF0000;">Name:</strong>
                    <p style="margin-top: 5px;">{{ $contact->name }}</p>
                </div>
                <div>
                    <strong style="color: #FF0000;">Email:</strong>
                    <p style="margin-top: 5px;">
                        <a href="mailto:{{ $contact->email }}" style="color: #EDEDED; text-decoration: none;">{{ $contact->email }}</a>
                    </p>
                </div>
                <div>
                    <strong style="color: #FF0000;">Phone:</strong>
                    <p style="margin-top: 5px;">{{ $contact->phone ?: 'Not provided' }}</p>
                </div>
                <div>
                    <strong style="color: #FF0000;">Subject:</strong>
                    <p style="margin-top: 5px;">{{ $contact->subject ?: 'No Subject' }}</p>
                </div>
                <div>
                    <strong style="color: #FF0000;">Submitted:</strong>
                    <p style="margin-top: 5px;">{{ $contact->created_at->format('F d, Y \a\t h:i A') }}</p>
                </div>
                <div>
                    <strong style="color: #FF0000;">Status:</strong>
                    <p style="margin-top: 5px;">
                        <span style="padding: 4px 8px; border-radius: 3px; background: {{ $contact->read ? '#555' : '#FF0000' }}; color: white; font-size: 12px;">
                            {{ $contact->read ? 'Read' : 'Unread' }}
                        </span>
                    </p>
                </div>
            </div>
        </div>

        <div class="card">
            <h3 style="color: #FF0000; margin-bottom: 15px;">Message</h3>
            <div style="background: #555; padding: 20px; border-radius: 8px; white-space: pre-wrap; line-height: 1.6;">
                {{ $contact->message }}
            </div>
        </div>
    </div>
@endsection

