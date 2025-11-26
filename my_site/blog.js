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

    // Sort posts by title and date (A/D)- Sort Suggestion #2
    const sortButtons = document.querySelectorAll('.sort-btn');
    const mainContainer = document.querySelector('main');

    sortButtons.forEach(function (btn) {
        btn.addEventListener('click', function () {
            const sortType = btn.getAttribute('data-sort');

            // Convert from nodelist to array
            let postsArray = Array.from(mainContainer.querySelectorAll('article'));

            // Sorting Logic
            if (sortType === 'title-asc') {
                postsArray.sort((a, b) =>
                    a.querySelector('h2').textContent.localeCompare(
                        b.querySelector('h2').textContent
                    )
                );
            }

            else if (sortType === 'title-desc') {
                postsArray.sort((a, b) =>
                    b.querySelector('h2').textContent.localeCompare(
                        a.querySelector('h2').textContent
                    )
                );
            }

            else if (sortType === 'date-asc') {
                postsArray.sort((a, b) =>
                    new Date(a.querySelector('i').textContent) -
                    new Date(b.querySelector('i').textContent)
                );
            }

            else if (sortType === 'date-desc') {
                postsArray.sort((a, b) =>
                    new Date(b.querySelector('i').textContent) -
                    new Date(a.querySelector('i').textContent)
                );
            }

            // Re-insert posts in the new order
            postsArray.forEach(post => mainContainer.appendChild(post));
        });
    });

    // Search posts by title and paragraphtext
    const searchInput = document.getElementById('post-search');
    const articles = document.querySelectorAll('main article');

    if (searchInput) {
        searchInput.addEventListener('input', function () {
            const term = searchInput.value.toLowerCase().trim();

            articles.forEach(function (article) {
                // Grab title text
                const title = article.querySelector('h2') ?
                    article.querySelector('h2').textContent.toLowerCase() : '';

                // Grab paragraph text
                const paragraphs = Array.from(article.querySelectorAll('p'))
                    .map(p => p.textContent.toLowerCase())
                    .join(' ');

                const haystack = title + ' ' + paragraphs;
                //Show if term appears, hide if it doesnt

                if (term === '' || haystack.includes(term)) {
                    article.style.display = '';
                } else {
                    article.style.display = 'none';
                }
            });
        });
    }
});