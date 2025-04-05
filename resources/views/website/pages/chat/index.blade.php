@extends('website.layouts.master')

@section('title', 'Chat')

<!-- تضمين ملفات CSS الخاصة بالتصميم -->
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        height: 100vh;
    }

    .container {
        max-width: 1200px;
        margin: 2rem auto;
        display: grid;
        grid-template-columns: 1fr 300px;
        gap: 2rem;
        height: calc(100vh - 4rem);
        padding: 0 1rem;
    }

    .chat-container {
        background: white;
        border-radius: 10px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        display: flex;
        flex-direction: column;
        overflow: hidden;
    }

    .chat-header {
        padding: 1rem;
        background: #f8f8f8;
        border-bottom: 1px solid #eee;
    }

    .trainer-info {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .trainer-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
    }

    .trainer-details h3 {
        font-size: 1rem;
        color: #333;
    }

    .status {
        font-size: 0.8rem;
        color: #666;
    }

    .status.online::before {
        content: "";
        display: inline-block;
        width: 8px;
        height: 8px;
        background: #4CAF50;
        border-radius: 50%;
        margin-right: 5px;
    }

    .status.offline::before {
        content: "";
        display: inline-block;
        width: 8px;
        height: 8px;
        background: #666;
        border-radius: 50%;
        margin-right: 5px;
    }

    .chat-messages {
        flex: 1;
        padding: 1rem;
        overflow-y: auto;
    }

    .message {
        margin-bottom: 1rem;
        max-width: 70%;
    }

    .message.received {
        margin-right: auto;
    }

    .message.sent {
        margin-left: auto;
    }

    .message-content {
    padding: 0.8rem;
    border-radius: 10px;
    position: relative;
    display: flex;
    flex-direction: column;
}

.message-time {
    font-size: 0.7rem;
    color: #666;
    margin-top: 0.3rem;
    align-self: flex-end; /* لجعل التاريخ في أسفل الرسالة */
}
    .message.received .message-content {
        background: #f0f0f0;
    }

    .message.sent .message-content {
        background: #4CAF50;
        color: white;
    }

    .chat-input {
        padding: 1rem;
        background: #f8f8f8;
        border-top: 1px solid #eee;
    }

    #chatForm {
        display: flex;
        gap: 1rem;
    }

    #messageInput {
        flex: 1;
        padding: 0.8rem;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 0.9rem;
    }

    .chat-actions {
        display: flex;
        gap: 0.5rem;
    }

    button {
        padding: 0.8rem;
        border: none;
        background: none;
        cursor: pointer;
        border-radius: 5px;
        transition: background 0.3s;
    }

    button:hover {
        background: #eee;
    }

    .send-btn {
        background: #4CAF50;
        color: white;
    }

    .send-btn:hover {
        background: #45a049;
    }

    .sidebar {
        display: flex;
        flex-direction: column;
        gap: 2rem;
    }

    .trainer-list, .chat-info {
        background: white;
        padding: 1rem;
        border-radius: 10px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        
    }

    .trainer-item {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1rem;
        border-radius: 5px;
        cursor: pointer;
        transition: background 0.3s;
    }

    .trainer-item:hover, .trainer-item.active {
        background: #f0f0f0;
    }

    .trainer-item img {
        width: 40px;
        height: 40px;
        border-radius: 50%;
    }

    .trainer-info h4 {
        font-size: 0.9rem;
        color: #333;
    }

    .trainer-info p {
        font-size: 0.8rem;
        color: #666;
    }

    .info-item {
        margin: 1rem 0;
    }

    .label {
        font-weight: bold;
        color: #333;
    }

    @media (max-width: 768px) {
        .container {
            grid-template-columns: 1fr;
        }
        
        .sidebar {
            display: none;
        }
    }
</style>

@section('main-content')
<div class="text" style="margin-bottom: 20px;">
    <a href="{{ route('home')}}" class="btn">
        <i class="fa fa-arrow-left" aria-hidden="true"></i> Home
    </a>
