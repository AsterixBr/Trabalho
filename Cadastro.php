<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
        <style>
            .btInput{
                padding: 10px 20px 10px 20px;
                margin-top: 20px;
                margin-bottom: 20px;
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
                <div class="col-8 offset-2">

                    <div class="card-header bg-light text-center border"
                         style="padding-bottom: 15px; padding-top: 15px;">
                        Cadastro de Cliente
                    </div>
                    <?php
                    //envio dos dados para o BD
                    if (isset($_POST['cadastrar'])) {
                        $nome = $_POST['nome'];
                        $dtNasc = $_POST['dtNasc'];
                        $login = $_POST['login'];
                        $senha = $_POST['senha'];
                        $perfil = $_POST['perfil'];
                        $cpf = $_POST['cpf'];
                        $email = $_POST['email'];

                        $pc = new PessoaController();
                        include_once '/controller/PessoaController.php';
                        echo "<p>".$pc->inserirPessoa($nome, $dtNasc, 
                            $login, $senha, $perfil, $email, $cpf)."</p>";
                    }
                    ?>
                    <div class="card-body border">
                        <form method="post" action="">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Código: </label> <br> 
                                    <label>Nome Completo</label>  
                                    <input class="form-control" type="text" 
                                           name="nome">
                                    <label>Data de Nascimento</label>  
                                    <input class="form-control" type="date" 
                                           name="dtNasc">  
                                    <label>E-Mail</label>  
                                    <input class="form-control" type="email" 
                                           name="email"> 
                                    <label>CPF</label> 
                                    <label id="valCpf" style="color: red; font-size: 11px;"></label>
                                    <input class="form-control" type="text" id="cpf" 
                                           onkeypress="mascara(this, '###.###.###-##')" maxlength="14"
                                           onblur="return validaCpfCnpj();" name="cpf"
                                           required="required">
                                </div>
                                <div class="col-md-6">
                                    <br>
                                    <label>Login</label>  
                                    <input class="form-control" type="text" 
                                           name="login">  
                                    <label>Senha</label>  
                                    <input class="form-control" type="password" 
                                           name="senha"> 
                                    <label>Conf. Senha</label>  
                                    <input class="form-control" type="password" 
                                           name="senha2"> 
                                    <label>Perfil</label>  
                                    <select name="perfil" class="form-control">
                                        <option>[--Selecione--]</option>
                                        <option>Cliente</option>
                                        <option>Funcionário</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6 offset-4">
                                <input type="submit" name="cadastrar"
                                       class="btn btn-success btInput" value="Enviar">
                                &nbsp;&nbsp;
                                <input type="reset" 
                                       class="btn btn-light btInput" value="Limpar">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script src="js/bootstrap.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script>
            function apenasNumeros(string) 
            {
                var numsStr = string.replace(/[^0-9]/g,'');
                return parseInt(numsStr);
            }
            function mascara(t, mask){
                var i = t.value.length;
                var saida = mask.substring(1,0);
                var texto = mask.substring(i);
                var n = texto.substring(0,1);
                var n = n.replace(/[a-zA-z]/,'');
                n = parseInt(n);
                if(isNaN(n)){
                    if (texto.substring(0,1) !== saida){
                        t.value += texto.substring(0,1);
                    }
                }else{
                    t.value = "";
                    document.getElementById("cpf").value = "";
                }
            }
        </script>        
<script>
 function validaCpfCnpj() {
    var val = document.getElementById("cpf").value;
    if (val.length == 14) {
        var cpf = val.trim();
     
        cpf = cpf.replace(/\./g, '');
        cpf = cpf.replace('-', '');
        cpf = cpf.split('');
        
        var v1 = 0;
        var v2 = 0;
        var aux = false;
        
        for (var i = 1; cpf.length > i; i++) {
            if (cpf[i - 1] != cpf[i]) {
                aux = true;   
            }
        } 
        
        if (aux == false) {
            document.getElementById("valCpf").innerHTML = "* CPF inválido";
            return false; 
        } 
        
        for (var i = 0, p = 10; (cpf.length - 2) > i; i++, p--) {
            v1 += cpf[i] * p; 
        } 
        
        v1 = ((v1 * 10) % 11);
        
        if (v1 == 10) {
            v1 = 0; 
        }
        
        if (v1 != cpf[9]) {
            document.getElementById("valCpf").innerHTML = "* CPF inválido";
            return false; 
        } 
        
        for (var i = 0, p = 11; (cpf.length - 1) > i; i++, p--) {
            v2 += cpf[i] * p; 
        } 
        
        v2 = ((v2 * 10) % 11);
        
        if (v2 == 10) {
            v2 = 0; 
        }
        
        if (v2 != cpf[10]) {
            document.getElementById("valCpf").innerHTML = "* CPF inválido";
            return false; 
        } else {  
            document.getElementById("valCpf").innerHTML = "";
            return true; 
        }
    } else if (val.length == 18) {
        var cnpj = val.trim();
        
        cnpj = cnpj.replace(/\./g, '');
        cnpj = cnpj.replace('-', '');
        cnpj = cnpj.replace('/', ''); 
        cnpj = cnpj.split(''); 
        
        var v1 = 0;
        var v2 = 0;
        var aux = false;
        
        for (var i = 1; cnpj.length > i; i++) { 
            if (cnpj[i - 1] != cnpj[i]) {  
                aux = true;   
            } 
        } 
        
        if (aux == false) {  
            document.getElementById("valCpf").innerHTML = "* CPF inválido";
            return false; 
        }
        
        for (var i = 0, p1 = 5, p2 = 13; (cnpj.length - 2) > i; i++, p1--, p2--) {
            if (p1 >= 2) {  
                v1 += cnpj[i] * p1;  
            } else {  
                v1 += cnpj[i] * p2;  
            } 
        } 
        
        v1 = (v1 % 11);
        
        if (v1 < 2) { 
            v1 = 0; 
        } else { 
            v1 = (11 - v1); 
        } 
        
        if (v1 != cnpj[12]) {  
            document.getElementById("valCpf").innerHTML = "* CPF inválido";
            return false; 
        } 
        
        for (var i = 0, p1 = 6, p2 = 14; (cnpj.length - 1) > i; i++, p1--, p2--) { 
            if (p1 >= 2) {  
                v2 += cnpj[i] * p1;  
            } else {   
                v2 += cnpj[i] * p2; 
            } 
        }
        
        v2 = (v2 % 11); 
        
        if (v2 < 2) {  
            v2 = 0;
        } else { 
            v2 = (11 - v2); 
        } 
        
        if (v2 != cnpj[13]) {
            document.getElementById("valCpf").innerHTML = "* CPF inválido";
            return false; 
        } else {  
            document.getElementById("valCpf").innerHTML = "";
            return true; 
        }
    } else {
        document.getElementById("valCpf").innerHTML = "* CPF inválido";
        return false;
    }
 }
</script>
    </body>
</html>