<?php
//dados pessoais
$nome = "";
$email = "";
$cpf = "";
$telefone1 = "";
$telefone2 = "";
$data_nascimento = "";

//dados de endereço
$cep = "";
$logradouro = "";
$numero = "";
$complemento = "";
$uf = "";
$cidade = "";

$data_cadastro = date("Y-m-d");
$valor_doacao = "";
$id_intervalo_doacao = "";
$id_forma_pagamento = "";

$msg = "";
$alert = "";
$botaoSubmit = "";
$botaoUpdate = "disabled";


if($_POST){

    if(@$_POST['Inserir']){
        
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $telefone1 = $_POST['telefone1'];
        $telefone2 = $_POST['telefone2'];
        $data_nascimento = $_POST['data_nascimento'];
        $nasc = explode("/", $data_nascimento);
        $data_nascimento = $nasc[2]."-".$nasc[1]."-".$nasc[0];
        $cpf = $_POST['cpf'];
        $id_intervalo_doacao = $_POST['id_intervalo_doacao'];
        $id_forma_pagamento = $_POST['id_forma_pagamento'];
        $valor_doacao = $_POST['valor_doacao'];

        $cep = $_POST['cep'];
        $logradouro = $_POST['logradouro'];
        $numero = $_POST['numero'];
        $complemento = $_POST['complemento'];
        $uf = $_POST['uf'];
        $cidade = $_POST['cidade'];
        
        if($nome && $email && $telefone1 && $data_nascimento && $cpf && $id_intervalo_doacao && $id_forma_pagamento && $valor_doacao && $logradouro && $cep && $uf && $cidade) {

            //Conexão com Banco de Dados MySql
            $link = mysqli_connect("localhost", "root", "", "pmk");

            //SQL para inserir na tabela doadores
            $sql = "INSERT INTO doadores (nome, email, cpf, telefone1, telefone2, data_nascimento, data_cadastro, id_intervalo_doacao, valor_doacao, id_forma_pagamento) VALUES ";
            $sql .= "('".$nome."', '".$email."', '".$cpf."', '".$telefone1."', '".$telefone2."', '".$data_nascimento."', '".$data_cadastro."', ".$id_intervalo_doacao.", '".$valor_doacao."', ".$id_forma_pagamento.")"; 
            
            mysqli_query($link,$sql) or die("Erro ao tentar cadastrar registro");
            
            $id_doador = mysqli_insert_id($link);
            
            if($id_doador) {
                
                // SQL para inserir na tabela de endereço
                $sql2 = "INSERT INTO enderecos (logradouro, numero, complemento, cep, UF, cidade, id_doador) VALUES ";
                $sql2 .= "('".$logradouro."', '".$numero."', '".$complemento."', '".$cep."', '".$uf."', '".$cidade."', ".$id_doador.")";
                mysqli_query($link,$sql2) or die("Erro ao tentar cadastrar registro");
            }

            mysqli_close($link);
            
            $msg = "Doador cadastrado com sucesso!";
            $alert = "success";

            $nome = '';
            $telefone1 = '';
            $telefone2 = '';
            $email = '';
            $data_nascimento = '';
            $cpf = '';
            $valor_doacao = '';
            $id_forma_pagamento = '';
            $id_intervalo_doacao = '';
            $logradouro = '';
            $numero = '';
            $cep = '';
            $complemento = '';
            $uf = '';
            $cidade = '';

        } else {

            if($nome == '' || $nome == null) {
                $msg = "Nome é obrigatório.";
                $alert = "danger";
            }
            if($email == '' || $email == null) {
                $msg = "Email é obrigatório.";
                $alert = "danger";
            }
            if($data_nascimento == '' || $data_nascimento == null) {
                $msg = "Data de nascimento é obrigatória.";
                $alert = "danger";
            }
            if($cpf == '' || $cpf == null) {
                $msg = "CPF é obrigatório.";
                $alert = "danger";
            }
            if($telefone1 == '' || $telefone1 == null) {
                $msg = "Telefone 1 é obrigatório.";
                $alert = "danger";
            }
            if($cep == '' || $cep == null) {
                $msg = "CEP é obrigatório.";
                $alert = "danger";
            }
            if($logradouro == '' || $logradouro == null) {
                $msg = "Logradouro é obrigatório.";
                $alert = "danger";
            }
            if($uf == '' || $uf == null) {
                $msg = "UF é obrigatório.";
                $alert = "danger";
            }
            if($cidade == '' || $cidade == null) {
                $msg = "Cidade é obrigatório.";
                $alert = "danger";
            }
            if($id_intervalo_doacao == '' || $id_intervalo_doacao == null) {
                $msg = "Escolha um intervalo de doação.";
                $alert = "danger";
            }
            if($valor_doacao == '' || $valor_doacao == null) {
                $msg = "Favor preencher um valor de doação.";
                $alert = "danger";
            }
            if($id_forma_pagamento == '' || $id_forma_pagamento == null) {
                $msg = "Escolher uma forma de pagamento.";
                $alert = "danger";
            }

        }
    }

    if(@$_POST['Update']){
        
        //Conexão com Banco de Dados MySql
        $link = mysqli_connect("localhost", "root", "", "pmk");
        
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $telefone1 = $_POST['telefone1'];
        $telefone2 = $_POST['telefone2'];
        $data_nascimento = $_POST['data_nascimento'];
        $nasc = explode("/", $data_nascimento);
        $data_nascimento = $nasc[2]."-".$nasc[1]."-".$nasc[0];
        $cpf = $_POST['cpf'];
        $id_intervalo_doacao = $_POST['id_intervalo_doacao'];
        $id_forma_pagamento = $_POST['id_forma_pagamento'];
        $valor_doacao = $_POST['valor_doacao'];

        $cep = $_POST['cep'];
        $logradouro = $_POST['logradouro'];
        $numero = $_POST['numero'];
        $complemento = $_POST['complemento'];
        $uf = $_POST['uf'];
        $cidade = $_POST['cidade'];

        if($nome && $email && $telefone1 && $data_nascimento && $cpf && $id_intervalo_doacao && $id_forma_pagamento && $valor_doacao && $logradouro && $cep && $uf && $cidade) {
            
            $sql_update1 = "UPDATE doadores 
                            SET 
                            nome = '".$nome."'
                            , email = '".$email."'
                            , cpf = '".$cpf."'
                            , telefone1 = '".$telefone1."' 
                            , telefone2 = '".$telefone2."'
                            , data_nascimento = '".$data_nascimento."'
                            , id_intervalo_doacao = ".$id_intervalo_doacao."  
                            , valor_doacao = ".$valor_doacao."
                            , id_forma_pagamento = ".$id_forma_pagamento."
                            WHERE
                            id = ".$id;

            mysqli_query($link,$sql_update1) or die("Erro ao tentar alterar registro.");
            
            $sql_update2 = "UPDATE enderecos
                            SET
                            logradouro = '".$logradouro."'
                            , numero = '".$numero."'
                            , complemento = '".$complemento."'
                            , cep = '".$cep."'
                            , UF = '".$uf."'
                            , cidade = '".$cidade."'
                            WHERE id_doador = ".$id;

            mysqli_query($link,$sql_update2) or die("Erro ao tentar alterar registro de endereços.");


            mysqli_close($link);

            $msg = "Doador alterado com sucesso!";
            $alert = "success";

            $nome = '';
            $email = '';
            $telefone1 = '';
            $telefone2 = '';
            $data_nascimento = '';
            $cpf = '';
            $id_intervalo_doacao = '';
            $id_forma_pagamento = '';
            $valor_doacao = '';

            $cep = '';
            $logradouro = '';
            $numero = '';
            $complemento = '';
            $uf = '';
            $cidade = '';

        } else {

            if($nome == '' || $nome == null) {
                $msg = "Nome é obrigatório.";
                $alert = "danger";
            }
            if($email == '' || $email == null) {
                $msg = "Email é obrigatório.";
                $alert = "danger";
            }
            if($data_nascimento == '' || $data_nascimento == null) {
                $msg = "Data de nascimento é obrigatória.";
                $alert = "danger";
            }
            if($cpf == '' || $cpf == null) {
                $msg = "CPF é obrigatório.";
                $alert = "danger";
            }
            if($telefone1 == '' || $telefone1 == null) {
                $msg = "Telefone 1 é obrigatório.";
                $alert = "danger";
            }
            if($cep == '' || $cep == null) {
                $msg = "CEP é obrigatório.";
                $alert = "danger";
            }
            if($logradouro == '' || $logradouro == null) {
                $msg = "Logradouro é obrigatório.";
                $alert = "danger";
            }
            if($uf == '' || $uf == null) {
                $msg = "UF é obrigatório.";
                $alert = "danger";
            }
            if($cidade == '' || $cidade == null) {
                $msg = "Cidade é obrigatório.";
                $alert = "danger";
            }
            if($id_intervalo_doacao == '' || $id_intervalo_doacao == null) {
                $msg = "Escolha um intervalo de doação.";
                $alert = "danger";
            }
            if($valor_doacao == '' || $valor_doacao == null) {
                $msg = "Favor preencher um valor de doação.";
                $alert = "danger";
            }
            if($id_forma_pagamento == '' || $id_forma_pagamento == null) {
                $msg = "Escolher uma forma de pagamento.";
                $alert = "danger";
            }

        }
    }

}

