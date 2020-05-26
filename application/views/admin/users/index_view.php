<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row">
    <div class="col-lg-12">
        <a href="<?php echo base_url('users/create'); ?>" class="btn btn-success btn-sm">Добавить пользователя</a>
        <a href="<?php echo base_url('todolist'); ?>" class="btn btn-primary btn-sm">К списку задач</a>
    </div>
</div>
<div class="row">
    <div class="col-lg-12" style="margin-top: 10px;">
        <?php
        if (!empty($users)) {
            echo "<table class='table table-hover table-sm'>";
            echo "<thead class='thead-default'>";
            echo "<tr><th>Пользователь</th><th>Роль</th><th></th>";
            echo "</thead>";
            foreach ($users as $user) {
                echo "<tr>";
                echo "<td>{$user->firstname} {$user->lastname}</td>";
                if($user->role == -1) {
                    echo "<td>Администратор</td>";
                } else if($user->role == 0) {
                    echo "<td>Руководитель</td>";
                } else {
                    echo "<td>Работник</td>";
                }
                "<td>";
                if ($current_user->id != $user->id) echo anchor('admin/users/edit/' . $user->id, '<span class="glyphicon glyphicon-pencil"></span>') . ' ' . anchor('admin/users/delete/' . $user->id, '<span class="glyphicon glyphicon-remove"></span>');
                else echo '&nbsp;';
                echo "</td>";
                echo "</tr>";
            }
            echo "</table>";
        }
        ?>
    </div>
</div>
