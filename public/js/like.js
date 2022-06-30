$(function () {
    const ph = document.querySelector('#ph');

    ph.addEventListener('click', function (e) {
        e.preventDefault();
        let type = ph.dataset.type;
        let href = '';
        if (type === 'like') {
            href = ph.dataset.likeHref;
        } else {
            href = ph.dataset.dislikeHref;
        }

        $.ajax({
            url: href,
            method: 'POST'
        }).then(function (data) {
            ph.dataset.type = type === 'like' ? 'dislike' : 'like';
            type = ph.dataset.type;

            if (type === 'like') {
                ph.classList.remove('unheart');
                ph.classList.add('heart');
            } else {
                ph.classList.remove('heart');
                ph.classList.add('unheart');
            }

            ph.innerText = '(likes ' + data.likes + ')';
        });
    });
});
