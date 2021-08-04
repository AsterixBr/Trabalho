<?php
include_once 'C:/xampp/htdocs/PHPMatutinoPDO2/bd/Conecta.php';
include_once 'C:/xampp/htdocs/PHPMatutinoPDO2/model/Fornecedor.php';
include_once 'C:/xampp/htdocs/PHPMatutinoPDO2/model/Endereco.php';
include_once 'C:/xampp/htdocs/PHPMatutinoPDO2/model/Mensagem.php';

class DaoFornecedor {

    public function inserir(Fornecedor $fornecedor){
        $conn = new Conecta();
        $msg = new Mensagem();
        $conecta = $conn->conectadb();
        if($conecta){
            $nomeFornecedor = $fornecedor->getNomeFornecedor();
            $logradouro = $fornecedor->getEndereco()->getLogradouro();
            $complemento = $fornecedor->getEndereco()->getComplemento();
            $bairro = $fornecedor->getEndereco()->getBairro();
            $cidade = $fornecedor->getEndereco()->getCidade();
            $uf = $fornecedor->getEndereco()->getUf();
            $cep = $fornecedor->getEndereco()->getCep();
            $representante = $fornecedor->getRepresentante();
            $email = $fornecedor->getEmail();
            $telFixo = $fornecedor->getTelFixo();
            $telCel = $fornecedor->getTelCel();
            //$msg->setMsg("$logradouro, $complemento, $cep");
            try {
                //processo para pegar o idendereco da tabela endereco, conforme 
                //o cep, o logradouro e o complemento informado.
                $st = $conecta->prepare("select idendereco "
                        . "from endereco where cep = ? and "
                        . "logradouro = ? and complemento = ? limit 1");
                $st->bindParam(1, $cep);
                $st->bindParam(2, $logradouro);
                $st->bindParam(3, $complemento);
                if($st->execute()){
                    if($st->rowCount() > 0){
                        $msg->setMsg("".$st->rowCount());
                        while($linha = $st->fetch(PDO::FETCH_OBJ)){
                            $fkEnd = $linha->idendereco;
                        }
                        //$msg->setMsg("$fkEnd");
                    }else{
                        $st2 = $conecta->prepare("insert into "
                                . "endereco values (null,?,?,?,?,?,?)");
                        $st2->bindParam(1, $logradouro);
                        $st2->bindParam(2, $complemento);
                        $st2->bindParam(3, $bairro);
                        $st2->bindParam(4, $cidade);
                        $st2->bindParam(5, $uf);
                        $st2->bindParam(6, $cep);
                        $st2->execute();

                        $st3 = $conecta->prepare("select idendereco "
                            . "from endereco where cep = ? and "
                            . "logradouro = ? and complemento = ? limit 1");
                        $st3->bindParam(1, $cep);
                        $st3->bindParam(2, $logradouro);
                        $st3->bindParam(3, $complemento);
                        if($st3->execute()){
                            if($st3->rowCount() > 0){
                                $msg->setMsg("".$st3->rowCount());
                                while($linha = $st3->fetch(PDO::FETCH_OBJ)){
                                    $fkEnd = $linha->idendereco;
                                }
                                //$msg->setMsg("$fkEnd");
                            }
                        }
                    }
                    
                    //processo para inserir dados de fornecedor
                    $stmt = $conecta->prepare("insert into fornecedor values "
                            . "(null,?,?,?,?,?,?)");
                    $stmt->bindParam(1, $nomeFornecedor);
                    $stmt->bindParam(2, $representante);
                    $stmt->bindParam(3, $email);
                    $stmt->bindParam(4, $telFixo);
                    $stmt->bindParam(5, $telCel);
                    $stmt->bindParam(6, $fkEnd);
                    $stmt->execute();
                }
                
                //$msg->setMsg("<p style='color: green;'>"
                        //. "Dados Cadastrados com sucesso</p>");
            } catch (Exception $ex) {
                $msg->setMsg($ex);
            }
        }else{
            $msg->setMsg("<p style='color: red;'>"
                        . "Erro na conexão com o banco de dados.</p>");
        }
        $conn = null;
           
        return $msg;
    }
    
    //método para atualizar dados da tabela produto
    public function atualizarFornecedorDAO(Fornecedor $fornecedor){
        $conn = new Conecta();
        $msg = new Mensagem();
        $conecta = $conn->conectadb();
        if($conecta){
            $idfornecedor = $fornecedor->getIdfornecedor();
            $nomeFornecedor = $fornecedor->getNomeFornecedor();
            $logradouro = $fornecedor->getLogradouro();
            $complemento = $fornecedor->getComplemento();
            $bairro = $fornecedor->getBairro();
            $cidade = $fornecedor->getCidade();
            $uf = $fornecedor->getUf();
            $cep = $fornecedor->getCep();
            $representante = $fornecedor->getRepresentante();
            $email = $fornecedor->getEmail();
            $telFixo = $fornecedor->getTelFixo();
            $telCel = $fornecedor->getTelCel();
            try{
                $stmt = $conecta->prepare("update fornecedor set "
                        . "nomeFornecedor = ?,"
                        . "logradouro = ?,"
                        . "complemento = ?, "
                        . "bairro = ?, "
                        . "cidade = ?, "
                        . "uf = ?, "
                        . "cep = ?, "
                        . "representante = ?, "
                        . "email = ?, "
                        . "telfixo = ?, "
                        . "telcel = ? "
                        . "where idfornecedor = ?");
                $stmt->bindParam(1, $nomeFornecedor);
                $stmt->bindParam(2, $logradouro);
                $stmt->bindParam(3, $complemento);
                $stmt->bindParam(4, $bairro);
                $stmt->bindParam(5, $cidade);
                $stmt->bindParam(6, $uf);
                $stmt->bindParam(7, $cep);
                $stmt->bindParam(8, $representante);
                $stmt->bindParam(9, $email);
                $stmt->bindParam(10, $telFixo);
                $stmt->bindParam(11, $telCel);
                $stmt->bindParam(12, $idfornecedor);
                $stmt->execute();
                $msg->setMsg("<p style='color: blue;'>"
                        . "Dados atualizados com sucesso</p>");
            } catch (Exception $ex) {
                $msg->setMsg($ex);
            }
        }else{
            $msg->setMsg("<p style='color: red;'>"
                        . "Erro na conexão com o banco de dados.</p>");
        }
        $conn = null;
        return $msg;
    }
    
