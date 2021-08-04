<?php
require_once "C:/xampp/htdocs/PHPMatutinoPDO/dao/daoPessoa.php";
require_once 'C:/xampp/htdocs/PHPMatutinoPDO/model/Pessoa.php';
class PessoController {

    public function inserirPessoa($nome, $dtNasc, $login, $senha, 
            $perfil, $email, $cpf){
        
        $endereco = new Endereco();
        $endereco->setCep($cep);
        
        
        $pessoa = new Pessoa();
        $pessoa->setNome($nome);
        $pessoa->setDtNasc($dtNasc);
        $pessoa->setLogin($login);
        $pessoa->setSenha($senha);
        $pessoa->setPerfil($perfil);
        $pessoa->setEmail($email);
        $pessoa->setCpf($cpf);
        $pessoa->setFkendereco($endereco);
        
                
        $daoPessoa = new daoPessoa();
        return $daoPessoa->inserir($pessoa);
    }
}
