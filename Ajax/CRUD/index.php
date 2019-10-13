<?php 

require_once 'conexao.php';

$sql = "SELECT * FROM crud_ajax";
$stmt = $pdo->prepare($sql);
$stmt->execute();

?>

<!doctype html>
<html lang="en">
  <head>
    <title>CRUD - Ajax</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>

  </head>
  <body>
      
    <div class="container">
      <div class="row">
        <div class="col">
          <h2>Cadastrar Usuário:</h2>
          <form method="POST" id="btnCadastrar">
            <div>Nome: <input class="form-control form-control-sm" type="text" name="nome"></div>
            <div>Idade: <input class="form-control form-control-sm" type="number" name="idade"></div>
            </br>
            <button type="submit" class="btn btn-success">Cadastrar</button>
          </form>
        </div>
      </div>
      <hr>
      <h2>Pesquisando Usuarios:</h2> 
      <input class="form-control" type="text" id="search" placeholder="Nome">
      <br>
      <select class="form-control" id="search_idade">
        <option>Idade</option>
        <option value="22">22</option>
        <option value="23">23</option>
        <option value="25">25</option>
      </select>
      <hr>
      <h4>Resultado:</h4>
      <p id="user"></p>
      <hr>
      <h2>Listando Usuarios:</h2>
      <div class="table-responsive">
        <table class="table table-hover">
          <thead class="thead-light">
            <tr>
              <th scope="col">Nome</th>
              <th scope="col">Idade</th>
              <th scope="col">Alterar</th>
            </tr>
          </thead>
          <tbody id="listar">
          <?php while ($row = $stmt->fetch()) { ?>
            <tr>
              <th scope="row"><?php print $row['nome']; ?></th>
              <td><?php print $row['idade']; ?></td>
              <td><button type="button" data-toggle="modal" data-target="#alter_<?php print $row['id'];?>" class="btn btn-outline-primary btn-sm">Alterar</button></td>
            </tr>
            <!-- Modal alter -->
            <form method="POST" id="form_update_<?php print $row['id'];?>">
              <div class="modal fade" id="alter_<?php print $row['id'];?>">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Alterar Cadastro de Usuário:</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <input type="hidden" name="id" value="<?php print $row['id']; ?>">
                      <div>Nome: <input class="form-control form-control-sm" type="text" name="nome" value="<?php print $row['nome']; ?>"></div>
                      <div>Idade: <input class="form-control form-control-sm" type="number" name="idade" value="<?php print $row['idade']; ?>"></div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-outline-secondary btn-sm" data-dismiss="modal">Fechar</button>
                      <button type="submit" class="btn btn-outline-success btn-sm salvar">Salvar</button>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          <?php } ?>
          </tbody>
        </table>
      </div>
    </div>

    <script>
    $(document).ready(function(){
      $('#btnCadastrar').bind('submit', function(event) {
        event.preventDefault();

        var nome = $("input[name='nome']").val(); 
        var idade = $("input[name='idade']").val();

        $.ajax({
          type: 'POST',
          url: 'cadastrar.php',
          data: $('#btnCadastrar').serialize(),
          success: function(success) {
            $("#listar").html(success);
          }
        });
      });

      //SEARCH
      // $('#search').keyup(function(){
      //   var search = $(this).val();
      //   if(search != ''){
      //     $.ajax({
      //       method:"POST",
      //       url:"teste2.php",
      //       data:{search:search},
      //       success:function(data){
      //         $('#result').html(data);
      //       }
      //     });
      //   }else{
      //     $('#result').html("Not Found");
      //   }
      // });
      load_data();
      $("#search_idade").change(function(){
        var idade = $(this).val();
        if(idade != ''){
          load_data(idade);
        }else{
          load_data();
        }
      })
      $('#search').keyup(function(){
        var search = $(this).val();
        if(search != ''){
          load_data(search);
        }else{
          load_data();
        }
      });

      function load_data(result){
        $.ajax({
          url:"search.php",
          method:"POST",
          data:{result:result},
          success:function(data){
            $('#user').html(data);
          }
        });
      }

      //UPDATE
      <?php 
      $sql = "SELECT * FROM crud_ajax";
      $stmt = $pdo->prepare($sql);
      $stmt->execute();
      while ($rowJS = $stmt->fetch()) { ?>

        $('#form_update_<?php print $rowJS['id'];?>').bind('submit', function(event) {
          event.preventDefault();
          $.ajax({
            type: 'POST',
            url: 'alterar.php',
            data: $('#form_update_<?php print $rowJS['id'];?>').serialize(),
            success: function(success) {
              $("#listar").html(success);
              // $('#alter_<?php //print $row['id'];?>').modal('hide'); 
            },
            error: function(error) {
              console.log(error);
            }
          });
        });
      <?php } ?>

        // $.ajax({
        //   type: 'POST',
        //   url: 'listar.php',
        //   success: function(success) {
        //     $("#listar").html(success);
        //   }
        // });
    });

    </script>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <!-- Ajax -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

  </body>
</html>