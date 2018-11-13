<?php defined("ACCESS_SUCCESS") or header("location: ../error-403"); ?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <title>Paginación con PHP</title>
        <style>
            * {
                box-sizing: border-box;
                font-family: sans-serif;
                font-size: 14px;
                margin: 0;
                padding: 0;
            }
            .active a{
                background-color: #2c3e50;
                color: #ffffff !important;
            }
            .main-container{
                margin: 50px auto;
                width: 80%;
            }
            .pagination{
                display: flex;
                justify-content: center;
                list-style: none;
                text-align: center;
            }
            .pagination li a{
                border-radius: 5px;
                color: #000000;
                display: block;
                padding: 5px 10px;
                text-decoration: none;
            }
            .pagination li a:hover{
                background-color: rgba(0, 0, 0, 0.2);
            }
            .title-table {
                background-color: #BDBDBD;
                color: #ffffff;
                display: block;
                font-size: 20px;
                padding: 10px;
                text-align: center;
            }
            .table {
                border-collapse: collapse;
                margin-bottom: 20px;
                table-layout: fixed;
                width: 100%;
            }
            td, th {
                padding: 10px;
                text-align: center;
                vertical-align: middle;
            }
            th {
                background-color: #EEEEEE;
            }
            tr:nth-child(2n + 1) {
                background-color: #F5F5F5;
            }
            tr{
                border: 1px solid #F5F5F5;
                border-left: none;
                border-right: none;
            }
            @media screen and (max-width: 768px) {
                .main-container{
                    width: 100%;
                }
                .pagination{
                    flex-direction: column;
                    margin: 0 auto;
                    width: 10%;
                }
            }
        </style>
    </head>
    <body>
        <div class="main-container">
            <h3 class="title-table">Estados del mundo</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID Estado</th>
                        <th>Estado</th>
                        <th>País</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($states as $state): ?>
                        <tr>
                            <td><?= $state->getStateId(); ?></td>
                            <td><?= $state->getState(); ?></td>
                            <td><?= $state->getCountry()->getCountry(); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                </tbody>
            </table>

            <nav>
                <ul class="pagination">
                    <?php if ($pagination->currentPagesGroup != 1): ?>
                        <li><a href="<?= BASE_URL; ?>estado/pagina/1">Inicio</a></li>
                        <li><a href="<?= BASE_URL; ?>estado/pagina/<?= $pagination->previousPage; ?>">&laquo;</a></li>
                    <?php endif; ?>

                    <?php for ($i = $pagination->firstPage; $i <= $pagination->lastPage; $i++): ?>
                        <?php if ($i > $pagination->totalPages): ?>
                            <?php break; ?>
                        <?php endif; ?>

                        <?php $active = ($i == $pagination->currentPage) ? "active" : ""; ?>
                        <li class="<?php echo $active; ?>">
                            <a href="<?= BASE_URL; ?>estado/pagina/<?= $i; ?>">
                                <?= $i; ?>
                            </a>
                        </li>
                    <?php endfor; ?>

                    <?php if ($pagination->currentPagesGroup != $pagination->totalPagesGroups): ?>
                        <li><a href="<?= BASE_URL; ?>estado/pagina/<?= $pagination->nextPage; ?>">&raquo;</a></li>
                        <li><a href="<?= BASE_URL; ?>estado/pagina/<?= $pagination->totalPages; ?>">Final</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </body>
</html>