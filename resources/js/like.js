document.addEventListener('DOMContentLoaded', function () {
    // Like button logic
    document.querySelectorAll('.like-button').forEach(button => {
        button.addEventListener('click', function () {
            const postId = this.dataset.postId;
            const isLiked = this.dataset.liked === 'true';
            const icon = this.querySelector('i');
            const likesCountSpan = this.querySelector('.likes-count');

            axios.post(`/posts/${postId}/like`)
                .then(response => {
                    const data = response.data;
                    likesCountSpan.textContent = data.likes_count;
                    this.dataset.liked = data.is_liked;

                    if (data.is_liked) {
                        icon.classList.remove('far');
                        icon.classList.add('fas');
                    } else {
                        icon.classList.remove('fas');
                        icon.classList.add('far');
                    }
                })
                .catch(error => {
                    if (error.response && error.response.status === 401) {
                        // User is not authenticated, redirect to login
                        window.location.href = '/login';
                    } else {
                        console.error('Error toggling like:', error);
                    }
                });
        });
    });

    // Share button logic
    document.querySelectorAll('.share-button').forEach(button => {
        button.addEventListener('click', function (event) {
            event.stopPropagation(); // Prevent the document click listener from firing immediately
            const dropdown = this.closest('.relative').querySelector('.share-dropdown');
            dropdown.classList.toggle('hidden');
        });
    });

    // Close dropdowns when clicking outside
    document.addEventListener('click', function (event) {
        document.querySelectorAll('.share-dropdown').forEach(dropdown => {
            if (!dropdown.classList.contains('hidden') && !dropdown.contains(event.target)) {
                dropdown.classList.add('hidden');
            }
        });
    });
});
