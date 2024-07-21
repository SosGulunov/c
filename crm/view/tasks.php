<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . "/functions.php";
onlyUser();
model('Task');
$task_model = new Task();
$tasks_by_priority = $task_model->get_all_by_priority();
$tasks_by_date = $task_model->get_all_by_date();
$done_count = 0;
$overdue_count = 0;



component('sidebar');
?>
<div class='app'>
    <main class='project'>
        <div class='project-info'>
            <h1>Все Задачи</h1>
            <h3><a href="<?php echo view('new_task') ?>"><i class='bx bx-plus'></i></a></h3>
        </div>
        <div class='project-tasks'>
            <div class='project-column'>
                <div class='project-column-heading'>
                    <h2 class='project-column-heading__title'>В процессе</h2><button class='project-column-heading__options'><i class="fas fa-ellipsis-h"></i></button>
                </div>
                <?php
                foreach ($tasks_by_priority as $task) {
                    $date = $task['deadline'];

                    if ($task['status'] == 0 and $date >= date('Y-m-d')) {
                ?>
                        <div class='task' draggable='true'>
                            <div class='task__tags'><span class='task__tag task__tag--copyright'><?php echo $task['name_task'] ?></span><button class='task__options'><a href="<?php echo middleware('task', 'readiness') . "?id=" . $task['id'] ?>"><i class='bx bx-check'></i></a></button></div>

                            <p><?php echo $task["description_task"] ?></p>
                            <div class='task__stats'>
                                <span><time datetime="2021-11-24T20:00:00"><i class="fas fa-flag"></i><?php echo date("Y-m-d", strtotime($task['date_start'])) . " - " . $task['deadline'] ?></time></span>
                                <?php
                                if ($task['priority'] == 1) {
                                    echo '<span class="task__priority"></span>';
                                } else {
                                    echo '<span class="task__not__priority"></span>';
                                }
                                ?>
                            </div>
                        </div>
                <?php
                    }
                }
                ?>
            </div>

            <div class='project-column'>
                <div class='project-column-heading'>
                    <h2 class='project-column-heading__title'>Выполненые</h2><button class='project-column-heading__options'><i class="fas fa-ellipsis-h"></i></button>
                </div>
                <?php
                foreach ($tasks_by_date as $task) {
                    $date = $task['deadline'];
                    if ($task['status'] == 1 or $date <= date('Y-m-d')) {


                ?>
                        <div class='task' draggable='true'>
                            <div class='task__tags'><span class='task__tag task__tag--copyright'><?php echo $task['name_task'] ?></span><button class='task__options'>
                                    <?php
                                    if (!($date <= date('Y-m-d'))) {
                                        $done_count++;
                                    ?><button class='task__options'><a href="<?php echo middleware('task', 'unreadiness') . "?id=" . $task['id'] ?>"><i class='bx bx-minus'></i></a></button><?php
                                    }
                                    else{
                                        $overdue_count++;
                                    }
                                                                                                                                                                                                ?>

                                </button></div>
                            <p><?php echo $task["description_task"] ?></p>
                            <div class='task__stats'>
                                <span><time datetime="2021-11-24T20:00:00"><i class="fas fa-flag"></i><?php echo date("Y-m-d", strtotime($task['date_start'])) ?></time></span>

                            </div>
                        </div>
                <?php
                    }
                }
                ?>
    </main>
    <aside class='task-details'>
        <div class='tag-progress'>
            <h2>Task Progress</h2>
            <div class='tag-progress'>
                <p>Выполненые <span><?php echo $done_count ?>/<?php echo count($tasks_by_date) ?></span></p>
                <progress class="progress progress--copyright" max="<?php echo count($tasks_by_date) ?>" value="<?php echo $done_count ?>"><?php echo $done_count ?> </progress>
            </div>
            <div class='tag-progress'>
                <p>Просроченные <span><?php echo $overdue_count ?>/<?php echo count($tasks_by_date) ?></span></p>
                <progress class="progress progress--illustration" max="<?php echo count($tasks_by_date) ?>" value="<?php echo $overdue_count ?>"> <?php echo $overdue_count ?> </progress>
            </div>
        </div>
        <div class='task-activity'>
            <h2>Recent Activity</h2>
            <ul>
                <li>
                    <span class='task-icon task-icon--attachment'><i class="fas fa-paperclip"></i></span>
                    <h4>Важные</h4>
                </li>
                <li>
                    <span class='task-icon task-icon--comment'><i class="fas fa-comment"></i></span>
                    <h4>Обычные</h4>
                </li>
            </ul>
        </div>
    </aside>
</div>

<?php
component('footer');
?>