if(@$_GET['acao'] == 'update') {
    
    //Conexão com Banco de Dados MySql
    $link = mysqli_connect("localhost", "root", "", "pmk");

    $sql_popula_form = "SELECT * FROM doadores t1, enderecos t2  WHERE t1.id = t2.id_doador AND t1.id = '".$_GET['id']."'"; 

    $query_popula_form = mysqli_query($link,$sql_popula_form);

    while($dado_form = $query_popula_form->fetch_array()) {
        $nome = $dado_form['nome'];
        $email = $dado_form['email'];
        
        $dn = explode('-', $dado_form['data_nascimento']);
        $data_nascimento = $dn[2].'/'.$dn[1].'/'.$dn[0];
        
        $cpf = $dado_form['cpf'];
        $telefone1 = $dado_form['telefone1'];
        $telefone2 = $dado_form['telefone2'];
        $cep = $dado_form['cep'];
        $logradouro = $dado_form['logradouro'];
        $numero = $dado_form['numero'];
        $complemento = $dado_form['complemento'];
        $uf = $dado_form['UF'];
        $cidade = $dado_form['cidade'];
        $id_intervalo_doacao = $dado_form['id_intervalo_doacao'];
        $id_forma_pagamento = $dado_form['id_forma_pagamento'];
        $valor_doacao = $dado_form['valor_doacao'];
        $id = $dado_form['id'];
    }

    mysqli_close($link);
    $botaoSubmit = 'disabled';
    $botaoUpdate = '';
}

