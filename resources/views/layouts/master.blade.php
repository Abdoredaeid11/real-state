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
        .default-btn {
            white-space: nowrap !important;
        }
    </style>

    <button type="button" id="chat-toggle-button" class="chat-floating-button">
        <i class="ri-chat-3-line"></i>
    </button>

    <div id="chat-box" class="chat-box">
        <div class="chat-box-header">
            <span id="chat-header-title">Support Chat</span>
            <button type="button" id="chat-close-button" style="background:none;border:none;color:#fff;font-size:16px;line-height:1;">×</button>
        </div>
        
        <!-- Messages Area (Shown only when there is history) -->
        <div id="chat-messages" class="chat-box-messages" style="display: none;"></div>

        <!-- Live Chat Input Mode -->
        <div id="chat-mode-container" style="display: none; flex-direction: column;">
            <div class="chat-box-input">
                <form id="chat-form">
                    <textarea id="chat-input" class="form-control" placeholder="Type a message"></textarea>
                    <button type="submit" class="btn btn-primary">Send</button>
                </form>
            </div>
        </div>

        <!-- Ticket Input Mode -->
        <div id="ticket-mode-container" style="display: none; flex-direction: column; padding: 15px; border-top: 1px solid #dee2e6; background: #fff;">
            <p class="text-muted mb-2" style="font-size: 13px;">Admins are currently offline. Please leave a message.</p>
            <form id="ticket-form" style="display: flex; flex-direction: column;">
                <textarea id="ticket-input" class="form-control mb-2" style="resize: none; height: 80px;" placeholder="Describe your issue..."></textarea>
                <button type="submit" class="btn btn-primary w-100 btn-sm">Submit Ticket</button>
            </form>
            <div id="ticket-success" class="alert alert-success mt-2" style="display: none; font-size: 13px; margin-bottom: 0;">
                Ticket submitted successfully!
            </div>
        </div>
    </div>

    <script>
        (function () {
            var toggleButton = document.getElementById('chat-toggle-button');
            var closeButton = document.getElementById('chat-close-button');
            var chatBox = document.getElementById('chat-box');
            var messagesContainer = document.getElementById('chat-messages');
            var chatForm = document.getElementById('chat-form');
            var chatInput = document.getElementById('chat-input');
            var ticketForm = document.getElementById('ticket-form');
            var ticketInput = document.getElementById('ticket-input');
            var ticketSuccess = document.getElementById('ticket-success');
            var chatModeContainer = document.getElementById('chat-mode-container');
            var ticketModeContainer = document.getElementById('ticket-mode-container');
            var headerTitle = document.getElementById('chat-header-title');

            var pollingInterval = null;
            var lastMessageId = null;
            var isLoading = false;
            var adminOnline = null;
            var defaultChatHeight = null;
            
            var messagesUrl = "{{ route('chat.messages') }}";
            var sendUrl = "{{ route('chat.store') }}";
            var statusUrl = "{{ route('chat.status') }}";
            var ticketUrl = "{{ route('tickets.store') }}";
            
            var csrfTokenMeta = document.querySelector('meta[name="csrf-token"]');
            var csrfToken = csrfTokenMeta ? csrfTokenMeta.getAttribute('content') : '';

            function appendMessage(message) {
                if (document.querySelector('.chat-message-row[data-message-id="' + message.id + '"]')) {
                    return;
                }
                var row = document.createElement('div');
                row.setAttribute('data-message-id', message.id);
                row.className = 'chat-message-row ' + (message.sender_type === 'user' ? 'chat-message-user' : 'chat-message-admin');

                var bubble = document.createElement('div');
                bubble.className = 'chat-message-bubble ' + (message.sender_type === 'user' ? 'chat-message-bubble-user' : 'chat-message-bubble-admin');

                bubble.textContent = message.content;
                row.appendChild(bubble);
                messagesContainer.appendChild(row);
                messagesContainer.style.display = 'block';
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
                        if (data && data.messages && data.messages.length > 0) {
                            data.messages.forEach(function (message) {
                                appendMessage(message);
                                lastMessageId = message.id;
                            });
                            scrollToBottom();
                        }

                        if (messagesContainer.children.length === 0) {
                            messagesContainer.style.display = 'none';
                        } else {
                            messagesContainer.style.display = 'block';
                        }

                        if (defaultChatHeight === null && chatBox) {
                            defaultChatHeight = chatBox.style.height || '420px';
                        }

                        if (chatBox) {
                            if (adminOnline === false && messagesContainer.children.length === 0) {
                                chatBox.style.height = '260px';
                            } else if (defaultChatHeight) {
                                chatBox.style.height = defaultChatHeight;
                            }
                        }
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
            
            function checkStatusAndOpen() {
                if (defaultChatHeight === null && chatBox) {
                    defaultChatHeight = chatBox.style.height || '420px';
                }
                fetch(statusUrl)
                    .then(function(res) { return res.json(); })
                    .then(function(data) {
                        adminOnline = !!data.online;
                        console.log('Admin Online Status:', data.online);
                        chatBox.style.display = 'flex';
                        
                        // Always load messages and start polling, regardless of status
                        if (lastMessageId === null) {
                            loadMessages(true);
                        }
                        startPolling();

                        if (data.online) {
                            // Online -> Chat Mode
                            headerTitle.textContent = 'Live Chat';
                            chatModeContainer.style.display = 'flex';
                            ticketModeContainer.style.display = 'none';
                        } else {
                            // Offline -> Ticket Mode
                            headerTitle.textContent = 'Leave a Message';
                            chatModeContainer.style.display = 'none';
                            ticketModeContainer.style.display = 'flex';
                        }
                    })
                    .catch(function() {
                        adminOnline = false;
                        // Fallback
                        chatBox.style.display = 'flex';
                        headerTitle.textContent = 'Leave a Message';
                        chatModeContainer.style.display = 'none';
                        ticketModeContainer.style.display = 'flex';
                        // Still try to load messages if possible
                        if (lastMessageId === null) loadMessages(true);
                        startPolling();
                    });
            }

            if (toggleButton && chatBox) {
                toggleButton.addEventListener('click', function () {
                    var isVisible = chatBox.style.display === 'flex';
                    if (isVisible) {
                        chatBox.style.display = 'none';
                        stopPolling();
                    } else {
                        checkStatusAndOpen();
                    }
                });

                closeButton.addEventListener('click', function () {
                    chatBox.style.display = 'none';
                    stopPolling();
                });

                // Chat Form Submit
                if (chatForm) {
                    chatForm.addEventListener('submit', function (e) {
                        e.preventDefault();
                        var content = chatInput.value.trim();
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
                                    chatInput.value = '';
                                    appendMessage(data.message);
                                    lastMessageId = data.message.id;
                                    scrollToBottom();
                                }
                            })
                            .catch(function () {
                            });
                    });
                }
                
                // Ticket Form Submit
                if (ticketForm) {
                    ticketForm.addEventListener('submit', function (e) {
                        e.preventDefault();
                        var content = ticketInput.value.trim();
                        if (!content) return;
                        
                        var btn = ticketForm.querySelector('button');
                        var originalText = btn.textContent;
                        btn.disabled = true;
                        btn.textContent = 'Sending...';
                        
                        fetch(ticketUrl, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': csrfToken
                            },
                            body: JSON.stringify({ content: content })
                        })
                        .then(function(res) { return res.json(); })
                        .then(function(data) {
                             ticketInput.value = '';
                             ticketSuccess.style.display = 'block';
                             btn.disabled = false;
                             btn.textContent = originalText;
                             
                             // Hide success message after 3 seconds
                             setTimeout(function() {
                                 ticketSuccess.style.display = 'none';
                             }, 3000);
                        })
                        .catch(function() {
                            btn.disabled = false;
                            btn.textContent = originalText;
                            alert('Failed to send ticket. Please try again.');
                        });
                    });
                }
            }
        })();
    </script>
@endif

@include('layouts.footer')
