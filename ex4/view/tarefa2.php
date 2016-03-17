<?php
define('ABSPATH', '../');
include(ABSPATH . 'init.php');
Session::start();
$layout_title = "Tarefa 2";
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
                <li class="active">Tarefa 2</li>
            </ol>
        </div>
    </div>
    <div class="page">
        <div class="container">
            <div>
                <div>
                    <p><strong>Refatore o código abaixo, fazendo as alterações que julgar necessário.</strong>
                    </p>
                    <img src="<?php echo asset('/ex4/images/ex2_enunciado.png') ?>" alt="">
                </div>

                <div>
                    <h4>Resolução</h4>
                    <img src="<?php echo asset('/ex4/images/ex3.png') ?>" alt="">
                </div>

            </div>
        </div>
    </div>

<?php include(ABSPATH_PARTIAL . '/footer.php'); ?>
<?php include(ABSPATH_PARTIAL . '/scriptsbase.php'); ?>
<?php include(ABSPATH_PARTIAL . '/html_end.php'); ?>