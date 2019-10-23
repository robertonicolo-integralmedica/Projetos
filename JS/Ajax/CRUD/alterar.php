<?php 

require_once 'conexao.php';

if($_POST){

    $nome = $_POST['nome'];
    $idade = $_POST['idade'];
    $id = $_POST['id'];
    $html = '';

    $update = "UPDATE crud_ajax SET nome = :nome, idade = :idade WHERE id = :id";
    $stmt = $pdo->prepare($update);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':idade', $idade);
    $stmt->bindParam(':id', $id);
    // $stmt->execute();
    if($stmt->execute()){
        $sql = "SELECT * FROM crud_ajax";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        while ($row = $stmt->fetch()) { 
            $html .= '<tr>
            <th scope="row">'.$row['nome'].'</th>
            <td>'.$row['idade'].'</td>
            <td><button type="button" data-toggle="modal" data-target="#alter_'.$row['id'].'" class="btn btn-outline-primary btn-sm">Alterar</button></td>
            </tr>
            
            <form method="POST" id="form_update_'.$row['id'].'">
              <div class="modal fade" id="alter_'.$row['id'].'">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Alterar Cadastro de Usuário:</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <input type="hidden" name="id" value="'.$row['id'].'">
                      <div>Nome: <input class="form-control form-control-sm" type="text" name="nome" value="'.$row['nome'].'"></div>
                      <div>Idade: <input class="form-control form-control-sm" type="number" name="idade" value="'.$row['idade'].'"></div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-outline-secondary btn-sm" data-dismiss="modal">Fechar</button>
                      <button type="submit" class="btn btn-outline-success btn-sm salvar">Salvar</button>
                    </div>
                  </div>
                </div>
              </div>
            </form>
            ';
        }
        print $html;
    }
    
}

?>