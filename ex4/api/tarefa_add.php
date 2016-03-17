<?php
if ($_SERVER['REQUEST_METHOD'] != 'POST')
    return;

define('ABSPATH', '../');
include(ABSPATH . 'init.php');
include_once(ABSPATH_REPOSITORIES . '/TarefaRepository.php');
header('Content-Type: application/json');

$tarefaRepository = new TarefaRepository();
$tarefa = array(
    'titulo' => Input::get('titulo'),
    'descricao' => Input::get('descricao')
);
$tarefaRepository->insert($tarefa);
$tarefa_id = $tarefaRepository->lastInsert();
$tarefa = $tarefaRepository->find($tarefa_id);
echo json_encode($tarefa);