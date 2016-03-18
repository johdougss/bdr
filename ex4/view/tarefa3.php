<?php
define('ABSPATH', '../');
include(ABSPATH . 'init.php');
$layout_title = "Tarefa 3";
include(ABSPATH_PARTIAL . '/html_init.php');
include(ABSPATH_PARTIAL . '/header.php');
include(ABSPATH_REPOSITORIES . '/TarefaRepository.php');
$tarefaRepository = new TarefaRepository();
$tarefas = $tarefaRepository->findByStatus();
?>
    <div class="header-before breadcrumb-container">
        <div class="container ">
            <ol class="breadcrumb">
                <li><a href="<?php echo url('/'); ?>">Início</a></li>
                <li class="active">Tarefa 3</li>
            </ol>
        </div>
    </div>
    <div class="page">
        <div class="container">
            <div class="problema">
                <div class="problema-descricao">
                    <h2>Tarefa 3</h2>

                    <p>Refatore o código abaixo, fazendo as alterações que julgar necessário:
                    </p>
                    <img class="img-responsive" src="<?php echo asset('/ex4/images/ex3_enunciado.png') ?>" alt="">
                </div>

                <div>
                    <h4>Resolução</h4>
                    <img class="img-responsive" src="<?php echo asset('/ex4/images/ex3.png') ?>" alt="">
                </div>

            </div>
        </div>
    </div>

<?php include(ABSPATH_PARTIAL . '/footer.php'); ?>
<?php include(ABSPATH_PARTIAL . '/scriptsbase.php'); ?>
<?php include(ABSPATH_PARTIAL . '/html_end.php'); ?>