<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php
$status = ['К выполнению', 'Выполняется', 'Выполнена', 'Отменена'];
$priority = ['Высокий', 'Средний', 'Низкий'];
$date_filter_title = ['Все', 'На сегодня', 'На неделю', 'На будущее'];
$cls_actve = 'btn-primary';
$cls_unactive = 'btn-secondary';
$btn_priority = 1;
?>


<div class="row">
    <div class="col-lg-12">
        <div class="btn-group btn-group-sm list-type" role="group" aria-label="Вид списка">
            <button data-url="<?=base_url('/todolist/?mode=admin')?>" type="button" class="btn <?=($mode=='admin')?$cls_actve:$cls_unactive?> btn-mode">Администратор</button>
            <button data-url="<?=base_url('/todolist/?mode=director')?>" type="button" class="btn <?=($mode=='director')?$cls_actve:$cls_unactive?> btn-mode">Руководитель</button>
            <button data-url="<?=base_url('/todolist/?mode=empl')?>" type="button" class="btn <?=($mode=='empl')?$cls_actve:$cls_unactive?> btn-mode">Работник</button>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">

        <? if ($mode === 'director') { ?>
            <a href="#" id="newTask" class="btn btn-success btn-sm"><i class="fa fa-add"></i>Новая задача</a>
            <!-- <a href="#" id="newTask" data-toggle="modal" data-target="#myModal" class="btn btn-success btn-sm"><i class="fa fa-add"></i>Новая задача</a> -->
            <div class="btn-group btn-group-sm" role="group">
                <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?
                    if(!is_null($selected_user)) {
                        foreach ($users as $user) {
                            if($user->user_id == $selected_user) {
                                echo $user->firstname . " " . $user->lastname;
                            }
                        }
                    } else {
                        echo "Выберите руководителя";
                    } ?>
                </button>
                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                    <?if(count($users) > 0) {
                        foreach ($users as $user) {
                            echo "<a class='dropdown-item' href='?mode=director&user={$user->user_id}'>{$user->firstname} {$user->lastname}</a>";
                        }
                    } ?>
                </div>
            </div>
        <? } ?>
        <? if ($mode === 'admin') { ?>
            <a href="<?php echo site_url('users/create'); ?>" class="btn btn-primary btn-sm">Добавить пользователя</a>
            <a href="<?php echo site_url('users'); ?>" class="btn btn-primary btn-sm">Список пользователей</a>
        <? } ?>
        <? if ($mode === 'empl') { ?>
            <div class="btn-group btn-group-sm" role="group">
                <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?
                    if(!is_null($selected_user)) {
                        foreach ($users as $user) {
                            if($user->user_id == $selected_user) {
                                echo $user->firstname . " " . $user->lastname;
                            }
                        }
                    } else {
                        echo "Выберите работника";
                    } ?>
                </button>
                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                    <?if(count($users) > 0) {
                        foreach ($users as $user) {
                            echo "<a class='dropdown-item' href='?mode=empl&user={$user->user_id}'>{$user->firstname} {$user->lastname}</a>";
                        }
                    } ?>
                </div>
            </div>
            <? if(!is_null($selected_user)) { ?>
            <div class="btn-group btn-group-sm" role="group">
                <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?
                    if(!is_null($date_filter)) {
                        echo $date_filter_title[$date_filter];
                    } else {
                        echo "Фильтр по дате завершения";
                    } ?>
                </button>
                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                    <? foreach ($date_filter_title as $key => $val) {
                        echo "<a class='dropdown-item' href='?mode=empl&user={$selected_user}&date_filter={$key}'>{$val}</a>";
                    } ?>
                </div>
            </div>
            <? } ?>
        <? } ?>

    </div>