if(@$_GET['acao'] == 'delete') {

    //Conexão com Banco de Dados MySql
    $link = mysqli_connect("localhost", "root", "", "pmk");

    $sql_delete1 = "DELETE FROM enderecos WHERE id_doador = '".$_GET['id']."'";
    mysqli_query($link,$sql_delete1);

    $sql_delete2 = "DELETE FROM doadores WHERE id = '".$_GET['id']."'";
    mysqli_query($link,$sql_delete2);

    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <title>Teste PMK</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $("#myInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#myTable tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
  </head>
  <body>
    <?php
    if($msg){
    ?>
    <div class="alert alert-<?php echo $alert;?>" role="alert">
        <?php echo $msg; ?>
    </div>
    <?php
    }
    ?>
    <div class="container">
        <form method="POST" action="index.php" class="needs-validation" novalidate>
            <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $_GET['id'] ?>">
            <div class="container">
                <div class="alert alert-primary" role="alert">

                    <div class="mt-3">
                        <h4>Dados Pessoais</h4>
                    </div>
                    <div class="form-row">
                        <div class="col-lg-12 col-md-12 col-sm-12 mt-3">
                            <label for="nome">Nome*</label>
                            <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $nome; ?>" required>
                            <div class="invalid-feedback">
                                Favor inserir um nome.
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-lg-12 col-md-12 col-sm-12 mt-3">
                            <label for="email">E-mail*</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>" required>
                            <div class="invalid-feedback">
                                Favor inserir um e-mail válido.
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-lg-2 col-md-2 col-sm-2 mt-3">
                            <label for="data_nascimento">Data de Nascimento*</label>
                            <input type="data_nascimento" class="form-control" id="data_nascimento" name="data_nascimento" value="<?php echo $data_nascimento; ?>" placeholder="00/00/0000" onkeypress="$(this).mask('00/00/0000');" required>
                            <div class="invalid-feedback">
                                Favor inserir a data de nascimento.
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 mt-3">
                            <label for="cpf">CPF*</label>
                            <input type="cpf" class="form-control" id="cpf" name="cpf" value="<?php echo $cpf; ?>" placeholder="000.000.000-00" onkeypress="$(this).mask('000.000.000-00');" required>
                            <div class="invalid-feedback">
                                Favor inserir um cpf.
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-lg-6 col-md-6 col-sm-6 mt-3">
                            <label for="telefone1">Telefone 1*</label>
                            <input type="text" class="form-control" id="telefone1" name="telefone1" value="<?php echo $telefone1; ?>" placeholder="(00) 00000-0000" onkeypress="$(this).mask('(00) 00000-0000');" required>
                            <div class="invalid-feedback">
                                Favor inserir um telefone.
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 mt-3">
                            <label for="telefone2">Telefone 2</label>
                            <input type="text" class="form-control" id="telefone2" name="telefone2" value="<?php echo $telefone2; ?>" placeholder="(00) 00000-0000" onkeypress="$(this).mask('(00) 00000-0000');">
                        </div>
                    </div>

                    <div class="mt-5">
                        <h4>Dados de Endereço</h4>
                    </div>
                    <div class="form-row">
                        <div class="col-lg-3 col-md-3 col-sm-3 mt-3">
                            <label for="cep">CEP*</label>
                            <input type="text" class="form-control" id="cep" name="cep" value="<?php echo $cep; ?>" placeholder="00000-000" onkeypress="$(this).mask('00000-000');" required>
                            <div class="invalid-feedback">
                                Favor inserir o CEP.
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-lg-10 col-md-10 col-sm-10 mt-3">
                            <label for="logradouro">Logradouro*</label>
                            <input type="text" class="form-control" id="logradouro" name="logradouro" value="<?php echo $logradouro; ?>" required>
                            <div class="invalid-feedback">
                                Favor inserir um logradouro.
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-2 mt-3">
                            <label for="numero">Número</label>
                            <input type="text" class="form-control" id="numero" name="numero" value="<?php echo $numero; ?>">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-lg-6 col-md-6 col-sm-6 mt-3">
                            <label for="complemento">Complemento</label>
                            <input type="text" class="form-control" id="complemento" name="complemento" value="<?php echo $complemento; ?>">
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-2 mt-3">
                            <label for="uf">UF*</label>
                            <input type="text" class="form-control" id="uf" name="uf" value="<?php echo $uf; ?>" required>
                            <div class="invalid-feedback">
                                Favor inserir o UF.
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 mt-3">
                            <label for="cidade">Cidade*</label>
                            <input type="text" class="form-control" id="cidade" name="cidade" value="<?php echo $cidade; ?>" required>
                            <div class="invalid-feedback">
                                Favor inserir uma cidade.
                            </div>
                        </div>
                    </div>
            
                    <div class="mt-5">
                        <h4>Dados de Doação</h4>
                    </div>
                    <div class="form-row">
                        <div class="col-lg-3 col-md-3 col-sm-3 mt-3">
                            <label for="id_intervalo_doacao">Intervalo de doação*</label>
                            <?php
                            //Conexão com Banco de Dados MySql
                            $link = mysqli_connect("localhost", "root", "", "pmk");
                            
                            $sql_intervalo = "SELECT * FROM intervalo_doacao order by id";
                            
                            $query_intervalo = mysqli_query($link,$sql_intervalo);
                            ?>
                            <select class="form-control" id="id_intervalo_doacao" name="id_intervalo_doacao" required>
                                <option value="">Escolha um intervalo</option>
                                <?php
                                while($dado_intervalo = $query_intervalo->fetch_array()) {
                                ?>
                                <option value="<?php echo $dado_intervalo['id']; ?>" <?php if($id_intervalo_doacao == $dado_intervalo['id']) { echo "selected"; } ?>><?php echo $dado_intervalo['descricao']?></option>
                                <?php
                                }
                                ?>
                            </select>
                            <div class="invalid-feedback">
                                Favor selecionar um intervalo.
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 mt-3">
                            <label for="valor_doacao">Valor da doação*</label>
                            <input type="text" class="form-control" id="valor_doacao" name="valor_doacao" value="<?php echo $valor_doacao; ?>" required>
                            <div class="invalid-feedback">
                                Favor inserir um valor.
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 mt-3 mb-3">
                            <label for="id_forma_pagamento">Forma de pagamento*</label>
                            <?php
                            //Conexão com Banco de Dados MySql
                            $link = mysqli_connect("localhost", "root", "", "pmk");
                            
                            $sql_pgto = "SELECT * FROM forma_pagamento order by descricao";
                            
                            $query_pagto = mysqli_query($link,$sql_pgto);
                            ?>
                            <select class="form-control" id="id_forma_pagamento" name="id_forma_pagamento" required>
                                <option value="">Forma de pagamento</option>
                                <?php
                                while($dado = $query_pagto->fetch_array()) {
                                ?>
                                    <option value="<?php echo $dado['id']; ?>" <?php if($id_forma_pagamento == $dado['id']) { echo 'selected'; } ?>><?php echo $dado['descricao']; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                            <div class="invalid-feedback">
                                Favor selecionar uma forma de pagto.
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 mt-12" style="text-align: right;">
                        <button type="submit" class="btn btn-primary" name="Inserir" value="Inserir" <?php echo $botaoSubmit; ?>>Submit</button>
                        <button type="submit" class="btn btn-info" name="Update" value="Update"  <?php echo $botaoUpdate; ?>>Update</button>
                    </div>
                </div>
            </div>
        </form>
        <p></p>
        <?php
        //Conexão com Banco de Dados MySql
        $link = mysqli_connect("localhost", "root", "", "pmk");
        
        $sql2 = "SELECT * FROM doadores order by nome";
        
        $query = mysqli_query($link,$sql2);
        
        ?>
        <h4>Lista de Doadores</h4>
        
            <div class="form-row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <input type="text" class="form-control" id="myInput" placeholder="pesquisar...">
                </div>
            </div>
        
        <table class="table table-striped">
            <thead>
                <tr>
                <th scope="col">Nome</th>
                <th scope="col">Email</th>
                <th scope="col">CPF</th>
                <th scope="col">Idade</th>
                <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody id="myTable">
                <?php
                $x=0;
                while($dado = $query->fetch_array()) {
                    
                    $data_nasc = explode("-", $dado['data_nascimento']);
                    $data = $data_nasc[2].'/'.$data_nasc[1].'/'.$data_nasc[0];
                    list($dia, $mes, $ano) = explode('/', $data);
                    $hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
                    $nascimento = mktime( 0, 0, 0, $mes, $dia, $ano);
                    $idade = floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25);
                ?>
                    <tr>
                        <td><?php echo $dado['nome']; ?></td>
                        <td><?php echo $dado['email'];?></td>
                        <td><?php echo $dado['cpf'];?></td>
                        <td><?php echo $idade;?></td>
                        <td><a href="?acao=update&id=<?php echo $dado['id'];?>">U</a> | <a href="?acao=delete&id=<?php echo $dado['id']; ?>">D</a></td>
                    </tr>
                <?php
                }
                mysqli_close($link);
                ?>
            </tbody>
        </table>
    </div>
    <script>
        (function() {
        'use strict';
        window.addEventListener('load', function() {
            
            var forms = document.getElementsByClassName('needs-validation');
            
            var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
            });
        }, false);
        })();
    </script>
    
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>