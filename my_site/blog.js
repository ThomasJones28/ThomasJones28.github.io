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
});