// Asks for user confirmation before deleting blog post
document.addEventListener('DOMContentLoaded', function () {
    const forms = document.querySelectorAll('.delete-post-form');

    forms.forEach(function (form) {
        form.addEventListener('submit', function (event) {
            if (!confirm("Are you sure you want to delete this post?")) {
                event.preventDefault();
            }
        });
    });

    // Allow extra paragraphs to be toggled
    const toggleButtons = document.querySelectorAll('.toggle-post');

    toggleButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            // Extra content is the element right before the button
            const article = button.closest('article');
            if (!article) return;

            const extra = article.querySelector('.extra-content');
            if (!extra) return;

            // Toggle button text to match 
            const isHidden = extra.style.display === '' || extra.style.display === 'none';

            if (isHidden) {
                extra.style.display = 'block';
                button.textContent = 'Show less';
            } else {
                extra.style.display = 'none';
                button.textContent = 'Show more';
            }
        });
    });

    // Filter by school year
    const filterButtons = document.querySelectorAll('.filter-btn');
    const allPosts = document.querySelectorAll('article');

    filterButtons.forEach(function (btn) {
        btn.addEventListener('click', function () {
            const filter = btn.getAttribute('data-filter'); // first, second, third, or all

            allPosts.forEach(function (post) {
                if (filter === 'all') {
                    post.style.display = '';
                } else if (post.id.includes(filter)) {
                    post.style.display = '';
                } else {
                    post.style.display = 'none';
                }
            });
        });
    });
});