</div>
<div class="row">
    <div class="col-lg-12" style="margin-top: 10px;">
        <?php
        echo '<table class="table table-hover table-sm">';
        echo '<thead class="thead-default">
            <tr>
                <th>Задача</th>
                <th>Приоритет</th>
                <th>Дата окончания</th>
                <th>Ответственный</th>
                <th>Статус</th>
            </tr>
            </thead>';
        if (!empty($todolist)) {
            echo "<tbody>";
            foreach ($todolist as $task) {
                if($task->status == 2) {
                    $title_cls = "green";
                    $tr_cls = "table-success";
                } else {
                    if(strtotime($task->end_date) < strtotime(date('Y-m-d' ))) {
                        $title_cls = "red";
                        $tr_cls = "table-danger";
                    } else {
                        $title_cls = "grey";
                        $tr_cls = "table-active";
                    }
                }
                echo "<tr class='{$tr_cls} task' 
                    data-task_id='{$task->todolist_id}' 
                    data-title='{$task->title}' 
                    data-description='{$task->description}' 
                    data-priority='{$task->priority}' 
                    data-start='{$task->start_date}' 
                    data-end='{$task->end_date}'
                    data-worker='{$task->worker_id}' 
                    data-status='{$task->status}'>";
                echo "<td style='color: {$title_cls}'>{$task->title}</td><td>{$priority[$task->priority]}</td><td>{$task->end_date}</td><td>{$task->firstname} {$task->lastname}</td><td>{$status[$task->status]}</td>";
                echo "</tr>";
            }
            echo "</tbody></table>";
        } else {
            echo "<tbody><tr><td colspan='4'>Нет текущих задач</td></tr></tbody></table>";
        }
        ?>
    </div>
