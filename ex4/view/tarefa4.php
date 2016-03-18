<?php
define('ABSPATH', '../');
include(ABSPATH . 'init.php');
$layout_title = "Tarefa 4";
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
                <li class="active">Tarefa 4</li>
            </ol>
        </div>
    </div>
    <div class="page">
        <div class="container">
                <div class="problema">
            <div class="problema-descricao">
                    <h2>Tarefa 4</h2>
                    <p>Desenvolva uma API Rest para um sistema gerenciador de tarefas
                        (inclusão/alteração/exclusão). As tarefas consistem em título e descrição, ordenadas por
                        prioridade. Desenvolver utilizando:
                    </p>

                    <p>• Linguagem PHP (ou framework CakePHP);</p>

                    <p>• Banco de dados MySQL;</p>

                    <p>Diferenciais:</p>

                    <p>• Criação de interface para visualização da lista de tarefas;</p>

                    <p>• Interface com drag and drop;</p>

                    <p>• Interface responsiva (desktop e mobile);</p>
                </div>

                <div id="form-container">
                    <form action="<?php echo url('/api/tarefa') ?>" method="post">
                        <input type="hidden" name="id">
                        <h4>Tarefa</h4>

                        <div class="input-material-container">

                            <div class="input-material">
                                <input id="ipt-titulo" type="text" name="titulo">
                                <label for="ipt-titulo">Titulo</label>

                                <div class="bar"></div>
                            </div>
                            <div class="input-material">
                                <textarea id="ipt-descricao" name="descricao"></textarea>
                                <label for="ipt-descricao">Descrição</label>

                                <div class="bar"></div>
                            </div>
                        </div>
                        <button class="btn btn-primary">Salvar</button>
                        <a href="javascript:;" id="btn-cancel" class="hidden">cancelar</a>
                    </form>

                </div>
                <div id="visualizar-container" class="hidden">
                    <div>
                        <strong>Titulo </strong>
                        <span data-target="titulo"></span>
                    </div>
                    <div>
                        <strong>Descrição </strong>
                        <span data-target="descricao"></span>
                    </div>

                    <a id="btn-novo" class="btn btn-primary">novo</a>
                </div>

                <div>
                    <h4>Tarefas</h4>
                    <ul id="tarefas">
                    </ul>
                    <div id="tarefas-empty" class="hidden">
                        nenhuma tarefa encontrada
                    </div>
                </div>


            </div>
        </div>
    </div>

