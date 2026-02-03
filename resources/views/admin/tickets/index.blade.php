@extends('admin.layout.master')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Support Tickets</h5>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>User</th>
                            <th>Content</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($tickets as $ticket)
                            <tr>
                                <td>{{ $ticket->id }}</td>
                                <td>{{ $ticket->user->name }} <br> <small class="text-muted">{{ $ticket->user->email }}</small></td>
                                <td>{{ Str::limit($ticket->content, 100) }}</td>
                                <td>
                                    @if($ticket->status == 'pending')
                                        <span class="badge bg-warning text-dark">Pending</span>
                                    @elseif($ticket->status == 'seen')
                                        <span class="badge bg-info">Seen</span>
                                    @elseif($ticket->status == 'replied')
                                        <span class="badge bg-success">Replied</span>
                                    @endif
                                </td>
                                <td>{{ $ticket->created_at->diffForHumans() }}</td>
                                <td>
                                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#replyModal{{ $ticket->id }}">
                                        Reply
                                    </button>
                                </td>
                            </tr>

                            <!-- Reply Modal -->
                            <div class="modal fade" id="replyModal{{ $ticket->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Reply to Ticket #{{ $ticket->id }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('admin.tickets.reply', ['locale' => app()->getLocale(), 'id' => $ticket->id]) }}" method="POST">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label class="form-label">User Message:</label>
                                                    <p class="p-2 bg-light rounded">{{ $ticket->content }}</p>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Reply Content:</label>
                                                    <textarea name="reply_content" class="form-control" rows="4" required></textarea>
                                                    <small class="text-muted">This reply will be sent as a live chat message.</small>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Send Reply</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No tickets found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
