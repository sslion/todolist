<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row">
    <div class="col-lg-12">
        <h1>Новый пользователь</h1>
        <?php echo form_open(); ?>
        <div class="form-row">
            <div class="form-group col-md-4">
                <?php
                echo form_label('Фамилия', 'first_name');
                echo form_error('first_name');
                echo form_input('first_name', set_value('first_name'), 'class="form-control"');
                ?>
            </div>
            <div class="form-group col-md-4">
                <?php
                echo form_label('Имя', 'last_name');
                echo form_error('last_name');
                echo form_input('last_name', set_value('last_name'), 'class="form-control"');
                ?>
            </div>
            <div class="form-group col-md-4">
                <?php
                echo form_label('Отчество', 'middle_name');
                echo form_error('middle_name');
                echo form_input('middle_name', set_value('middle_name'), 'class="form-control"');
                ?>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <?php
                echo form_label('Логин', 'username');
                echo form_error('username');
                echo form_input('username', set_value('username'), 'class="form-control"');
                ?>
            </div>
            <div class="form-group col-md-4">
                <?php
                echo form_label('Пароль', 'password');
                echo form_error('password');
                echo form_password('password', '', 'class="form-control"');
                ?>
            </div>
            <div class="form-group col-md-4">
                <?php
                echo form_label('Повторите пароль', 'password_confirm');
                echo form_error('password_confirm');
                echo form_password('password_confirm', '', 'class="form-control"');
                ?>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <div class="btn-group-vertical" role="group" aria-label="Вид списка">
                    <button  id="director" data-value="director" type="button" class="btn btn-primary">Руководитель</button>
                    <button  id="empl" data-value="empl" type="button" class="btn btn-secondary">Работник</button>
                </div>
            </div>
            <div class="form-group col-md-6">
                <label for="directorList">Руководители</label>
                <select class="form-control" name="directorList" id="directorList" disabled>
                    <? if (empty($directors)) {
                        echo "<option value='-1' active></option>";
                    } else {
                        foreach ($directors as $director) {
                            echo "<option value='{$director->id}'>{$director->firstname} {$director->lastname}</option>";
                        }
                    } ?>
                </select>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
            </div>
            <div class="form-group col-md-4">
                <?php echo form_submit('submit', 'Добавить пользователя', 'class="btn btn-primary btn-lg btn-block"'); ?>
            </div>
            <div class="form-group col-md-4">
                <?php echo anchor('/users', 'Отмена', 'class="btn btn-warning btn-lg btn-block"'); ?>
            </div>
        </div>
        <input type="hidden" name="role" id="role" value="director">
        <?php echo form_close(); ?>
    </div>
</div>

<script>
    $(function () {
        $('#director').on('click', function (el) {
            $('#role').val('director');
            $('#directorList').prop('disabled', true)
            $('#director').removeClass('btn-primary').removeClass('btn-secondary').addClass('btn-primary');
            $('#empl').removeClass('btn-primary').removeClass('btn-secondary').addClass('btn-secondary');
        });
        $('#empl').on('click', function (el) {
            $('#role').val('empl');
            $('#directorList').prop('disabled', false)
            $('#empl').removeClass('btn-primary').removeClass('btn-secondary').addClass('btn-primary');
            $('#director').removeClass('btn-primary').removeClass('btn-secondary').addClass('btn-secondary');
        });
    });
</script>