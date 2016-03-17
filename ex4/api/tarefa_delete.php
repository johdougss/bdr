<?php
if ($_SERVER['REQUEST_METHOD'] != 'DELETE')
    return;

define('ABSPATH', '../');
include(ABSPATH . 'init.php');
include_once(ABSPATH_REPOSITORIES . '/TarefaRepository.php');
//header('Content-Type: application/json');

$tarefaRepository = new TarefaRepository();
$tarefa_id = Input::get('id');
$tarefaRepository->delete($tarefa_id);
