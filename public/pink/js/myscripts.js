jQuery(document).ready(function ($) {
    $(".btn-french-5").on('click', function (e) {
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
                }
            },
            close: function () {
                $(e.target).trigger('blur');
            }
        });
        e.preventDefault();
        $("#dialog-confirm").dialog("open");
    });

    $('.commentlist li').each(function (i) {
        $(this).find('div.commentNumber').text('#' + (i + 1));
    });

    $('#commentform').on('click', '#submit', function (e) {
        e.preventDefault();
        let $commentForm = $(e.delegateTarget);
        $('.wrap_status').css("border-color", '#b77a2b');
        $('.status').html('Сохранение комментария...<br>Cимуляция длительного процесса ;)');
        $('.wrap_status')
            .animate({
                opacity: 1
            }, 300)
            .delay(1000)
            .animate({
                    opacity: 1
                }, 0, function () {
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
                                $('.wrap_status').css("border-color", 'red');
                                $('.status').html('<strong style="color: red">Ошибка: </strong><br/>' + result.error.join('<br/>'))
                                $('.wrap_status').delay(3000)
                                    .animate({
                                        opacity: 0
                                    }, 300);
                            } else if (result.success) {
                                $('.wrap_status').css("border-color", 'green');
                                $('.status')
                                    .html('<strong style="color: green">Комментарий сохранен!</strong>');
                                $('.wrap_status').delay(1000)
                                    .animate({
                                        opacity: 0
                                    }, 300, function () {
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
                                            let commentWord = '';
                                            commentsCount = +commentsCount + 1;
                                            switch (commentsCount) {
                                                case 1:
                                                    commentWord = 'комментарий';
                                                    break;
                                                case 2:
                                                case 3:
                                                case 4:
                                                    commentWord = 'комментария';
                                                    break;
                                                default:
                                                    commentWord = 'комментариев';
                                            }
                                            $('#comments-title').html(`<span>${commentsCount}</span> ${commentWord}`);
                                        }
                                        $('#cancel-comment-reply-link').click();
                                        $('#respond input[type="text"], #respond textarea').val('');
                                    });
                            }
                        },
                        error: function () {
                            $('.status')
                                .html('<strong style="color: red">Ошибка!</strong>');
                            $('.wrap_status').delay(2000)
                                .animate({
                                    opacity: 0
                                }, 300, function () {
                                    $('#cancel-comment-reply-link').click();
                                });
                        }
                    });
                }
            ).css('color', 'initial');
    });

    $('input[name=fixed]').on('change', function (e) {
        let $label = $(this).closest('label');
        let data = 'fixed=';
        if ($(this).is(":checked")) {
            $label.find('span').text('Открепить');
            $label.addClass('btn-come-to-me-4')
                .removeClass('btn-clear-3')
                .attr('title', 'Убрать статью с главной страницы');
            data += true;
        } else {
            $label.find('span').text('Закрепить');
            $label.addClass('btn-clear-3')
                .removeClass('btn-come-to-me-4')
                .attr('title', 'Предложить статью на главной странице');
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
                // console.log(result);
            },
            error: function () {
                // console.log('error');
            }
        });
    });

    $(window).scroll(function () {
        if ($(this).scrollTop() > 1500) {
            $('.scrollup').fadeIn();
        } else {
            $('.scrollup').fadeOut();
        }
    });

    $('.scrollup').click(function () {
        $("html, body").animate({scrollTop: 0}, 600);
        return false;
    });
});