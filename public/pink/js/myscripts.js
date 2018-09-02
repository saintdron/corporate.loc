jQuery(document).ready(function ($) {
    $('.commentlist li').each(function (i) {
        $(this).find('div.commentNumber').text('#' + (i + 1));
    });

    $('#commentform').on('click', '#submit', function (e) {
        e.preventDefault();
        let $commentForm = $(e.delegateTarget);
        $('.wrap_status').text('Сохранение комментария')
            .fadeIn(300, function () {
                let data = $commentForm.serializeArray();
                $.ajax({
                    url: $commentForm.attr('action'),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'POST',
                    data: data,
                    datatype: 'JSON',
                    success: function (result) {
                        if (result.error) {
                            $('.wrap_status').css('color', 'red')
                                .append('<br/><strong>Ошибка: </strong>' + result.error.join('<br/>'))
                                .delay(3000)
                                .fadeOut(300);
                        } else if (result.success) {
                            $('.wrap_status').css('color', 'green')
                                .append('<br/><strong>Сохранено!</strong>')
                                .delay(1000)
                                .fadeOut(300, function () {
                                    if (result.data.parent_id > 0) {
                                        $('#respond').closest('li.comment')
                                            .append('<ul class="children">' + result.comment + '</ul>');
                                    } else {
                                        if ($.contains('#comments', 'ol.commentlist')) {
                                            $('ol.commentlist').append(result.comment);
                                        }
                                        else {
                                            $('#comments-title').after("<ol class='commentlist group'>" + result.comment + "</ol>");
                                        }
                                        let commentsCount = $('#comments-title span').text();
                                        $('#comments-title span').text(+commentsCount + 1);
                                    }
                                    $('#cancel-comment-reply-link').click();
                                    $('#respond input[type="text"], #respond textarea').val('');
                                });
                        }
                    },
                    error: function () {
                        $('.wrap_status').css('color', 'green')
                            .append('<br/><strong>Ошибка!</strong>')
                            .delay(2000)
                            .fadeOut(300, function () {
                                $('#cancel-comment-reply-link').click();
                            });
                    }
                });
            }).css('color', 'initial');
    });
});