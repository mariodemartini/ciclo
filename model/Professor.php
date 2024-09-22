<?php
    
    Class Professor{
        private $idProfessor;
        private $nome;
        private $dataNascimento;
        private $sexo;
        private $cpf;
        private $cref;
        private $celular;
        private $cep;
        private $estado;
        private $cidade;
        private $endereco;
        private $email;
        private $senha;
        private $situacao;

        function getIdProfessor()
        { 
            return $this->idProfessor; 
        }

        function setIdProfessor($idProfessor)
        { 
            $this->idProfessor = $idProfessor; 
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

        function getCref()
        { 
            return $this->cref; 
        }

        function setCref($cref)
        { 
            $this->cref = $cref; 
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

        function getSituacao()
        {
            return $this->situacao;
        }

        function setSituacao($situacao)
        {
            $this->situacao = $situacao;
        }

    }
   

?>
