document.addEventListener('DOMContentLoaded', function() {
    const commentForm = document.getElementById('ringcentral-comment-form');
    const commentTextarea = document.getElementById('ringcentral-comment');
    const saveCommentBtn = document.getElementById('save-ringcentral-comment');

    if (saveCommentBtn) {
        saveCommentBtn.addEventListener('click', function() {
            const callId = this.dataset.callId;
            const comment = commentTextarea.value.trim();

            if (!comment) {
                alert('Please enter a comment');
                return;
            }

            fetch('/ringcentral/add-comment', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    call_id: callId,
                    comment: comment
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    alert('Comment saved successfully');
                    commentTextarea.value = comment; // Keep the comment in textarea
                } else {
                    alert('Error saving comment: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error saving comment');
            });
        });
    }
});