
<body>
<?php /** @var mysqli_result $tarefas */ ?>
    <h1 >TO-DO List</h1>

    <form action="index.php?action=criar" method="POST">
        <input type="text" name="descricao" placeholder="Descrição da tarefa">
        <button type="submit">Adicionar</button>
    </form>

    <h2>Suas tarefas</h2>
    <?php if ($tarefas->num_rows>0): ?>
        
        <ul>
            <?php foreach ($tarefas as $tarefa): ?>
                <li>
                    <?php echo ($tarefa['descricao']); ?>
                    <a href="index.php?action=excluir&id=<?php echo $tarefa['id']; ?>">
                        Excluir
                    </a>
                    <button
                        onclick="abrirModel(<?php echo $tarefa['id']; ?>,
                            '<?php echo ($tarefa['descricao']); ?>')">
                        Editar
                    </button>
                    </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Não há tarefas ainda!</p>
    <?php endif; ?>

    <?php include __DIR__ . '/modelEditar.php'; ?>

    <script>
        function abrirModel(id, descricao){
            document.getElementById("modelEditar").style.display = "block"
            document.getElementById("valorId").value = id
            document.getElementById("editarDescricao").value = descricao 
        }

        function fecharModel(){
            document.getElementById("modelEditar").style.display = "none"
        }
    </script>

</body>
