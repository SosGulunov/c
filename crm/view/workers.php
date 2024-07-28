<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . "/functions.php";
onlyUser();
model('Worker');
$worker_model = new Worker();
$workers = $worker_model->get_all();

component('sidebar');
?>
<!-- <div class="container">
    <h1>Все работники</h1>
    <div class="adverts">
        <?php
        if ($workers) {
            foreach ($workers as $worker) {
        ?>
                <div class="advert">
                    <h4><?php echo $worker['first_name'] ?> <?php echo $worker['second_name'] ?></h4>
                    <p><?php echo $worker['title'] ?> </p>
                    <a href="<?php echo view('worker') . "?id=" . $worker['id'] ?>">Подробнее</a>
                </div>
            <?php
            }
        } else {
            ?>
            <p>Работников нет</p>
        <?php
        }
        if (isAdmin()) {
        ?><a href="<?php echo view('new_worker') ?>">Добавить работника</a><?php
                                                                        }
                                                                            ?>
    </div>
</div> -->


<div class="container">
    <div class="row align-items-center mt-3">
        <div class="col-md-6">
            <div class="mb-3">
                <h5 class="card-title">Работники <span class="text-muted fw-normal ms-2">(<?php echo count($workers) ?>)</span></h5>
            </div>
        </div>
        <div class="col-md-6">
            <div class="d-flex flex-wrap align-items-center justify-content-end gap-2 mb-3">
                <div>
                    <a href="<?php echo view('new_worker') ?>" data-bs-target=".add-new" class="btn btn-primary"><i class="bx bx-plus me-1"></i> Добавить</a>
                </div>
                <div class="dropdown">
                    <a class="btn btn-link text-muted py-1 font-size-16 shadow-none dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="bx bx-dots-horizontal-rounded"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="">
                <div class="table-responsive">
                    <table class="table project-list-table table-nowrap align-middle table-borderless">
                        <thead>
                            <tr>
                                <th scope="col" class="ps-4" style="width: 50px;">
                                    <div class="form-check font-size-16"><input type="checkbox" class="form-check-input" id="contacusercheck" /><label class="form-check-label" for="contacusercheck"></label></div>
                                </th>
                                <th scope="col">Имя</th>
                                <th scope="col">Позиция</th>
                                <th scope="col">Кон.инф</th>
                                <th scope="col">Зарплата</th>
                                <th scope="col" style="width: 200px;">Возможности</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($workers) {
                                foreach ($workers as $worker) {
                            ?>
                                    <tr>
                                        <th scope="row" class="ps-4">
                                            <div class="form-check font-size-16"><input type="checkbox" class="form-check-input" id="contacusercheck1" /><label class="form-check-label" for="contacusercheck1"></label></div>
                                        </th>
                                        <td><img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="" class="avatar-sm rounded-circle me-2" /><a href="#" class="text-body"><?php echo $worker['first_name'] ?> <?php echo $worker['second_name'] ?></a></td>
                                        <td><?php echo $worker['title'] ?></td>
                                        <td><?php echo $worker['contact_information'] ?></td>
                                        <td><?php echo $worker['salary'] ?></td>
                                        <td>
                                            <ul class="list-inline mb-0">
                                                <li class="list-inline-item">
                                                    <a href="<?php echo view('update_worker') . "?id=" . $worker['id']?>" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit" class="px-2 text-primary"><i class="bx bx-pencil font-size-18"></i></a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="<?php echo middleware('worker', 'delete') . "?id=" . $worker['id'] ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete" class="px-2 text-danger"><i class="bx bx-trash-alt font-size-18"></i></a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="<?php echo view('worker') . "?id=" . $worker['id'] ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete" class="px-2 text-danger"><i class='bx bx-info-circle' style='color:#2d0000'  ></i></a>
                                                </li>
                                                <!-- <li class="list-inline-item dropdown">
                                                    <a class="text-muted dropdown-toggle font-size-18 px-2" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true"><i class="bx bx-dots-vertical-rounded"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item" href="#">Action</a><a class="dropdown-item" href="#">Another action</a><a class="dropdown-item" href="#">Something else here</a>
                                                    </div>
                                                </li> -->
                                            </ul>
                                        </td>
                                    </tr>
                            <?php
                                }
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row g-0 align-items-center pb-4">
        <div class="col-sm-6">
            <div>
                <p class="mb-sm-0">Showing 1 to 10 of 57 entries</p>
            </div>
        </div>
        <div class='project-reviews'>
            <div class='project-reviews-column' id="reviews-container">

            </div>
            <div class="pagination-container">
                <div class="pagination" id="pagination">
                    <!-- Кнопки для навигации по страницам будут созданы здесь -->
                </div>
            </div>

        </div>
        <!-- <div class="col-sm-6">
            <div class="float-sm-end">
                <ul class="pagination mb-sm-0">
                    <li class="page-item disabled">
                        <a href="#" class="page-link"><i class="mdi mdi-chevron-left"></i></a>
                    </li>
                    <li class="page-item active"><a href="#" class="page-link">1</a></li>
                    <li class="page-item"><a href="#" class="page-link">2</a></li>
                    <li class="page-item"><a href="#" class="page-link">3</a></li>
                    <li class="page-item"><a href="#" class="page-link">4</a></li>
                    <li class="page-item"><a href="#" class="page-link">5</a></li>
                    <li class="page-item">
                        <a href="#" class="page-link"><i class="mdi mdi-chevron-right"></i></a>
                    </li>
                </ul>
            </div>
        </div> -->
    </div>
</div>

<?php
component('footer');
?>