</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Новая задача</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="task-form" action="/todolist/add" method="post">
                    <div class="form-group">
                        <label for="title" class="col-form-label-sm">Заголовок задачи:</label>
                        <input type="text" class="form-control form-control-sm" id="title" name="title" required>
                    </div>
                    <div class="form-group">
                        <label for="description" class="col-form-label-sm">Описание задачи:</label>
                        <textarea class="form-control form-control-sm" id="description" name="description"></textarea>
                    </div>
                    <div class="form-group">
                        <div class="btn-group btn-group-sm" role="group" aria-label="Приоритет">
                            <label for="description" class="col-form-label-sm">Приоритет задачи:</label>
                        </div>
                        <div class="btn-group btn-group-sm" role="group" aria-label="Приоритет">
                            <button data-priority="0" type="button" class="btn <?=($btn_priority==0)?$cls_actve:$cls_unactive?> btn-priority">Высокий</button>
                            <button data-priority="1" type="button" class="btn <?=($btn_priority==1)?$cls_actve:$cls_unactive?> btn-priority">Средний</button>
                            <button data-priority="2" type="button" class="btn <?=($btn_priority==2)?$cls_actve:$cls_unactive?> btn-priority">Низкий</button>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col">
                            <label for="start-date" class="col-form-label-sm">Дата начала:</label>
                            <input type="date" class="form-control form-control-sm" id="start-date" name="start-date" required>
                        </div>
                        <div class="col">
                            <label for="end-date" class="col-form-label-sm">Дата окончания:</label>
                            <input type="date" class="form-control form-control-sm" id="end-date" name="end-date" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col">
                            <label class="col-form-label-sm" for="worker">Ответственный</label>
                            <select class="custom-select mr-sm-2" id="worker" name="worker" required>
                                <option selected>Выберите...</option>
                                <?if(count($workers) > 0) {
                                    foreach ($workers as $worker) {
                                        echo "<option id='option_{$worker->user_id}' value='{$worker->user_id}'>{$worker->firstname} {$worker->lastname}</option>";
                                    }
                                } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col">
                            <label class="col-form-label-sm" for="status">Статус</label>
                            <select class="custom-select mr-sm-2" id="status" name="status" required>
                                <? foreach ($status as $key => $val) {
                                    echo "<option id='status_{$key}' value='{$key}'>{$val}</option>";
                                } ?>
                            </select>
                        </div>
                    </div>
                    <input type="hidden" id="priority" name="priority" value="1">
                    <input type="hidden" id="task_id" name="task_id" value="1">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                <button id="btn-submit" type="button" class="btn btn-primary">Сохранить</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="myDialog" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="dialogLabel">Внимание</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h6 id="dialogMessage"></h6>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(function () {
        var mode = '<?=$mode?>';
        var url = '';
        <? if(!is_null($selected_user)) {
                echo  "var director_id = {$selected_user};";
            } else {
                echo  "var director_id = null;";
            }?>

        $('.btn-mode').on('click', function (el) {
            var link = $(el.target).data("url");
            window.location.replace(link);
        });

        $('.btn-priority').on('click', function (el) {
            if(mode == 'empl') return;

            var priority = $(el.target).data("priority");
            $('#priority').val(priority);
            $('.btn-priority').removeClass('btn-secondary').removeClass('btn-primary').addClass('btn-secondary');
            $(el.target).removeClass('btn-secondary').addClass('btn-primary');
        });

        $('#newTask').on('click', function (event) {
            if(director_id == null) {
                $('#dialogMessage').text('Не выбран руководитель!');
                $('#myDialog').modal('show');
                return;
            }
            $('#modalLabel').text('Новая задача');
            url = '<?=base_url('/todolist/add')?>';
            $('#status').prop('disabled', true);
            $('#myModal').modal('show');
        });

        $('.task').on('click', function (event) {
            if(mode == 'admin') return;
            var prop_disabled = false;

            if(mode == 'empl') prop_disabled = true;
            $('#modalLabel').html('Редактирование задачи');
            url = '<?=base_url('/todolist/edit')?>';
            $('#task_id').val($(event.currentTarget).data("task_id"));
            $('#title').val($(event.currentTarget).data("title")).prop('disabled', prop_disabled);
            $('#description').val($(event.currentTarget).data("description")).prop('disabled', prop_disabled);
            $('#start-date').val($(event.currentTarget).data("start")).prop('disabled', prop_disabled);
            $('#end-date').val($(event.currentTarget).data("end")).prop('disabled', prop_disabled);
            $('#option_'+$(event.currentTarget).data("worker")).prop('selected',true);
            $('#status_'+$(event.currentTarget).data("status")).prop('selected',true);
            $('.btn-priority').each(function() {
                if($(this).data("priority") == $(event.currentTarget).data("priority")) {
                    $('.btn-priority').removeClass('btn-secondary').removeClass('btn-primary').addClass('btn-secondary');
                    $(this).removeClass('btn-secondary').addClass('btn-primary');
                    $('#priority').val($(event.currentTarget).data("priority"));
                }
            });
            $('#worker').prop('disabled', prop_disabled);
            $('#status').prop('disabled', false);
            $('#myModal').modal('show');
        })

        $('#btn-submit').on('click', function (event) {
            if(mode == 'director') {
                var user_id = $('#worker').val();
            } else {
                var user_id = <?=($selected_user)?$selected_user:'null'?>;
            }

            $.ajax({
                method:'POST',
                url: url,
                data:'' +
                    'id=' + $('#task_id').val() +
                    '&title=' + $('#title').val() +
                    '&description=' + $('#description').val() +
                    '&priority=' + $('#priority').val() +
                    '&start-date=' + $('#start-date').val() +
                    '&end-date=' + $('#end-date').val() +
                    '&worker=' + user_id +
                    '&status=' + $('#status').val() +
                    '&director_id=' + director_id +
                    '&mode=' + mode,
                success:function(data){
                    console.log(data);
                    if(data.success == 'success') {
                        window.location = data.redirect_to;
                    } else {
                        data.errors.forEach(function(item, i, arr) {
                            var el = document.getElementById(item);
                            $(el).removeClass('is-invalid').removeClass('is-valid');
                            $(el).addClass('is-invalid');
                        });
                        data.succeses.forEach(function(item, i, arr) {
                            var el = document.getElementById(item);
                            $(el).removeClass('is-invalid').removeClass('is-valid');
                            $(el).addClass('is-valid');
                        });
                    }
                }
            });


        })
    });
</script>