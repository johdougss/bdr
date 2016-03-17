<?php
define('ABSPATH', 'ex4/');
include(ABSPATH . 'init.php');
Session::start();
$layout_title = "Prova Thiago Corrêa da Silva";
include_once(ABSPATH_PARTIAL . '/html_init.php');
include_once(ABSPATH_PARTIAL . '/header.php');
?>
<div class="header-before">
    <div class="page">
        <div class="container">
            <div class="row">
                <div class="init-center col-xs-12 col-sm-6  col-md-6  col-lg-6">
                    <h2>Tarefas</h2>
                    <ul class="footer-links">
                        <li><a href="<?php echo url('/tarefa1'); ?>">Tarefa 1</a></li>
                        <li><a href="<?php echo url('/tarefa2'); ?>">Tarefa 2</a></li>
                        <li><a href="<?php echo url('/tarefa3'); ?>">Tarefa 3</a></li>
                        <li><a href="<?php echo url('/tarefa4'); ?>">Tarefa 4</a></li>
                    </ul>
                </div>
                <div class="init-center col-xs-12 col-sm-6  col-md-6  col-lg-6">
                    <h3>Johnathan Douglas de Souza Santos</h3>

                    <address>
                        <p>Endereço: Rua Biase Faraco, 228 </p>

                        <p>CEP: 88070-420</p>

                        <p>Bairro: Estreito </p>

                        <p>Cidade: Florianópolis/SC</p>

                        <p> Telefone: (48) 9953-3046</p>

                        <p>E-mail: johdougss@gmail.com </p>

                    </address>
                </div>

            </div>
        </div>
    </div>
</div>
<?php include(ABSPATH_PARTIAL . '/footer.php'); ?>
<?php include(ABSPATH_PARTIAL . '/scriptsbase.php'); ?>
<?php include(ABSPATH_PARTIAL . '/html_end.php'); ?>



