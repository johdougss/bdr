<?php
define('ABSPATH', '../');
include(ABSPATH . 'init.php');
Session::start();
$layout_title = "Tarefa 1";
include(ABSPATH_PARTIAL . '/html_init.php');
include(ABSPATH_PARTIAL . '/header.php');
include(ABSPATH_REPOSITORIES . '/TarefaRepository.php');
$tarefaRepository = new TarefaRepository();
$tarefas = $tarefaRepository->findByStatus();

class Multiple
{
    public function verifyFizzBuzz($start, $end)
    {
        $result = '';
        for ($i = $start; $i <= $end; $i++) {
            if ($i % 3 == 0 && $i % 5 == 0) {
                $result .= 'FizzBuzz<br>';
            } elseif ($i % 3 == 0) {
                $result .= 'Fizz<br>';
            } elseif ($i % 5 == 0) {
                $result .= 'Buzz<br>';
            } else {
                $result .= $i . '<br>';
            }
        }
        return $result;
    }
}

$multiple = new Multiple;


?>
    <div class="header-before breadcrumb-container">
        <div class="container ">
            <ol class="breadcrumb">
                <li><a href="<?php echo url('/'); ?>">Início</a></li>
                <li class="active">Tarefa 1</li>
            </ol>
        </div>
    </div>
    <div class="page">
        <div class="container">
            <div>
                <div>
                    <p><strong>Escreva um programa que imprima números de 1 a 100. Mas, para múltiplos de 3 imprima
                            “Fizz” em vez do número e para múltiplos de 5 imprima “Buzz”. Para números múltiplos
                            de ambos (3 e 5), imprima “FizzBuzz”.</strong>
                    </p>
                </div>

                <div>
                    <h4>Resolução</h4>
                    <img src="<?php echo asset('/ex4/images/ex1.png') ?>" alt="">

                    <div><?php echo $multiple->verifyFizzBuzz(1, 100); ?></div>
                </div>

            </div>
        </div>
    </div>

<?php include(ABSPATH_PARTIAL . '/footer.php'); ?>
<?php include(ABSPATH_PARTIAL . '/scriptsbase.php'); ?>
<?php include(ABSPATH_PARTIAL . '/html_end.php'); ?>