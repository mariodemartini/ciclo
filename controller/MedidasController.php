<?php
    include_once "../conexao/Conexao.php";
    include_once "../model/Medidas.php";
    include_once "../dao/MedidasDAO.php";

    $medidas = new Medidas();
    $medidasdao = new MedidasDAO();

    $d = filter_input_array(INPUT_POST);

    if(isset($_POST['salvar'])){

        $medidas->setDataCadastro(($d['dataCadastro']));
        $medidas->setPeso(($d['peso']));
        $medidas->setAltura(($d['altura']));
        $medidas->setFreqCard(($d['freqCard']));
        $medidas->setPressaoArterial(($d['pressaoArterial']));
        $medidas->setTorax(($d['torax']));
        $medidas->setCintura(($d['cintura']));
        $medidas->setAbdomen(($d['abdomen']));
        $medidas->setQuadril(($d['quadril']));
        $medidas->setBracoDireito(($d['bracoDireito']));
        $medidas->setBracoEsquerdo(($d['bracoEsquerdo']));
        $medidas->setAntebracoDireito(($d['antebracoDireito']));
        $medidas->setAntebracoEsquerdo(($d['antebracoEsquerdo']));
        $medidas->setCoxaDireita(($d['coxaDireita']));
        $medidas->setCoxaEsquerda(($d['coxaEsquerda']));
        $medidas->setPanturrilhaDireita(($d['panturrilhaDireita']));
        $medidas->setPanturrilhaEsquerda(($d['panturrilhaEsquerda']));
        $medidas->setPeitoral(($d['peitoral']));
        $medidas->setAxilarMedia(($d['axilarMedia']));
        $medidas->setAbdominal(($d['abdominal']));
        $medidas->setSupraIliaca(($d['supraIliaca']));
        $medidas->setSubEscapular(($d['subEscapular']));
        $medidas->setTricipital(($d['tricipital']));
        $medidas->setCoxa(($d['coxa']));
        $medidas->setAluno(($d['idAluno']));
        
        $medidasdao->create($medidas);

        header("Location: ../nova-avaliacao.php");
    }

    else if (isset($_POST['editar'])) {

        $medidas->setIdMedidas(($d['idMedidas']));
        $medidas->setDataCadastro(($d['dataCadastro']));
        $medidas->setPeso(($d['peso']));
        $medidas->setAltura(($d['altura']));
        $medidas->setFreqCard(($d['freqCard']));
        $medidas->setPressaoArterial(($d['pressaoArterial']));
        $medidas->setTorax(($d['torax']));
        $medidas->setCintura(($d['cintura']));
        $medidas->setAbdomen(($d['abdomen']));
        $medidas->setQuadril(($d['quadril']));
        $medidas->setBracoDireito(($d['bracoDireito']));
        $medidas->setBracoEsquerdo(($d['bracoEsquerdo']));
        $medidas->setAntebracoDireito(($d['antebracoDireito']));
        $medidas->setAntebracoEsquerdo(($d['antebracoEsquerdo']));
        $medidas->setCoxaDireita(($d['setCoxaDireita']));
        $medidas->setCoxaEsquerda(($d['coxaEsquerda']));
        $medidas->setPanturrilhaDireita(($d['panturrilhaDireita']));
        $medidas->setPanturrilhaEsquerda(($d['panturrilhaEsquerda']));
        $medidas->setPeitoral(($d['Peitoral']));
        $medidas->setAxilarMedia(($d['AxilarMedia']));
        $medidas->setAbdominal(($d['abdominal']));
        $medidas->setSupraIliaca(($d['supraIliaca']));
        $medidas->setSubEscapular(($d['subEscapular']));
        $medidas->setTricipital(($d['tricipital']));
        $medidas->setCoxa(($d['coxa']));
    
        $medidasdao->update($medidas);
    
        header("Location: ../medidas-editar.php");
    }

    else if (isset($_GET['del'])){

        $medidas->setIdMedidas($_GET['del']);

        $medidasdao->delete($medidas);

        header("Location: ../avaliacao.php");
    } else {
        header("Location: ../avaliacao.php");
    }
   
?>