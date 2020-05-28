<?php

session_start();
require_once 'models/autoload.php';

class Process {
    private $modelCours;
    private $modelVotes;
    private $modelCotes;
    private $modelUtilisateur;
    private $datas;
    private $idUser;

    public function __construct() {
        $this->modelCours = new Cours();
        $this->datas = array(
            "prepa" => array(5),
            "G1"=> array(),
            "G2" => array(4),
            "G3" => array(3)
        );
        $this->idUser = 1;
    }

    private function getNotSelected() {
        $all_courses = $this->modelCours->select();
        $notSelected = array(
            "prepa" => array(),
            "G1"=> array(),
            "G2" => array(),
            "G3" => array()
        );
        foreach($all_courses as $cours)
        {
            if(!(in_array($cours['id'], $this->datas["prepa"]) || in_array($cours['id'], $this->datas["G1"]) || in_array($cours['id'], $this->datas["G2"]) || in_array($cours['id'], $this->datas["G3"]))) {
                printf("true %d", $cours['id']);
                if($cours["promotions_id"] == 1) $notSelected["prepa"][] = $cours["id"];
                else if($cours["promotions_id"] == 2) $notSelected["G1"][] = $cours["id"];
                else if($cours["promotions_id"] % 2 == 0) $notSelected["G2"][] = $cours["id"];
                else if($cours["promotions_id"] %2 != 0) $notSelected["G3"][] = $cours["id"];
            }
        }
        return $notSelected;
    }

    private function pondererSelected()
    {
        $poids_cotes = array(
            "prepa" => array(),
            "G1" => array(),
            "G2" => array(),
            "G3" => array()
        );
        foreach($this->datas as $key => $values)
        {
            foreach($values as $cours){
                $cote = $this->modelCotes->select_by_user_and_course($this->idUtilisateur, $cours);
                $total = $cote["moyenne"] + $cote['examen'];
                if($total < 5) $poids_cotes[$key][] = 5;
                else if(($total >= 5) && ($total < 10)) $poids_cotes[$key][] = 4;
                else if(($total >= 10) && ($total < 14)) $poids_cotes[$key][] = 3;
                else if(($total >= 14) && ($total < 16)) $poids_cotes[$key][] = 2;
                else $poids_cotes[$key][] = 1;
            }
        }
        return $poids_cotes;
    }

    private function pondererNotSelected(array $notSelected)
    {
        $poids_cotes = array(
            "prepa" => array(),
            "G1" => array(),
            "G2" => array(),
            "G3" => array()
        );
        foreach($notSelected as $key => $values)
        {
            foreach($values as $cours){
                $cote = $this->modelCotes->select_by_user_and_course($this->idUtilisateur, $cours);
                $total = $cote["moyenne"] + $cote['examen'];
                if($total < 5) $poids_cotes[$key][] = 5;
                else if(($total >= 5) && ($total < 10)) $poids_cotes[$key][] = 4;
                else if(($total >= 10) && ($total < 14)) $poids_cotes[$key][] = 3;
                else if(($total >= 14) && ($total < 16)) $poids_cotes[$key][] = 2;
                else $poids_cotes[$key][] = 1;
            }
        }
        return $poids_cotes;
    }

    private function save()
    {
        $notSelected = $this->getNotSelected();
        $dataPonderedSelected = $this->pondererSelected();
        $dataPonderedNotSelected = $this->pondererNotSelected($notSelected);
        
        foreach($this->datas as $key => $value)
        {
            foreach($value as $key2 => $value2)
            {
                $filiere = 0;
                if(($key == "Prepa")||($key == "G1")) $filiere = "Generale";
                else $filiere = $this->modelUtilisateur->select_by_id($this->idUser)[0]["domaine_id"];
                $id_cours = $this->modelCours->select_id_by_name_domain($key, $filiere);
                $this->modelVotes->insert($this->idUser, $value2, $id_cours, $dataPonderedSelected[$key][$key2], true);
            }
        }

        foreach($notSelected as $key => $value)
        {
            foreach($value as $key2 => $value2)
            {
                $filiere = 0;
                if(($key == "Prepa")||($key == "G1")) $filiere = "Generale";
                else $filiere = $this->modelUtilisateur->select_by_id($this->idUser)[0]["domaine_id"];
                $id_cours = $this->modelCours->select_id_by_name_domain($key, $filiere);
                $this->modelVotes->insert($this->idUser, $value2, $id_cours, $dataPonderedNotSelected[$key][$key2], false);
            }
        }
    }

    public function process()
    {
        $this->save();
    }
}

$p = new Process();
print_r($p->getNotSelected());

