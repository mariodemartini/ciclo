<?php
    
    Class TesteVO2{
        private $idTesteVO2;
        private $dataCadastro;
        private $velocidadeInicial;
        private $velocidadeFinal;
        private $fcInicial;
        private $fcFinal;
        private $tempoTeste;
        private $esforcoTeste;
        private $aluno;
        
        function getIdTesteVO2()
        {
            return $this->idTesteVO2;
        }
        function setIdTesteVO2($idTesteVO2)
        {
            $this->idTesteVO2 = $idTesteVO2;
        }

        function getDataCadastro()
        {
            return $this->dataCadastro;           
        }
        function setDataCadastro($dataCadastro)
        {
            $this->dataCadastro = $dataCadastro;
        }

        function getVelocidadeInicial()
        {
            return $this->velocidadeInicial;           
        }

        function setVelocidadeInicial($velocidadeInicial)
        {
            $this->velocidadeInicial = $velocidadeInicial;
        }

        function getVelocidadeFinal()
        {
            return $this->velocidadeFinal;           
        }

        function setVelocidadeFinal($velocidadeFinal)
        {
            $this->velocidadeFinal = $velocidadeFinal;
        }

        function getFcInicial()
        {
            return $this->fcInicial;           
        }
        function setFcInicial($fcInicial)
        {
            $this->fcInicial = $fcInicial;
        }

        function getFcFinal()
        {
            return $this->fcFinal;           
        }
        function setFcFinal($fcFinal)
        {
            $this->fcFinal = $fcFinal;
        }

        function getTempoTeste()
        {
            return $this->tempoTeste;           
        }
        function setTempoTeste($tempoTeste)
        {
            $this->tempoTeste = $tempoTeste;
        }

        function getEsforcoTeste()
        {
            return $this->esforcoTeste;           
        }
        function setEsforcoTeste($esforcoTeste)
        {
            $this->esforcoTeste = $esforcoTeste;
        }

        function getAluno()
        {
            return $this->aluno;           
        }
        function setAluno($aluno)
        {
            $this->aluno = $aluno;
        }

    }
?>
