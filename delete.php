<?php
if (!empty($_GET['id'])) {
    include_once('config.php');
    
    // Validação e sanitização da entrada
    $id = intval($_GET['id']);
    
    // Preparar a instrução SELECT
    $sqlSelect = $conexao->prepare("SELECT * FROM fiscalizacao WHERE id = ?");
    $sqlSelect->bind_param('i', $id);
    $sqlSelect->execute();
    $result = $sqlSelect->get_result();
    
    // Verificar se o registro existe
    if ($result->num_rows > 0) {
        // Preparar a instrução DELETE
        $sqlDelete = $conexao->prepare("DELETE FROM fiscalizacao WHERE id = ?");
        $sqlDelete->bind_param('i', $id);
        $resultDelete = $sqlDelete->execute();
        
        if ($resultDelete) {
            // Registro deletado com sucesso
            $message = "Registro deletado com sucesso";
            $alertClass = "danger";
        } else {
            // Erro ao deletar o registro
            $message = "Erro ao deletar o registro: " . $conexao->error;
            $alertClass = "danger";
        }
    } else {
        // Registro não encontrado
        $message = "Registro não encontrado";
        $alertClass = "danger";
    }
} else {
    // Nenhum ID fornecido
    $message = "Nenhum ID fornecido";
    $alertClass = "danger";
}

header('Location: listar.php?message=' . urlencode($message) . '&alertClass=' . urlencode($alertClass));
exit();
