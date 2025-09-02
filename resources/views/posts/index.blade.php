<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Real-Time Notifications</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    @vite(['resources/js/app.js'])
</head>
<body>
    <div class="container mt-5">
        <h1>Real-Time Notifications</h1>
        @auth
            <form method="POST" action="{{ route('posts.store') }}">
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">Post Title</label>
                    <input type="text" name="title" id="title" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="body" class="form-label">Post Body</label>
                    <textarea name="body" id="body" class="form-control" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Create Post</button>
            </form>
            <div id="notifications" class="mt-3">
                <h3>Notifications</h3>
                <ul id="notification-list" class="list-group"></ul>
            </div>
        @else
            <p>Please <a href="{{ route('login') }}">log in</a> to create posts and receive notifications.</p>
        @endauth
    </div>
    <script>
        @auth
            window.Echo.channel('notifications')
                .listen('.post.created', (e) => {
                    const notificationList = document.getElementById('notification-list');
                    const li = document.createElement('li');
                    li.className = 'list-group-item';
                    li.textContent = e.message;
                    notificationList.prepend(li);
                });
        @endauth
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>