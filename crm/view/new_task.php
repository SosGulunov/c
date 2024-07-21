<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . "/functions.php";
onlyAdmin();
model('Worker');
$worker_model = new Worker();
$workers = $worker_model->get_all();
component('sidebar');
?>

<!-- <div class="container">
    <h1>Добавление:</h1>
    <a href="<?php echo view('workers') ?>">Вернуться</a>

    <form action="<?php echo middleware('task', 'new') ?>" method="post" enctype="multipart/form-data">
        <label>
            Заголовок
            <input type="text" name="name_task" maxlength="" value="">
        </label>
        <label>
            Подробное описание задачи
            <input type="text" name="description_task" maxlength="" value="">
        </label>
        <label>
            Дедлайн
            <input type="date" name="deadline" maxlength="" value="">
        </label>
        <label>
            Приоритет
            <select name="priority">

                <option value="1">Красный</option>
                <option value="0">Синий</option>

            </select>
        </label>
        <label>
            Ответственный
            <select name="responsible">
                <?php
                foreach ($workers as $worker) {
                ?>
                    <option value="<?php echo $worker['id'] ?>"><?php echo $worker['first_name'] ?> <?php echo $worker['second_name'] ?></option>
                <?php
                }
                ?>
            </select>
        </label>
        <button>Добавить</button>

    </form>
</div> -->

<div class="form-style-5">
    <form action="<?php echo middleware('task', 'new') ?>" method="post" enctype="multipart/form-data">
        <fieldset>
            <legend> Добавить задачу</legend>
            <input type="text" name="name_task" placeholder="Название задачи *">
            <input type="date" name="deadline" placeholder="Дедлайн *">
            <textarea name="description_task" placeholder="Подробное описание"></textarea>
            <label for="priority">Приоритет:</label>
            <select name="priority">
                <option value="1">Красный</option>
                <option value="0">Синий</option>
            </select>
            <select name="responsible">
                <?php
                foreach ($workers as $worker) {
                ?>
                    <option value="<?php echo $worker['id'] ?>"><?php echo $worker['first_name'] ?> <?php echo $worker['second_name'] ?></option>
                <?php
                }
                ?>
            </select>
        <input type="submit" value="Apply" />
    </form>
</div>
<?php
component('footer');
?>