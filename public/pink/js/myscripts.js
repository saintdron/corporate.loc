jQuery(document).ready(function ($) {
    $(".btn-french-5").on('click', function (e) {
        e.preventDefault();
        $("#dialog-confirm").dialog({
            autoOpen: false,
            resizable: false,
            height: "auto",
            width: 400,
            modal: true,
            buttons: {
                "Удалить": function () {
                    $(this).dialog("close");
                    $(e.target).trigger("click.confirmed");
                },
                "Отмена": function () {
                    $(this).dialog("close");
                    $(e.target).trigger('blur');
                }
            }
        });
        $("#dialog-confirm").dialog("open");
    });

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

    $('input[name=fixed]').on('change', function (e) {
        let $label = $(this).closest('label');
        let data = 'fixed=';
        if ($(this).is(":checked")) {
            $label.find('span').text('Открепить');
            $label.addClass('btn-come-to-me-4').removeClass('btn-clear-3');
            data += true;
        } else {
            $label.find('span').text('Закрепить');
            $label.addClass('btn-clear-3').removeClass('btn-come-to-me-4');
            data += false;
        }
        $.ajax({
            url: $(this).attr('data-action'),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            data: data,
            datatype: 'text',
            success: function (result) {
                console.log(result);
            },
            error: function () {
                console.log('error');
            }
        });
    });
});