<?php include(ABSPATH_PARTIAL . '/footer.php'); ?>
<?php include(ABSPATH_PARTIAL . '/scriptsbase.php'); ?>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script>
        tarefas = <?php echo isset($tarefas) && $tarefas !=null?  json_encode($tarefas):'null'?>;

        var ControllerTarefas = function () {
            var tarefas = [];
            var self = this;
            $.extend(self, {
                set: function (itens) {
                    if (itens == null)
                        itens = [];
                    self.tarefas = itens;
                },
                get: function () {
                    return self.tarefas;
                },
                add: function (item) {
                    self.tarefas.push(item);
                },
                update: function (item) {
                    var index = self.findIndex(item.id);
                    if (index != -1)
                        self.tarefas[index] = item;
                    else
                        self.add(item);
                },
                remove: function (item) {
                    self.removeId(item.id);
                },

                removeId: function (id) {
                    var index = self.findIndex(id);
                    if (index != -1) {
                        self.tarefas.splice(index, 1);
                    }
                },
                findItem: function (tarefa_id) {
                    for (var i = 0; i < self.tarefas.length; i++)
                        if (self.tarefas[i].id == tarefa_id)
                            return self.tarefas[i];
                    return null;
                },
                findIndex: function (tarefa_id) {
                    for (var i = 0; i < self.tarefas.length; i++)
                        if (self.tarefas[i].id == tarefa_id)
                            return i;
                    return -1;
                },
                updatePrioridade: function (order_ids) {
                    for (var i = 0; i < order_ids.length; i++) {
                        for (var j = 0; j < self.tarefas.length; j++) {
                            if (self.tarefas[j].id == order_ids[i])
                                self.tarefas[j].prioridade = i + 1;
                        }
                    }

                    var SortByPriority = function (a, b) {
                        var a = a.prioridade;
                        var b = b.prioridade;
                        return ((a < b) ? -1 : ((a > b) ? 1 : 0));
                    };
//                    console.log(self.tarefas);
                    self.tarefas.sort(SortByPriority);


                }


            });
        };

        var ViewTarefas = function () {

            var $form_container = $('#form-container');
            var $btn_cancel = $form_container.find('#btn-cancel');

            var $visualizar_container = $('#visualizar-container');
            var $btn_novo = $visualizar_container.find('#btn-novo');
            var $visualizar_titulo = $visualizar_container.find('[data-target=titulo]');
            var $visualizar_descricao = $visualizar_container.find('[data-target=descricao]');

            var $tarefas = $('#tarefas');
            var $tarefas_container = $tarefas.parent();
            var $tarefas_empty = $tarefas_container.find('#tarefas-empty');

            var $form = $form_container.find('form');
            var $form_titulo = $form.find('input[name=titulo]');
            var $form_descricao = $form.find('textarea[name=descricao]');
            var $form_tarefa_id = $form.find('input[name=id]');


            var self = this;
            $.extend(self, {
                init: function () {
                    self.event_edit();
                    self.event_delete();
                    self.event_submit();
                    self.event_visualizar();
                    self.reset();

                    $btn_cancel.click(function () {
                        self.reset_field();
                    });
                    $btn_novo.click(function () {
                        self.reset_field();
                        self.show_form(true);
                        $btn_cancel.addClass('hidden');
                    });
                    self.show_form(true);
                },
                add_item: function (tarefa) {
                    return "<li class=\"ui-state-default\" data-id=\"" + tarefa.id + "\">\n    <span class=\'descricao\'>" + tarefa.titulo + "</span>\n\n    <div class=\'actions\'>\n        <span data-action=\'li-visualizar\' class=\'icon-visibility\'></span>\n        <span data-action=\'li-delete\' class=\'icon-delete\'></span>\n        <span data-action=\'li-edit\' class=\'icon-edit\'></span>\n    </div>\n</li>\n"
                },
                reset: function () {
                    var tarefas = controllerTarefas.get();
                    if ($.isEmptyObject(tarefas)) {
                        $tarefas_empty.removeClass('hidden');
                    } else {
                        $tarefas_empty.addClass('hidden');
                        $tarefas.html('');
                        $.each(tarefas, function (index, tarefa) {
                            $tarefas.append(self.add_item(tarefa));
                        });
                        $tarefas.sortable({
                            stop: function () {
                                var order_tarefa_ids = [];
                                $tarefas.find('li').each(function (index, item) {
                                    var $li = $(item);
                                    var tarefa_id = $li.data('id');
                                    order_tarefa_ids.push(tarefa_id)
                                });
//                                console.log(order_tarefa_ids);
                                controllerTarefas.updatePrioridade(order_tarefa_ids);

                                $.ajax({
                                    url: '<?php echo url('/api/tarefa/prioridade') ?>',
                                    type: 'PUT',
                                    data: {'order': order_tarefa_ids},
                                    error: function () {
//                                        console.log('nao consegui atualizar as prioridades')
                                    },
                                    success: function () {
//                                        console.log('prioridades atuaizadas')
                                    }
                                })
                            }
                        });
                    }
                },
                verifyEmpty: function () {
                    if ($.isEmptyObject(tarefas)) {
                        $tarefas_empty.removeClass('hidden');
                    } else {
                        $tarefas_empty.addClass('hidden');
                    }
                },

                edit_item: function (tarefa) {
                    if (tarefa == null)
                        return;

                    $form_tarefa_id.val(tarefa.id);
                    $form_descricao.val(tarefa.descricao);
                    $form_titulo.val(tarefa.titulo);


                },

                show_form: function (is_show) {
                    if (is_show) {
                        $visualizar_container.addClass('hidden');
                        $form_container.removeClass('hidden');
                    } else {
                        $visualizar_container.removeClass('hidden');
                        $form_container.addClass('hidden');
                    }
                },
                event_submit: function () {
                    $form.submit(function (e) {
                        e.preventDefault();


                        var tarefa_id = $form_tarefa_id.val();
                        var type = tarefa_id == '' ? 'post' : 'put';
                        var titulo = $form_titulo.val();
                        var descricao = $form_descricao.val();
                        if (titulo == '' || descricao == '') {
                            swal('Dados incompletos', 'preecha corretamente o titulo e a descrição');
                            return;
                        }
                        $.ajax({
                            url: e.target.action,
                            type: type,
                            data: $form.serialize(),
                            success: function (tarefa) {
                                controllerTarefas.update(tarefa);
                                viewTarefas.reset();
                                self.reset_field();
                                if (type == 'post')
                                    swal('Adicionado com sucesso');
                                else
                                    swal('Atualizado     com sucesso');
                            }
                        });

                    });
                },
                reset_field: function () {
                    $form[0].reset();
                    $form_tarefa_id.val(null);
                },
                event_visualizar: function () {
                    $($tarefas).on('click', '[data-action=li-visualizar]', function () {
                        var $self = $(this);
                        var $li = $self.closest('li');
                        var tarefa_id = $li.data('id');
                        var tarefa = controllerTarefas.findItem(tarefa_id);


                        $visualizar_titulo.text(tarefa.titulo);
                        $visualizar_descricao.text(tarefa.descricao);
                        self.show_form(false);
                    });
                },
                event_edit: function () {
                    $($tarefas).on('click', '[data-action=li-edit]', function () {
                        var $self = $(this);
                        var $li = $self.closest('li');
                        var tarefa_id = $li.data('id');
                        var tarefa = controllerTarefas.findItem(tarefa_id);
                        self.edit_item(tarefa);
                        self.show_form(true);
                        $btn_cancel.removeClass('hidden');
                    });
                },
                event_delete: function () {

                    $($tarefas).on('click', '[data-action=li-delete]', function () {
                        var $self = $(this);
                        var $li = $self.closest('li');
                        var tarefa_id = $li.data('id');
                        $.ajax({
                            url: '<?php echo url('/api/tarefa/')?>' + tarefa_id,
                            type: 'DELETE',
                            error: function (e) {
                                console.log('erro')
                            },
                            success: function () {
                                console.log('success');
                                controllerTarefas.removeId(tarefa_id);
                                $li.remove();
                                self.verifyEmpty();
                            }
                        });
                    });
                }
            });
        };

        var controllerTarefas = new ControllerTarefas();
        controllerTarefas.set(tarefas);

        var viewTarefas = new ViewTarefas();
        viewTarefas.init();

    </script>
<?php include(ABSPATH_PARTIAL . '/html_end.php'); ?>