    //método para carregar lista de produtos do banco de dados
    public function listarFornecedorsDAO(){
        $conn = new Conecta();
        $conecta = $conn->conectadb();
        if($conecta){
            try {
                $rs = $conecta->query("select * from fornecedor inner join endereco "
                        . " on fornecedor.fkendereco = endereco.idendereco");
                $lista = array();
                $a = 0;
                if($rs->execute()){
                    if($rs->rowCount() > 0){
                        while($linha = $rs->fetch(PDO::FETCH_OBJ)){
                            $endereco = new Endereco();
                            $endereco->setLogradouro($linha->logradouro);
                            $endereco->setComplemento($linha->complemento);
                            $endereco->setBairro($linha->bairro);
                            $endereco->setCidade($linha->cidade);
                            $endereco->setUf($linha->uf);
                            $endereco->setCep($linha->cep);
                            
                            $fornecedor = new Fornecedor();
                            $fornecedor->setIdfornecedor($linha->idfornecedor);
                            $fornecedor->setNomeFornecedor($linha->nomeFornecedor);
                            $fornecedor->setRepresentante($linha->representante);
                            $fornecedor->setEmail($linha->email);
                            $fornecedor->setTelFixo($linha->telfixo);
                            $fornecedor->setTelCel($linha->telcel);
                            $fornecedor->setEndereco($endereco);
                            $lista[$a] = $fornecedor;
                            $a++;
                        }
                    }
                }
            } catch (Exception $ex) {
                $msg->setMsg($ex);
            }  
            $conn = null;           
            return $lista;
        }
    }
    
    //método para excluir produto na tabela produto
    public function excluirFornecedorDAO($id){
        $conn = new Conecta();
        $conecta = $conn->conectadb();
        $msg = new Mensagem();
        if($conecta){
             try {
                $stmt = $conecta->prepare("delete from fornecedor "
                        . "where idfornecedor = ?");
                $stmt->bindParam(1, $id);
                $stmt->execute();
                $msg->setMsg("<p style='color: #d6bc71;'>"
                        . "Dados excluídos com sucesso.</p>");
            } catch (Exception $ex) {
                $msg->setMsg($ex);
            }
        }else{
            $msg->setMsg("<p style='color: red;'>'Banco inoperante!'</p>"); 
        }
        $conn = null;
        return $msg;
    }
    
    //método para os dados de produto por id
    public function pesquisarFornecedorIdDAO($id){
        $conn = new Conecta();
        $conecta = $conn->conectadb();
        $fornecedor = new Fornecedor();
        if($conecta){
            try {
                $rs = $conecta->prepare("select * from fornecedor inner join endereco "
                        . " on fornecedor.fkendereco = endereco.idendereco where "
                        . "idfornecedor = ? limit 1");
                $rs->bindParam(1, $id);
                if($rs->execute()){
                    if($rs->rowCount() > 0){
                        while($linha = $rs->fetch(PDO::FETCH_OBJ)){
                            
                            $endereco = new Endereco();
                            $endereco->setLogradouro($linha->logradouro);
                            $endereco->setComplemento($linha->complemento);
                            $endereco->setBairro($linha->bairro);
                            $endereco->setCidade($linha->cidade);
                            $endereco->setUf($linha->uf);
                            $endereco->setCep($linha->cep);
                            
                            $fornecedor->setIdfornecedor($linha->idfornecedor);
                            $fornecedor->setNomeFornecedor($linha->nomeFornecedor);
                            $fornecedor->setRepresentante($linha->representante);
                            $fornecedor->setEmail($linha->email);
                            $fornecedor->setTelFixo($linha->telfixo);
                            $fornecedor->setTelCel($linha->telcel);
                            $fornecedor->setEndereco($endereco);
                        }
                    }
                }
            } catch (Exception $ex) {
                $msg->setMsg($ex);
            }  
            $conn = null;
        }else{
            echo "<script>alert('Banco inoperante!')</script>";
            echo "<META HTTP-EQUIV='REFRESH' CONTENT=\"0;
			 URL='../PHPMatutino01/cadastroFornecedor.php'\">"; 
        }
        return $fornecedor;
    }
}
