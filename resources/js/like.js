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

    // Slider logic
    const sliderItems = document.querySelectorAll('.slider-item');
    const sliderPrevButton = document.querySelector('.slider-prev');
    const sliderNextButton = document.querySelector('.slider-next');
    let currentSlide = 0;
    let slideInterval;

    function showSlide(index) {
        sliderItems.forEach((item, i) => {
            if (i === index) {
                item.classList.remove('opacity-0');
                item.classList.add('opacity-100');
            } else {
                item.classList.remove('opacity-100');
                item.classList.add('opacity-0');
            }
        });
    }

    function nextSlide() {
        currentSlide = (currentSlide + 1) % sliderItems.length;
        showSlide(currentSlide);
    }

    function prevSlide() {
        currentSlide = (currentSlide - 1 + sliderItems.length) % sliderItems.length;
        showSlide(currentSlide);
    }

    if (sliderItems.length > 0) {
        showSlide(currentSlide); // Show the first slide initially

        if (sliderPrevButton && sliderNextButton) {
            sliderPrevButton.addEventListener('click', prevSlide);
            sliderNextButton.addEventListener('click', nextSlide);
        }

        // Auto-play slider
        slideInterval = setInterval(nextSlide, 5000); // Change slide every 5 seconds

        // Pause auto-play on hover
        const sliderContainer = document.querySelector('.slider-container');
        if (sliderContainer) {
            sliderContainer.addEventListener('mouseenter', () => clearInterval(slideInterval));
            sliderContainer.addEventListener('mouseleave', () => slideInterval = setInterval(nextSlide, 5000));
        }
    }
});
