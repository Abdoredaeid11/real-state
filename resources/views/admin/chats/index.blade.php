@extends('admin.layout.master')

@section('content')
    @php
        $locale = app()->getLocale();
    @endphp
    <div class="row">
        <div class="col-md-4 mb-3">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="mb-0">Users</h5>
                </div>
                <div class="list-group list-group-flush">
                    @forelse($users as $user)
                        <a href="{{ route('admin.chats.index', ['locale' => $locale, 'user_id' => $user->id]) }}"
                           class="list-group-item list-group-item-action {{ $activeUser && $activeUser->id === $user->id ? 'active' : '' }}">
                            <div class="d-flex justify-content-between align-items-center">
                                <span>{{ $user->name }}</span>
                                <span class="badge bg-light text-muted">{{ $user->email }}</span>
                            </div>
                        </a>
                    @empty
                        <div class="list-group-item">
                            <span>No chats yet.</span>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
        <div class="col-md-8 mb-3">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        @if($activeUser)
                            Chat with {{ $activeUser->name }}
                        @else
                            Select a user
                        @endif
                    </h5>
                </div>
                <div class="card-body d-flex flex-column" style="height: 450px;">
                    @if($activeUser)
                        <div id="admin-chat-messages" class="flex-grow-1 border rounded p-2 mb-2 overflow-auto" style="background-color:#f8f9fa;"></div>
                        <form id="admin-chat-form" class="d-flex gap-2">
                            <input type="hidden" id="admin-chat-user-id" value="{{ $activeUser->id }}">
                            <textarea id="admin-chat-input" class="form-control" rows="2" placeholder="Type a message"></textarea>
                            <button type="submit" class="btn btn-primary">Send</button>
                        </form>
                    @else
                        <div class="d-flex align-items-center justify-content-center h-100 text-muted">
                            <span>Select a user on the left to start chatting.</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @if($activeUser)
        <script>
            (function () {
                var messagesContainer = document.getElementById('admin-chat-messages');
                var form = document.getElementById('admin-chat-form');
                var input = document.getElementById('admin-chat-input');
                var userIdInput = document.getElementById('admin-chat-user-id');
                var pollingInterval = null;
                var lastMessageId = null;
                var messagesUrl = "{{ route('admin.chats.messages', ['locale' => $locale]) }}";
                var sendUrl = "{{ route('admin.chats.store', ['locale' => $locale]) }}";
                var csrfTokenMeta = document.querySelector('meta[name="csrf-token"]');
                var csrfToken = csrfTokenMeta ? csrfTokenMeta.getAttribute('content') : '';

                function appendMessage(message) {
                    if (document.querySelector('div[data-message-id="' + message.id + '"]')) {
                        return;
                    }
                    var row = document.createElement('div');
                    row.setAttribute('data-message-id', message.id);
                    row.className = 'd-flex mb-2 ' + (message.sender_type === 'admin' ? 'justify-content-end' : 'justify-content-start');

                    var bubble = document.createElement('div');
                    bubble.className = 'px-2 py-1 rounded';
                    bubble.style.maxWidth = '80%';
                    bubble.style.fontSize = '13px';
                    bubble.style.borderRadius = '16px';
                    bubble.style.boxShadow = '0 1px 3px rgba(15,23,42,0.15)';

                    if (message.sender_type === 'admin') {
                        bubble.style.backgroundImage = 'linear-gradient(135deg,#0d6efd,#2563eb)';
                        bubble.style.color = '#fff';
                        bubble.style.borderBottomRightRadius = '4px';
                    } else {
                        bubble.style.backgroundColor = '#e9ecef';
                        bubble.style.color = '#111827';
                        bubble.style.borderBottomLeftRadius = '4px';
                    }

                    bubble.textContent = message.content;

                    row.appendChild(bubble);
                    messagesContainer.appendChild(row);
                }

                function scrollToBottom() {
                    messagesContainer.scrollTop = messagesContainer.scrollHeight;
                }

                function loadMessages(initial) {
                    var userId = userIdInput.value;
                    if (!userId) {
                        return;
                    }
                    if (!initial && !lastMessageId) {
                        return;
                    }

                    var url = messagesUrl + '?user_id=' + encodeURIComponent(userId);
                    if (!initial && lastMessageId) {
                        url += '&after_id=' + encodeURIComponent(lastMessageId);
                    }

                    fetch(url, {
                        headers: {
                            'Accept': 'application/json'
                        }
                    })
                        .then(function (response) {
                            return response.json();
                        })
                        .then(function (data) {
                            if (!data || !data.messages || data.messages.length === 0) {
                                return;
                            }
                            data.messages.forEach(function (message) {
                                appendMessage(message);
                                lastMessageId = message.id;
                            });
                            scrollToBottom();
                        })
                        .catch(function () {
                        });
                }

                function startPolling() {
                    if (pollingInterval) {
                        return;
                    }
                    pollingInterval = setInterval(function () {
                        loadMessages(false);
                    }, 1000);
                }

                function init() {
                    loadMessages(true);
                    startPolling();
                }

                if (messagesContainer && form && input && userIdInput) {
                    init();

                    form.addEventListener('submit', function (e) {
                        e.preventDefault();
                        var content = input.value.trim();
                        if (!content) {
                            return;
                        }

                        var payload = {
                            user_id: userIdInput.value,
                            content: content
                        };

                        fetch(sendUrl, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': csrfToken
                            },
                            body: JSON.stringify(payload)
                        })
                            .then(function (response) {
                                return response.json();
                            })
                            .then(function (data) {
                                if (data && data.message) {
                                    input.value = '';
                                }
                            })
                            .catch(function () {
                            });
                    });
                }
            })();
        </script>
    @endif
@endsection
