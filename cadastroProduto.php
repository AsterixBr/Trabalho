<?php
include_once 'controller/ProdutoController.php';
include_once './model/Produto.php';
include_once './model/Fornecedor.php';
include_once './model/Mensagem.php';
include_once 'controller/FornecedorController.php';
$fcc = new FornecedorController();
$msg = new Mensagem();
$pr = new Produto();
$fornecedor = new Fornecedor();
$pr->setFornecedor($fornecedor);
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

        <div class="container-fluid">
            <div class="row" style="margin-top: 30px;">
                <div class="col-md-4">
                    <div class="card-header bg-dark text-center border
                         text-white"><strong>Cadastro de Produto</strong>
                    </div>
                    <div class="card-body border">
                        <?php
                        //envio dos dados para o BD
                        if (isset($_POST['cadastrarProduto'])) {
                            $nomeProduto = trim($_POST['nomeProduto']);
                            if ($nomeProduto != "") {
                                $vlrCompra = $_POST['vlrCompra'];
                                $vlrVenda = $_POST['vlrVenda'];
                                $qtdEstoque = $_POST['qtdEstoque'];
                                $fkfornecedor = $_POST['idfornecedor'];                                
                                
                                $pc = new ProdutoController();
                                unset($_POST['cadastrarProduto']);
                                $msg = $pc->inserirProduto($nomeProduto, $vlrCompra,
                                        $vlrVenda, $qtdEstoque, $fkfornecedor);
                                echo $msg->getMsg();
                                echo "<META HTTP-EQUIV='REFRESH' CONTENT=\"2;
                                    URL='cadastroProduto.php'\">";
                            }
                        }
                        
                        //método para atualizar dados do produto no BD
                        if (isset($_POST['atualizarProduto'])) {
                            $nomeProduto = trim($_POST['nomeProduto']);
                            if ($nomeProduto != "") {
                                $id = $_POST['idproduto'];
                                $vlrCompra = $_POST['vlrCompra'];
                                $vlrVenda = $_POST['vlrVenda'];
                                $qtdEstoque = $_POST['qtdEstoque'];
                                $fkfornecedor = $_POST['idfornecedor']; 
                                
                                $pc = new ProdutoController();
                                unset($_POST['atualizarProduto']);
                                $msg = $pc->atualizarProduto($id, $nomeProduto, 
                                        $vlrCompra, $vlrVenda, $qtdEstoque,
                                        $fkfornecedor);
                                echo $msg->getMsg();
                                $pr = null;
                                echo "<META HTTP-EQUIV='REFRESH' CONTENT=\"2;
                                    URL='cadastroProduto.php'\">";
                            }
                        }
                        
                        if (isset($_POST['excluir'])) {
                            if ($pr != null) {
                                $id = $_POST['ide'];
                                
                                $pc = new ProdutoController();
                                unset($_POST['excluir']);
                                $msg = $pc->excluirProduto($id);
                                echo $msg->getMsg();
                                echo "<META HTTP-EQUIV='REFRESH' CONTENT=\"2;
                                    URL='cadastroProduto.php'\">";
                            }
                        }
                        
                        if (isset($_POST['excluirProduto'])) {
                            if ($pr != null) {
                                $id = $_POST['idproduto'];
                                unset($_POST['excluirProduto']);
                                $pc = new ProdutoController();
                                $msg = $pc->excluirProduto($id);
                                echo $msg->getMsg();
                                echo "<META HTTP-EQUIV='REFRESH' CONTENT=\"2;
                                    URL='cadastroProduto.php'\">";
                            }
                        }

                        if (isset($_POST['limpar'])) {
                            $pr = null;
                            unset($_GET['id']);
                            header("Location: cadastroProduto.php");
                        }
                        if (isset($_GET['id'])) {
                            $btEnviar = TRUE;
                            $btAtualizar = TRUE;
                            $btExcluir = TRUE;
                            $id = $_GET['id'];
                            $pc = new ProdutoController();
                            $pr = $pc->pesquisarProdutoId($id);
                        }
                        ?>
                        <form method="post" action="">
                            <div class="row">
                                <div class="col-md-12">
                                    <strong>Código: <label style="color:red;">
                                            <?php
                                            if ($pr != null) {
                                                echo $pr->getIdProduto();
                                                ?>
                                            </label></strong>
                                        <input type="hidden" name="idproduto" 
                                               value="<?php echo $pr->getIdProduto(); ?>"><br>
                                               <?php
                                           }
                                           ?>     
                                    <label>Produto</label>  
                                    <input class="form-control" type="text" 
                                           name="nomeProduto" 
                                           value="<?php echo $pr->getNomeProduto(); ?>">
                                    <label>Valor de Compra</label>  
                                    <input class="form-control" type="text" 
                                           value="<?php echo $pr->getVlrCompra(); ?>" name="vlrCompra">  
                                    <label>Valor de Venda</label>  
                                    <input class="form-control" type="text" 
                                           value="<?php echo $pr->getVlrVenda(); ?>" name="vlrVenda"> 
                                    <label>Qtde em Estoque</label>  
                                    <input class="form-control" type="number" 
                                           value="<?php echo $pr->getQtdEstoque(); ?>" name="qtdEstoque">
                                    
                                    <label>Fornecedor</label>  
                                    <select class="form-control"  name="idfornecedor">
                                        <option>[--SELECIONE--]</option>
                                        <?php
                                          $listaFornecedores = $fcc->listarFornecedores();
                                          if($listaFornecedores != null){
                                              foreach ($listaFornecedores as $lf){
                                                  ?>
                                            <option value="<?php echo $lf->getIdfornecedor();?>"
                                            <?php
                                            $fk = $pr->getFornecedor()->getIdfornecedor();
                                            if($pr->getFornecedor()->getIdfornecedor() != ""){
                                                if($lf->getIdfornecedor() == 
                                                        $pr->getFornecedor()->getIdfornecedor()){
                                                    echo "selected = 'selected'";
                                                }
                                            }
                                            ?>
                                            >
                                                    <?php echo $lf->getNomeFornecedor();?></option>
                                        <?php
                                              }
                                          }
                                        ?>
                                    </select>
                                    <input type="submit" name="cadastrarProduto"
                                           class="btn btn-success btInput" value="Enviar"
                                           <?php if($btEnviar == TRUE) echo "disabled"; ?>>
                                    <input type="submit" name="atualizarProduto"
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
                                                    <input type="submit" name="excluirProduto"
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
                                    <th>Produto</th>
                                    <th>Compra (R$)</th>
                                    <th>Venda (R$)</th>
                                    <th>Estoque</th>
                                    <th>Fornecedor</th>
                                    <th>Representante</th>
                                    <th colspan="2" style="text-align:center;">Ações</th></tr>
                            </thead>
                            <tbody>
                                <?php
                                $pcTable = new ProdutoController();
                                $listaProdutos = $pcTable->listarProdutos();
                                $a = 0;
                                if ($listaProdutos != null) {
                                    foreach ($listaProdutos as $lp) {
                                        $a++;
                                        ?>
                                        <tr>
                                            <td><?php print_r($lp->getIdProduto()); ?></td>
                                            <td><?php print_r($lp->getNomeProduto()); ?></td>
                                            <td><?php print_r($lp->getVlrCompra()); ?></td>
                                            <td><?php print_r($lp->getVlrVenda()); ?></td>
                                            <td><?php print_r($lp->getQtdEstoque()); ?></td>
                                            <td><?php print_r($lp->getFornecedor()->getNomefornecedor()); ?></td>
                                            <td><?php print_r($lp->getFornecedor()->getRepresentante()); ?></td>
                                            <td><a href="cadastroProduto.php?id=<?php echo $lp->getIdProduto(); ?>"
                                                   class="btn btn-light">
                                                    <img src="img/edita.png" width="24"></a></td>
                                                </form>
                                                <td><button type="button" 
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
                                                        <label><strong>Deseja excluir o produto 
                                                                <?php echo $lp->getNomeProduto(); ?>?</strong></label>
                                                        <input type="hidden" name="ide" 
                                                               value="<?php echo $lp->getIdProduto(); ?>">
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
    <script>
        var myModal = document.getElementById('myModal')
        var myInput = document.getElementById('myInput')

        myModal.addEventListener('shown.bs.modal', function () {
            myInput.focus()
        })
    </script> 
</body>
</html>

