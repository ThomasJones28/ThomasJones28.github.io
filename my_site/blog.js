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
});
