$(function () {
    const ph = document.querySelector('#ph');
    let type = ph.dataset.type;

    ph.addEventListener('click', function (e) {
        e.preventDefault();

        $.ajax({
            url: 'http://localhost:9010/public/articles/10/like/' + type,
            method: 'POST'
        }).then(function (data) {
            ph.dataset.type = type === 'like' ? 'dislike' : 'like';
            type = ph.dataset.type;

            ph.classList.toggle('heart');
            ph.classList.toggle('unheart');
            ph.innerText = data.likes;
        });
    });
});
