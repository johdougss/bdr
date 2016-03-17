<?php

define('ABSPATH', '../');
include(ABSPATH . 'init.php');
include_once(ABSPATH_REPOSITORIES . '/TarefaRepository.php');
$tarefaRepository = new TarefaRepository();

$order_ids = Input::get('order');
//dd($order_ids);
$tarefaRepository->prioridade($order_ids);
//echo json_encode($tarefaRepository->all());