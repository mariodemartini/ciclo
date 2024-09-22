<?php
    
    Class Aluno{
        private $idAluno;
        private $nome;
        private $dataNascimento;
        private $idade;
        private $sexo;
        private $cpf;
        private $rg;
        private $telefone;
        private $celular;
        private $cep;
        private $estado;
        private $cidade;
        private $endereco;
        private $email;
        private $senha;
        private $dataCadastro;
        private $situacao;
        private $treino;

        function getIdAluno()
        { 
            return $this->idAluno; 
        }

        function setIdAluno($idAluno)
        { 
            $this->idAluno = $idAluno; 
        }

        function getNome()
        { 
            return $this->nome; 
        }

        function setNome($nome)
        { 
            $this->nome = $nome; 
        }

        function getDataNascimento()
        { 
            return $this->dataNascimento; 
        }

        function setDataNascimento($dataNascimento)
        { 
            $this->dataNascimento = $dataNascimento; 
        }

        function getIdade()
        { 
            return $this->idade; 
        }

        function setIdade($dataNascimento)
        { 
            // separando yyyy, mm, ddd
            list($ano, $mes, $dia) = explode('-', $dataNascimento);

            // data atual
            $hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
            // Descobre a unix timestamp da data de nascimento
            $nascimento = mktime( 0, 0, 0, $mes, $dia, $ano);

            // cálculo
            $idade = floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25);
            
            $this->idade = $idade; 
        }

        function getSexo()
        { 
            return $this->sexo; 
        }

        function setSexo($sexo)
        { 
            $this->sexo = $sexo; 
        }

        function getCpf()
        { 
            return $this->cpf; 
        }

        function setCpf($cpf)
        { 
            $this->cpf = $cpf; 
        }

        function getRg()
        { 
            return $this->rg; 
        }

        function setRg($rg)
        { 
            $this->rg = $rg; 
        }

        function getTelefone()
        { 
            return $this->telefone; 
        }

        function setTelefone($telefone)
        { 
            $this->telefone = $telefone; 
        }

        function getCelular()
        { 
            return $this->celular; 
        }

        function setCelular($celular)
        { 
            $this->celular = $celular; 
        }

        function getCep()
        { 
            return $this->cep; 
        }

        function setCep($cep)
        { 
            $this->cep = $cep; 
        }

        function getEstado() 
        {
            return $this->estado;
        }

        function setEstado($estado)
        {
            $this->estado = $estado;
        }

        function getCidade()
        {
            return $this->cidade;
        }
        
        function setCidade($cidade)
        {
            $this->cidade = $cidade;
        }

        function getEndereco()
        {
            return $this->endereco;
        }

        function setEndereco($endereco)
        {
            $this->endereco = $endereco;
        }

        function getEmail()
        {
            return $this->email;
        }

        function setEmail($email)
        {
            $this->email = $email;
        }

        function getSenha()
        {
            return $this->senha;
        }

        function setSenha($senha)
        {
            $this->senha = $senha;
        }

        function getDataCadastro()
        {
            return $this->dataCadastro;
        }

        function setDataCadastro($dataCadastro)
        {
            $this->dataCadastro = $dataCadastro;
        }

        function getSituacao()
        {
            return $this->situacao;
        }

        function setSituacao($situacao)
        {
            $this->situacao = $situacao;
        }

        function getTreino()
        {
            return $this->treino;
        }

        function setTreino($treino)
        {
            $this->treino = $treino;
        }
    }

    

?>
