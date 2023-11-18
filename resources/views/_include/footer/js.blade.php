<script>
    function setPostData(action, id, $params = []) {
        var json = {};
        if (action == 'favorite') {
            json = {
                question_id: id
            };
        } else if (action == 'rate') {
            json = {
                question_id: id,
                is_correct: $params['is_correct']
            };
        }

        return json;
    }
    @if (Route::currentRouteName() === 'top.index' || Route::currentRouteName() === 'list.index')
        $('.p-list__icon--favorite').click(function() {
            var url = '';
            var isDelete = 0;

            if ($(this).hasClass('p-list__icon--favorited')) {
                url = '{{ url('/favorite/delete') }}';
                isDelete = 1;
            } else {
                url = '{{ url('/favorite/register') }}';
            }
            var action = 'favorite';
            var id = $(this).parent('.p-list__icons').attr('question-data');
            console.log(url);
            $.ajax({
                    type: 'get',
                    url: url,
                    dataType: 'json',
                    data: setPostData(action, id)
                })
                .done((res) => {
                    console.log(res);
                    if (isDelete) {
                        $(this).removeClass('pink-text');
                        $(this).removeClass('p-list__icon--favorited');
                        $(this).addClass('grey-text');
                    } else {
                        $(this).removeClass('grey-text');
                        $(this).addClass('p-list__icon--favorited');
                        $(this).addClass('pink-text');
                    }
                })
                .fail((error) => {
                    console.log(error.statusText);
                });
        });
        // TODO:.p-list__icon押したときでまとめる
        $('.p-list__icon--rate').click(function() {
            var url = '';
            var is_correct = 1;
            url = "{{ url('/rate') }}";
            var action = 'rate';
            if ($(this).hasClass('p-list__icon--thumb_down')) {
                is_correct = 0;
            }
            var id = $(this).parent('.p-list__icons').attr('question-data');
            console.log(setPostData(action, id, {
                'is_correct': is_correct
            }));
            if (!$(this).hasClass('p-list__icon--rated')) {
                $(this).removeClass('grey-text');
                $(this).addClass('amber-text');
                $(this).addClass('p-list__icon--rated');
                $.ajax({
                    type: 'get',
                    url: url,
                    dataType: 'json',
                    data: setPostData(action, id, {
                        'is_correct': is_correct
                    })
                }).done((res) => {
                    console.log(res);
                    $(this).removeClass('grey-text');
                    $(this).addClass('amber-text');
                }).fail((error) => {
                    console.log(error.statusText);
                });
            }
        });
    @endif
</script>
