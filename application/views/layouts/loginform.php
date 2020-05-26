<form id="login-form">
    <div id="login-error"></div>
    <div class="form-group">
        <label for="identity">Логин</label>
        <input class="form-control" id="identity" aria-describedby="emailHelp" required>
    </div>
    <div class="form-group">
        <label for="password">Пароль</label>
        <input type="password" class="form-control" id="password" required>
    </div>
    <button type="submit" class="btn btn-primary">Войти</button>
</form>
<script>
    $(function () {
        $('#login-form').on('submit', function (el) {
            el.preventDefault();
            if ($('#password').val() !== "" && $('#identity').val() !== "") {
                $('#login-error').removeClass('show');
                $('#cssload-jumping').addClass('show');

                $.ajax({
                    url: '<?=site_url('/auth/login/')?>',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        identity: $('#identity').val(),
                        password: $('#password').val(),
                    },
                })
                    .done(function (data) {
                        $('cssload-jumping').removeClass('show');
                        if (data.success != undefined) {
                            $('#login-success').html(data.success);
                            $('#login-success').addClass('show');
                            window.location.replace(data.redirect_to);
                        }
                        if (data.error != undefined) {
                            $('#login-error').html(data.error);
                            $('#login-error').addClass('show');
                        }
                    });
            } else {
                $('#login-error').html("<p>Не введен логин/пароль!</p>");
                $('#login-error').addClass('show');
            }
        });
    });
</script>