</div>
<div class="container">
    <!-- Chat Container -->
    <div class="chat-container">
        <!-- Chat Header -->
        <div class="chat-header" id="chat-header">
            <div class="trainer-info">
                <img src="{{ asset('images/default-avatar.png') }}" alt="" class="trainer-avatar">
                <div class="trainer-details">
                    <h3>Select a User to Chat</h3>
                    <span class="status offline">Offline</span>
                </div>
            </div>
        </div>

        <!-- Chat Messages -->
        <div class="chat-messages" id="messages">
            <div class="text-center text-muted alert alert-info" role="alert">No messages yet.</div>
        </div>

        <!-- Chat Input -->
        <div class="chat-input">
            <form id="chatForm" onsubmit="sendMessage(event)">
                <input type="text" id="message-input" class="form-control" placeholder="Type a message...">
                <div class="chat-actions">
                    <button id="emojiPickerButton">😊</button>
                    <button type="button" class="send-btn" id="send" disabled>
                        <span class="icon">➤</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Trainer List -->
        <div class="trainer-list">
            <h3>Available Trainers Or User({{ $users->count() }})</h3>
            <ul class="list-group" id="user-list">
                @foreach($users as $user)
                    <li class="trainer-item user-item"
                        data-id="{{ $user->id }}"
                        data-fullname="{{ $user->fullname }}"
                        id="user-{{ $user->id }}">
                        <img src="{{ asset('storage/profiles/' . ($user->image ?? 'default-avatar.png')) }}" alt="" class="trainer-avatar">
                        <div class="trainer-info">
                            <h4>{{ $user->fullname }}</h4>
                            <p>{{ ucfirst($user->user_type) }}</p>
                        </div>
                        @php
                            $countUnseenMsg = \App\Models\Message::where('sender_id', $user->id)->where('receiver_id', Auth::id())->where('seen', false)->count();
                        @endphp
                        <span class="{{ $countUnseenMsg > 0 ? 'badge bg-secondary' : '' }} status">
                            @if($countUnseenMsg > 0)
                                {{ $countUnseenMsg }}
                            @endif
                        </span>
                    </li>
                @endforeach
            </ul>
        </div>

        <!-- Chat Information -->
        <div class="chat-info">
            <h3>Chat Information</h3>
            <div class="info-item">
                <span class="label">Response Time:</span>
                <span>Usually within 5 minutes</span>
            </div>
            <div class="info-item">
                <span class="label">Available Hours:</span>
                <span>6:00 AM - 9:00 PM</span>
            </div>
        </div>
    </div>
</div>
@endsection

<!-- تضمين مكتبة jQuery قبل سكريبتاتك الخاصة -->
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/scripts.js') }}"></script>

<!-- سكريبتات الجافاسكريبت الخاصة بك -->
<script>
let activeUser = null;
let activeUserName = "";
let seenMessages = {};  // Track seen messages to prevent looping checkmarks

