@include('layouts.header')
@include('layouts.navbar')

@if (session('success'))
    <div class="alert alert-success text-center">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger text-center">
        {{ session('error') }}
    </div>
@endif

@yield('content')

@if(auth()->check())
    <style>
        .chat-floating-button {
            position: fixed;
            right: 20px;
            bottom: 20px;
            width: 56px;
            height: 56px;
            border-radius: 50%;
            background-color: #1B6F58;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            border: none;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            z-index: 9999;
            cursor: pointer;
        }

        .chat-box {
            position: fixed;
            right: 20px;
            bottom: 90px;
            width: 320px;
            max-width: 90vw;
            height: 420px;
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
            display: none;
            flex-direction: column;
            z-index: 9999;
            overflow: hidden;
        }

        .chat-box-header {
            padding: 10px 14px;
            background-color: #0d6efd;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-weight: 600;
            font-size: 14px;
        }

        .chat-box-messages {
            flex: 1;
            padding: 10px;
            overflow-y: auto;
            background-color: #f8f9fa;
        }

        .chat-message-row {
            display: flex;
            margin-bottom: 8px;
        }

        .chat-message-user {
            justify-content: flex-end;
        }

        .chat-message-admin {
            justify-content: flex-start;
        }

        .chat-message-bubble {
            max-width: 80%;
            padding: 8px 12px;
            border-radius: 16px;
            font-size: 13px;
            line-height: 1.4;
            box-shadow: 0 1px 3px rgba(15, 23, 42, 0.15);
        }

        .chat-message-bubble-user {
            background: linear-gradient(135deg, #0d6efd, #2563eb);
            color: #fff;
            border-bottom-right-radius: 4px;
        }

        .chat-message-bubble-admin {
            background: #e9ecef;
            color: #111827;
            border-bottom-left-radius: 4px;
        }

        .chat-box-input {
            padding: 8px;
            border-top: 1px solid #dee2e6;
            background-color: #fff;
        }

        .chat-box-input form {
            display: flex;
            gap: 6px;
        }

        .chat-box-input textarea {
            resize: none;
            height: 40px;
            font-size: 13px;
        }

        .chat-box-input button {
            white-space: nowrap;
        }
    </style>

    <button type="button" id="chat-toggle-button" class="chat-floating-button">
        <i class="ri-chat-3-line"></i>
    </button>

    <div id="chat-box" class="chat-box">
        <div class="chat-box-header">
            <span>Support Chat</span>
            <button type="button" id="chat-close-button" style="background:none;border:none;color:#fff;font-size:16px;line-height:1;">×</button>
        </div>
        <div id="chat-messages" class="chat-box-messages"></div>
        <div class="chat-box-input">
            <form id="chat-form">
                <textarea id="chat-input" class="form-control" placeholder="Type a message"></textarea>
                <button type="submit" class="btn btn-primary">Send</button>
            </form>
        </div>
    </div>

    <script>
        (function () {
            var toggleButton = document.getElementById('chat-toggle-button');
            var closeButton = document.getElementById('chat-close-button');
            var chatBox = document.getElementById('chat-box');
            var messagesContainer = document.getElementById('chat-messages');
            var form = document.getElementById('chat-form');
            var input = document.getElementById('chat-input');
            var pollingInterval = null;
            var lastMessageId = null;
            var isLoading = false;
            var messagesUrl = "{{ route('chat.messages') }}";
            var sendUrl = "{{ route('chat.store') }}";
            var csrfTokenMeta = document.querySelector('meta[name=\"csrf-token\"]');
            var csrfToken = csrfTokenMeta ? csrfTokenMeta.getAttribute('content') : '';

            function appendMessage(message) {
                var row = document.createElement('div');
                row.className = 'chat-message-row ' + (message.sender_type === 'user' ? 'chat-message-user' : 'chat-message-admin');

                var bubble = document.createElement('div');
                bubble.className = 'chat-message-bubble ' + (message.sender_type === 'user' ? 'chat-message-bubble-user' : 'chat-message-bubble-admin');
                bubble.textContent = message.content;

                row.appendChild(bubble);
                messagesContainer.appendChild(row);
            }

            function scrollToBottom() {
                messagesContainer.scrollTop = messagesContainer.scrollHeight;
            }

            function loadMessages(initial) {
                if (isLoading) {
                    return;
                }
                if (!initial && !lastMessageId) {
                    return;
                }
                isLoading = true;

                var url = messagesUrl;
                if (!initial && lastMessageId) {
                    var separator = url.indexOf('?') === -1 ? '?' : '&';
                    url = url + separator + 'after_id=' + encodeURIComponent(lastMessageId);
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
                        if (!data || !data.messages) {
                            return;
                        }
                        if (data.messages.length === 0) {
                            return;
                        }
                        data.messages.forEach(function (message) {
                            appendMessage(message);
                            lastMessageId = message.id;
                        });
                        scrollToBottom();
                    })
                    .catch(function () {
                    })
                    .finally(function () {
                        isLoading = false;
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

            function stopPolling() {
                if (pollingInterval) {
                    clearInterval(pollingInterval);
                    pollingInterval = null;
                }
            }

            if (toggleButton && chatBox && messagesContainer && form && input) {
                toggleButton.addEventListener('click', function () {
                    var isVisible = chatBox.style.display === 'flex';
                    if (isVisible) {
                        chatBox.style.display = 'none';
                        stopPolling();
                    } else {
                        chatBox.style.display = 'flex';
                        if (lastMessageId === null) {
                            loadMessages(true);
                        }
                        startPolling();
                    }
                });

                closeButton.addEventListener('click', function () {
                    chatBox.style.display = 'none';
                    stopPolling();
                });

                form.addEventListener('submit', function (e) {
                    e.preventDefault();
                    var content = input.value.trim();
                    if (!content) {
                        return;
                    }

                fetch(sendUrl, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: JSON.stringify({ content: content })
                    })
                        .then(function (response) {
                            return response.json();
                        })
                        .then(function (data) {
                            if (data && data.message) {
                                input.value = '';
                                appendMessage(data.message);
                                lastMessageId = data.message.id;
                                scrollToBottom();
                            }
                        })
                        .catch(function () {
                        });
                });
            }
        })();
    </script>
@endif

@include('layouts.footer')
