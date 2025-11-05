@extends('admin.layout')

@section('title', 'Contact Submissions')

@section('breadcrumb')
    <a href="{{ route('admin.dashboard') }}">📊 Dashboard</a>
    <span>/</span>
    <span class="active">📧 Contact Submissions</span>
@endsection

@section('content')
    <div class="card">
        <h2>Contact Submissions</h2>
        <p style="margin-bottom: 20px;">Manage customer contact form submissions. You have <strong style="color: #FF0000;">{{ $unreadCount }}</strong> unread messages.</p>
    </div>

    @if($contacts->count() > 0)
        <div class="card">
            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="background: #555; border-bottom: 2px solid #777;">
                            <th style="padding: 12px; text-align: left; color: #FF0000;">Name</th>
                            <th style="padding: 12px; text-align: left; color: #FF0000;">Email</th>
                            <th style="padding: 12px; text-align: left; color: #FF0000;">Phone</th>
                            <th style="padding: 12px; text-align: left; color: #FF0000;">Subject</th>
                            <th style="padding: 12px; text-align: left; color: #FF0000;">Date</th>
                            <th style="padding: 12px; text-align: left; color: #FF0000;">Status</th>
                            <th style="padding: 12px; text-align: left; color: #FF0000;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($contacts as $contact)
                            <tr style="border-bottom: 1px solid #555; {{ !$contact->read ? 'background: #3a3a3a;' : '' }}">
                                <td style="padding: 12px;">{{ $contact->name }}</td>
                                <td style="padding: 12px;">{{ $contact->email }}</td>
                                <td style="padding: 12px;">{{ $contact->phone ?: '-' }}</td>
                                <td style="padding: 12px;">{{ $contact->subject ?: 'No Subject' }}</td>
                                <td style="padding: 12px;">{{ $contact->created_at->format('M d, Y H:i') }}</td>
                                <td style="padding: 12px;">
                                    <span style="padding: 4px 8px; border-radius: 3px; background: {{ $contact->read ? '#555' : '#FF0000' }}; color: white; font-size: 12px;">
                                        {{ $contact->read ? 'Read' : 'Unread' }}
                                    </span>
                                </td>
                                <td style="padding: 12px;">
                                    <a href="{{ route('admin.contacts.show', $contact->id) }}" style="color: #FF0000; text-decoration: none; margin-right: 10px;" title="View Contact">👁️</a>
                                    <form method="POST" action="{{ route('admin.contacts.toggleRead', $contact->id) }}" style="display: inline;">
                                        @csrf
                                        <button type="submit" style="background: none; border: none; color: #FF0000; cursor: pointer; text-decoration: underline; padding: 0; margin-right: 10px;" title="{{ $contact->read ? 'Mark as Unread' : 'Mark as Read' }}">
                                            {{ $contact->read ? '✗ Mark Unread' : '✓ Mark Read' }}
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{ $contacts->links() }}
        </div>
    @else
        <div class="card">
            <p style="text-align: center; color: #999; padding: 40px;">No contact submissions found.</p>
        </div>
    @endif
@endsection