$(document).ready(function () {
    console.log("Page loaded. Waiting for user selection...");

    // Handle user selection
    $('#user-list').on('click', '.user-item', function () {
        $('.user-item').removeClass('active-user');
        $(this).addClass('active-user');

        activeUser = $(this).data('id');
        activeUserName = $(this).data('fullname');

        // Reset unseen count to 0 for selected user
        $("#unseen-" + activeUser).addClass('d-none');

        // Update chat header with selected user's info
        let userAvatar = $(this).find('img').attr('src') || "{{ asset('images/default-avatar.png') }}";
        let userStatus = $(this).find('.status').text() === '0' ? 'Offline' : 'Online';
        
        $('#chat-header').html(`
            <div class="trainer-info">
                <img src="${userAvatar}" alt="${activeUserName}" class="trainer-avatar">
                <div class="trainer-details">
                    <h3>${activeUserName}</h3>
                    <span class="status ${userStatus.toLowerCase()}">${userStatus}</span>
                </div>
            </div>
        `);

        $('#send').prop('disabled', false);
        

        // Fetch messages immediately when clicking a user
        fetchMessages();

        // Mark messages as seen once chat is open
        markAsSeen();

    });

    // Handle message sending
    $('#send').click(function () {
        let message = $('#message-input').val().trim();
        if (message === '' || activeUser === null) return;

        $.ajax({
            url: '/chat/send',
            method: 'POST',
            data: {
                message: message,
                receiver_id: activeUser,
                _token: '{{ csrf_token() }}'
            },
            success: function (data) {
                // Append message immediately with single checkmark
                appendMessage(data, true, '<i class="fa-solid fa-check text-primary"></i>');
                $('#message-input').val('');
            }
            
        });

    });

    // Handle sending message on Enter key press
    $('#message-input').keypress(function (e) {
        if (e.which == 13) {  // 13 is the Enter key
            e.preventDefault(); // منع إعادة تحميل الصفحة
            $('#send').click();
        }
    });

    // Fetch and display messages
    function fetchMessages() {
        if (activeUser === null) return;

        $.get('/chat/messages', { receiver_id: activeUser }, function (data) {
            $('#messages').html('');
            let unseenCount = 0;

            data.forEach(msg => {
                let checkmark = msg.seen
                    ? '<i class="fa-solid fa-check-double text-primary"></i>'
                    : '<i class="fa-solid fa-check text-primary"></i>';

                appendMessage(msg, msg.sender_id === parseInt(`{{ Auth::id() }}`), checkmark);

                if (!msg.seen && msg.sender_id !== parseInt(`{{ Auth::id() }}`)) {
                    unseenCount++;
                }
            });

            if (unseenCount > 0) {
                $("#unseen-" + activeUser)
                    .text(unseenCount)
                    .removeClass('d-none');
            } else {
                $("#unseen-" + activeUser).addClass('d-none');
            }
        });
    }
    // Poll for new messages every 1 second
    setInterval(fetchMessages, 1000);

    // Append message with correct checkmark
    function appendMessage(message, isSender, seenStatus) {
        let alignment = isSender ? 'message sent' : 'message received'; 
        let messageTime = new Date(message.created_at).toLocaleTimeString(); 
        let senderName = isSender ? 'You' : message.sender.fullname;

        $('#messages').append(
            `<div class="${alignment}">
                <div class="message-content">
                    ${message.message}
                    <small class="message-time">${messageTime} ${seenStatus}</small> 
                </div>
            </div>`
        );

        // التمرير التلقائي إلى الرسالة الأخيرة
        $('#messages').scrollTop($('#messages')[0].scrollHeight);
    }

    // Mark messages as seen
    function markAsSeen() {
        if (activeUser === null) return;

        $.post('/chat/mark-seen', {
            receiver_id: activeUser,
            _token: '{{ csrf_token() }}'
        }, function () {
            $('#messages .text-muted').each(function () {
                let text = $(this).html();
                if (text.includes('<i class="fa-solid fa-check text-primary"></i>') &&
                    !text.includes('<i class="fa-solid fa-check-double text-primary"></i>')) {
                    $(this).html(text.replace(
                        '<i class="fa-solid fa-check text-primary"></i>',
                        '<i class="fa-solid fa-check-double text-primary"></i>'
                    ));
                }
            });

            $("#unseen-" + activeUser).addClass('d-none');
        });
    }

    // Real-time unseen message count polling for all users
    function fetchUnseenCounts() {
        $.get('/chat/unseen-counts', function (data) {
            data.forEach(user => {
                let unseenBadge = $(`#unseen-${user.id}`);

                if (user.unseen > 0) {
                    unseenBadge
                        .text(user.unseen)
                        .removeClass('d-none');
                } else {
                    unseenBadge.addClass('d-none');
                }
            });
        });
    }
    // Initial fetch for unseen counts on page load
    fetchUnseenCounts();

    // Poll unseen counts for all users every 2 seconds
    setInterval(fetchUnseenCounts, 2000);
});
</script>
