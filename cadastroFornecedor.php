<?php
include_once 'controller/FornecedorController.php';
include_once './model/Fornecedor.php';
include_once './model/Endereco.php';
include_once './model/Mensagem.php';
$msg = new Mensagem();
$en = new Endereco();
$fr = new Fornecedor();
$fr->setEndereco($en);
$btEnviar = FALSE;
$btAtualizar = FALSE;
$btExcluir = FALSE;
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Cadastro</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
        <style>
            .btInput{
                margin-top: 20px;
            }
            .pad15{
                padding-bottom: 15px; padding-top: 15px;
            }
        </style>
        <script>
            function mascara(t, mask){
                var i = t.value.length;
                var saida = mask.substring(1,0);
                var texto = mask.substring(i)
                
                if (texto.substring(0,1) != saida){
                    t.value += texto.substring(0,1);
                }
            }
        </script>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Navbar</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Features</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Pricing</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Dropdown link
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <label id="cepErro" style="color:red;"></label>
        <div class="container-fluid">
            <div class="row" style="margin-top: 30px;">
                <div class="col-md-4">
                    <div class="card-header bg-primary text-center border
                         text-white"><strong>Cadastro de Fornecedor</strong>
                    </div>
                    <div class="card-body border">
                        <?php
                        //envio dos dados para o BD
                        if (isset($_POST['cadastrarFornecedor'])) {
                            $nomeFornecedor = trim($_POST['nomeFornecedor']);
                            if ($nomeFornecedor != "") {
                                $logradouro = $_POST['logradouro'];
                                $complemento = $_POST['complemento'];
                                $bairro = $_POST['bairro'];
                                $cidade = $_POST['cidade'];
                                $uf = $_POST['uf'];
                                $cep = $_POST['cep'];
                                $representante = $_POST['representante'];
                                $email = $_POST['email'];
                                $telFixo = $_POST['telFixo'];
                                $telCel = $_POST['telCel'];

                                $fc = new FornecedorController();
                                unset($_POST['cadastrarFornecedor']);
                                $msg = $fc->inserirFornecedor($nomeFornecedor, $logradouro,
                                        $complemento, $bairro, $cidade, $uf, $cep,
                                        $representante, $email, $telFixo, $telCel);
                                echo $msg->getMsg();
                                echo "<META HTTP-EQUIV='REFRESH' CONTENT=\"2;
                                    URL='cadastroFornecedor.php'\">";
                            }
                        }
                        
                        //método para atualizar dados do produto no BD
                        if (isset($_POST['atualizarFornecedor'])) {
                            $nomeFornecedor = trim($_POST['nomeFornecedor']);
                            if ($nomeFornecedor != "") {
                                $idfornecedor = $_POST['idfornecedor'];
                                $logradouro = $_POST['logradouro'];
                                $complemento = $_POST['complemento'];
                                $bairro = $_POST['bairro'];
                                $cidade = $_POST['cidade'];
                                $uf = $_POST['uf'];
                                $cep = $_POST['cep'];
                                $representante = $_POST['representante'];
                                $email = $_POST['email'];
                                $telFixo = $_POST['telFixo'];
                                $telCel = $_POST['telCel'];

                                $fc = new FornecedorController();
                                unset($_POST['atualizarFornecedor']);
                                $msg = $fc->atualizarFornecedor($idfornecedor, $nomeFornecedor, 
                                        $logradouro, $complemento, $bairro, 
                                        $cidade, $uf, $cep, $representante, $email, 
                                        $telFixo, $telCel);
                                echo $msg->getMsg();
                                echo "<META HTTP-EQUIV='REFRESH' CONTENT=\"2;
                                    URL='cadastroFornecedor.php'\">";
                            }
                        }
                        
                        if (isset($_POST['excluir'])) {
                            if ($fr != null) {
                                $id = $_POST['ide'];
                                
                                $fc = new FornecedorController();
                                unset($_POST['excluir']);
                                $msg = $fc->excluirFornecedor($id);
                                echo $msg->getMsg();
                                echo "<META HTTP-EQUIV='REFRESH' CONTENT=\"2;
                                    URL='cadastroFornecedor.php'\">";
                            }
                        }
                        
                        if (isset($_POST['excluirFornecedor'])) {
                            if ($fr != null) {
                                $id = $_POST['idfornecedor'];
                                unset($_POST['excluirFornecedor']);
                                $fc = new FornecedorController();
                                $msg = $fc->excluirFornecedor($id);
                                echo $msg->getMsg();
                                echo "<META HTTP-EQUIV='REFRESH' CONTENT=\"2;
                                    URL='cadastroFornecedor.php'\">";
                            }
                        }

                        if (isset($_POST['limpar'])) {
                            $fr = null;
                            unset($_GET['id']);
                            header("Location: cadastroFornecedor.php");
                        }
                        if (isset($_GET['id'])) {
                            $btEnviar = TRUE;
                            $btAtualizar = TRUE;
                            $btExcluir = TRUE;
                            $id = $_GET['id'];
                            $fc = new FornecedorController();
                            $fr = $fc->pesquisarFornecedorId($id);
                        }
                        ?>
                        <form method="post" action="">
                            <div class="row">
                                <div class="col-md-12">
                                    <strong>Código: <label style="color:red;">
                                            <?php
                                            if ($fr != null) {
                                                echo $fr->getIdFornecedor();
                                                ?>
                                            </label></strong>
                                        <input type="hidden" name="idfornecedor" 
                                               value="<?php echo $fr->getIdfornecedor(); ?>"><br>
                                               <?php
                                           }
                                           ?>     
                                    <label>Fornecedor</label>  
                                    <input class="form-control" type="text" 
                                           name="nomeFornecedor" 
                                           value="<?php echo $fr->getNomeFornecedor(); ?>">
                                    <label>CEP</label> 
                                    <label id="valCep" style="color: red; font-size: 11px;"></label>
                                    <input class="form-control" type="text" id="cep" 
                                           onkeypress="mascara(this, '#####-###')" maxlength="9"
                                           value="<?php if($fr->getEndereco()->getCep() != ""){
                                            echo $fr->getEndereco->getCep();} ?>" name="cep">
                                    <label>Rua/Logradouro</label>  
                                    <input class="form-control" type="text" id="rua"
                                           value="<?php echo $fr->getEndereco()->getLogradouro(); ?>" name="logradouro">   
                                    <label>Complemento</label>  
                                    <input class="form-control" type="text" id="complemento"
                                           value="<?php echo $fr->getEndereco()->getComplemento(); ?>" name="complemento">
                                    <label>Bairro</label>  
                                    <input class="form-control" type="text" id="bairro"
                                           value="<?php echo $fr->getEndereco()->getBairro(); ?>" name="bairro">
                                    <label>Cidade</label>  
                                    <input class="form-control" type="text" id="cidade"
                                           value="<?php echo $fr->getEndereco()->getCidade(); ?>" name="cidade">
                                    <label>UF</label>  
                                    <input class="form-control" type="text" id="uf"
                                           value="<?php echo $fr->getEndereco()->getUf(); ?>" name="uf">
                                    <label>Representante</label>  
                                    <input class="form-control" type="text" 
                                           value="<?php echo $fr->getRepresentante(); ?>" name="representante">
                                    <label>E-Mail</label>  
                                    <input class="form-control" type="text" 
                                           value="<?php echo $fr->getEmail(); ?>" name="email">
                                    <label>Tel. Fixo</label>  
                                    <input class="form-control" type="text" 
                                           onkeypress="mascara(this, '## ####-####')" maxlength="12"
                                           value="<?php echo $fr->getTelFixo(); ?>" name="telFixo">
                                    <label>Celular (WhatsApp)</label>  
                                    <input class="form-control" type="text" 
                                           onkeypress="mascara(this, '## ####-####')" maxlength="12"
                                           value="<?php echo $fr->getTelCel(); ?>" name="telCel">
                                    <input type="submit" name="cadastrarFornecedor"
                                           class="btn btn-success btInput" value="Enviar"
                                           <?php if($btEnviar == TRUE) echo "disabled"; ?>>
                                    <input type="submit" name="atualizarFornecedor"
                                           class="btn btn-secondary btInput" value="Atualizar"
                                           <?php if($btAtualizar == FALSE) echo "disabled"; ?>>
                                    <button type="button" class="btn btn-warning btInput" 
                                            data-bs-toggle="modal" data-bs-target="#ModalExcluir"
                                            <?php if($btExcluir == FALSE) echo "disabled"; ?>>
                                        Excluir
                                    </button>
                                    <!-- Modal para excluir -->
                                    <div class="modal fade" id="ModalExcluir" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" 
                                                        id="exampleModalLabel">
                                                        Confirmar Exclusão</h5>
                                                    <button type="button" 
                                                            class="btn-close" 
                                                            data-bs-dismiss="modal"
                                                            aria-label="Close">
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <h5>Deseja Excluir?</h5>
                                                </div>
                                                <div class="modal-footer">
                                                    <input type="submit" name="excluirFornecedor"
                                                           class="btn btn-success "
                                                           value="Sim">
                                                    <input type="submit" 
                                                        class="btn btn-light btInput" 
                                                        name="limpar" value="Não">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- fim do modal para excluir -->
                                    &nbsp;&nbsp;
                                    <input type="submit" 
                                           class="btn btn-light btInput" 
                                           name="limpar" value="Limpar">
                                </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-striped table-responsive"
                               style="border-radius: 3px; overflow:hidden;">
                            <thead class="table-dark">
                                <tr><th>Código</th>
                                    <th>Fornecedor</th>
                                    <th>Representante</th>
                                    <th>E-Mail</th>
                                    <th>Tel. Fixo</th>
                                    <th>Celular</th>
                                    <th>Cidade</th>
                                    <th colspan="2">Ações</th></tr>
                            </thead>
                            <tbody>
                                <?php
                                $fcTable = new FornecedorController();
                                $listaFornecedores = $fcTable->listarFornecedores();
                                $a = 0;
                                if ($listaFornecedores != null) {
                                    foreach ($listaFornecedores as $lf) {
                                        $a++;
                                        ?>
                                        <tr>
                                            <td><?php print_r($lf->getIdFornecedor()); ?></td>
                                            <td><?php print_r($lf->getNomeFornecedor()); ?></td>
                                            <td><?php print_r($lf->getRepresentante()); ?></td>
                                            <td><?php print_r($lf->getEmail()); ?></td>
                                            <td><?php print_r($lf->getTelFixo()); ?></td>
                                            <td><?php print_r($lf->getTelCel()); ?></td>
                                            <td><?php print_r($lf->getEndereco()->getUf()); ?></td>
                                            <td><a href="cadastroFornecedor.php?id=<?php echo $lf->getIdfornecedor(); ?>"
                                                   class="btn btn-light">
                                                    <img src="img/edita.png" width="24"></a>
                                                </form>
                                                <button type="button" 
                                                        class="btn btn-light" data-bs-toggle="modal" 
                                                        data-bs-target="#exampleModal<?php echo $a; ?>">
                                                    <img src="img/delete.png" width="24"></button></td>
                                        </tr>
                                        <!-- Modal -->
                                    <div class="modal fade" id="exampleModal<?php echo $a; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                    <button type="button" class="btn-close" 
                                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="post" action="">
                                                        <label><strong>Deseja excluir o fornecedor 
                                                                <?php echo $lf->getNomeFornecedor(); ?>?</strong></label>
                                                        <input type="hidden" name="ide" 
                                                               value="<?php echo $lf->getIdfornecedor(); ?>">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" name="excluir" class="btn btn-primary">Sim</button>
                                                            <button type="reset" class="btn btn-secondary" 
                                                                    data-bs-dismiss="modal">Não</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>
                                </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>     
    </div>


    <script src=" https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js " integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p " crossorigin="anonymous "></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js " integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT " crossorigin="anonymous "></script>
    <script src="js/jQuery.js"></script>
    <script src="js/jQuery.min.js"></script>
    <script>
        var myModal = document.getElementById('myModal')
        var myInput = document.getElementById('myInput')

        myModal.addEventListener('shown.bs.modal', function () {
            myInput.focus()
        })
    </script> 
    <!-- controle de endereço (ViaCep) -->
    <script>

        $(document).ready(function() {

            function limpa_formulário_cep() {
                // Limpa valores do formulário de cep.
                $("#rua").val("");
                $("#bairro").val("");
                $("#cidade").val("");
                $("#uf").val("");
                $("#cepErro").val("");
            }
            
            //Quando o campo cep perde o foco.
            $("#cep").blur(function() {

                //Nova variável "cep" somente com dígitos.
                var cep = $(this).val().replace(/\D/g, '');

                //Verifica se campo cep possui valor informado.
                if (cep != "") {

                    //Expressão regular para validar o CEP.
                    var validacep = /^[0-9]{8}$/;

                    //Valida o formato do CEP.
                    if(validacep.test(cep)) {

                        //Preenche os campos com "..." enquanto consulta webservice.
                        $("#rua").val("...");
                        $("#bairro").val("...");
                        $("#cidade").val("...");
                        $("#uf").val("...");

                        //Consulta o webservice viacep.com.br/
                        $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                            if (!("erro" in dados)) {
                                //Atualiza os campos com os valores da consulta.
                                $("#rua").val(dados.logradouro);
                                $("#bairro").val(dados.bairro);
                                $("#cidade").val(dados.localidade);
                                $("#uf").val(dados.uf);
                            } //end if.
                            else {
                                //CEP pesquisado não foi encontrado.
                                limpa_formulário_cep();
                                document.getElementById("valCep").innerHTML = "* CEP não encontrado";
                            }
                        });
                    } //end if.
                    else {
                        //cep é inválido.
                        limpa_formulário_cep();
                        document.getElementById("valCep").innerHTML = "* Formato inválido";

                    }
                } //end if.
                else {
                    //cep sem valor, limpa formulário.
                    limpa_formulário_cep();
                }
            });
        });

    </script>
</body>
</html>

