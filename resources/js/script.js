document.addEventListener('DOMContentLoaded', function () {
    var elems = document.querySelectorAll('select');
    var instances = M.FormSelect.init(elems, {});
});

document.addEventListener('DOMContentLoaded', function () {
    var elems = document.querySelectorAll('.sidenav');
    var instances = M.Sidenav.init(elems, {});
});

document.addEventListener('DOMContentLoaded', function () {
    var elems = document.querySelectorAll('input#input_text, textarea#textarea2');
    var instances = M.CharacterCounter.init(elems);
});

document.addEventListener('DOMContentLoaded', function () {
    var elems = document.querySelectorAll('.sidenav');
    var instances = M.Sidenav.init(elems, {});
});

$('.p-list__answer').addClass("p-list__answer--display_none");

// 正解を見るスイッチ
$('.answer-switch').click(function () {
    var answer = $('.p-list__answer');
    if (answer.hasClass('p-list__answer--display_none')) {
        answer.removeClass("p-list__answer--display_none");
    } else {
        answer.addClass("p-list__answer--display_none");
    }
});