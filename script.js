$(document).ready(function () {
    $("form").submit(function () {
        // Получение ID формы
        var formID = $(this).attr('id');
        // Добавление решётки к имени ID
        var formNm = $('#' + formID);
        $.ajax({
            type: "POST",
            url: '/send.php',
            data: formNm.serialize(),
            beforeSend: function () {
                // Вывод текста в процессе отправки
                $("#questions").html("");
                $(formNm).html('<p>Отправка...</p>');
            },
            success: function (data) {
                // Вывод текста результата отправки
                $(formNm).html('<object type="image/svg+xml" data="img/succes.svg" width="100"></object><p class="success">'+data+'</p>');
                 setTimeout(function() {
                     window.location.replace("/");
                     }, 
                     5000
                 );
            },
            error: function (jqXHR, text, error) { 
                // Вывод текста ошибки отправки
                $(formNm).html('<object type="image/svg+xml" data="img/error.svg" width="100"></object><p class="error">Сообщение не отправлено!</p>');
                
                setTimeout(function() {
                    window.location.replace("form.html");
                    }, 
                    5000
                );
            }
        });
        return false;
    });
});