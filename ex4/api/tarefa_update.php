<?php

if ($_SERVER['REQUEST_METHOD'] != 'PUT')
    return;

define('ABSPATH', '../');
include(ABSPATH . 'init.php');
include_once(ABSPATH_REPOSITORIES . '/TarefaRepository.php');
header('Content-Type: application/json');

$tarefaRepository = new TarefaRepository();
$tarefa_id = Input::get('id');
$tarefa = array(
    'id' => $tarefa_id,
    'titulo' => Input::get('titulo'),
    'descricao' => Input::get('descricao')
);

$tarefaRepository->update($tarefa);
$tarefa = $tarefaRepository->find($tarefa_id);
echo json_encode($tarefa);