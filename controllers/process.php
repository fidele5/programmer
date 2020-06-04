<?php
require_once '../models/autoload.php';
class Process
{
    private $modelCours;
    private $modelVotes;
    private $modelCotes;
    private $modelUtilisateur;
    private $modelPromotion;
    private $modelDomaine;
    private $categorieModel;
    private $datas;
    private $idUser;
    private $suggered;

    public function __construct(array $datas, array $suggered, int $idUser)
    {
        $this->modelCours = new Cours();
        $this->modelCotes = new Cotes();
        $this->modelVotes = new Votes();
        $this->modelUtilisateur = new Utilisateurs();
        $this->modelPromotion = new Promotions();
        $this->modelDomaine = new Domaines();
        $this->categorieModel = new Categories();
        $this->idUser = $idUser;
        $this->datas = $datas;
        $this->suggered = $suggered;
    }

    private function getNotSelected()
    {
        $idFiliere = $this->modelUtilisateur->select_by_id($this->idUser);
        $all_courses = $this->modelCours->select_by_id_filiere($idFiliere[0]["domaine_id"]);
        $notSelected = array(
            "prepa" => array(),
            "G1" => array(),
            "G2" => array(),
            "G3" => array(),
        );
        foreach ($all_courses as $key => $cours) {
            if (!(in_array($cours["id"], $this->datas["prepa"]) ||
                in_array($cours["id"], $this->datas["G1"]) ||
                in_array($cours["id"], $this->datas["G2"]) ||
                in_array($cours["id"], $this->datas["G3"]))) {
                $id_promotion = $cours["promotions_id"];
                $promotion = $this->modelPromotion->select_by_id($id_promotion);
                $nom = $promotion[0]["designation"];
                if (preg_match("/prepa/", $nom)) {
                    $notSelected["prepa"][] = $cours["id"];
                } else if (preg_match("/G1/", $nom)) {
                    $notSelected["G1"][] = $cours["id"];
                } else if (preg_match("/G2/", $nom)) {
                    $notSelected["G2"][] = $cours["id"];
                } else if (preg_match("/G3/", $nom)) {
                    $notSelected["G3"][] = $cours["id"];
                }

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
            "G3" => array(),
        );

        if (!$this->user_student()) {
            foreach ($this->datas as $key => $values) {
                $poids_cotes[$key][] = 5;
            }
        }
        foreach ($this->datas as $key => $values) {
            foreach ($values as $cours) {
                $cotes = $this->modelCotes->select_by_user_and_course($this->idUser, $cours);
                $cote = $cotes[0];
                $total = $cote["moyenne"] + $cote['examen'];
                if ($total < 5) {
                    $poids_cotes[$key][] = 5;
                } else if (($total >= 5) && ($total < 10)) {
                    $poids_cotes[$key][] = 4;
                } else if (($total >= 10) && ($total < 14)) {
                    $poids_cotes[$key][] = 3;
                } else if (($total >= 14) && ($total < 16)) {
                    $poids_cotes[$key][] = 2;
                } else {
                    $poids_cotes[$key][] = 1;
                }

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
            "G3" => array(),
        );
        if (!$this->user_student()) {
            foreach ($notSelected as $key => $values) {
                $poids_cotes[$key][] = 1;
            }
        }
        foreach ($notSelected as $key => $values) {
            foreach ($values as $cours) {
                $cotes = $this->modelCotes->select_by_user_and_course($this->idUser, $cours);
                $cote = $cotes[0];
                $total = $cote["moyenne"] + $cote['examen'];
                if ($total < 5) {
                    $poids_cotes[$key][] = 1;
                } else if (($total >= 5) && ($total < 10)) {
                    $poids_cotes[$key][] = 2;
                } else if (($total >= 10) && ($total < 14)) {
                    $poids_cotes[$key][] = 3;
                } else if (($total >= 14) && ($total < 16)) {
                    $poids_cotes[$key][] = 4;
                } else {
                    $poids_cotes[$key][] = 5;
                }

            }
        }
        print_r($poids_cotes);
        return $poids_cotes;
    }

    public function pondererSuggered()
    {
        $poids_cotes = array(
            "prepa" => array(),
            "G1" => array(),
            "G2" => array(),
            "G3" => array(),
        );
        foreach ($this->suggered as $key => $values) {
            foreach ($values as $cours) {
                $poids_cotes[$key][] = 5;
            }
        }
        return $poids_cotes;
    }

    private function save()
    {
        $notSelected = $this->getNotSelected();
        $dataPonderedSelected = $this->pondererSelected();
        $dataPonderedNotSelected = $this->pondererNotSelected($notSelected);
        $dataPonderedSuggered = $this->pondererSuggered();

        $this->modelVotes->update_votes($this->idUser);

        foreach ($this->datas as $key => $value) {
            foreach ($value as $key2 => $valeur) {
                extract($valeur);
                $filiere = 0;
                if (($key == "prepa") || ($key == "G1")) {
                    $filiere = $this->modelDomaine->select_by_name("Generale")[0]["id"];
                } else {
                    $filiere = $this->modelUtilisateur->select_by_id($this->idUser)[0]["domaine_id"];
                }

                $promotion = $this->modelPromotion->select_id_by_name_domain($key, $filiere);
                $id_promotion = $promotion[0]["id"];
                $this->modelVotes->insert($this->idUser, $id, $id_promotion, $dataPonderedSelected[$key][$key2], true);
            }
        }

        foreach ($notSelected as $key => $value) {
            foreach ($value as $key2 => $id_cours) {
                $filiere = 0;
                if (($key == "prepa") || ($key == "G1")) {
                    $filiere = $this->modelDomaine->select_by_name("Generale")[0]["id"];
                } else {
                    $filiere = $this->modelUtilisateur->select_by_id($this->idUser)[0]["domaine_id"];
                }

                $promotion = $this->modelPromotion->select_id_by_name_domain($key, $filiere);
                $id_promotion = $promotion[0]["id"];
                $this->modelVotes->insert($this->idUser, $id_cours, $id_promotion, $dataPonderedNotSelected[$key][$key2], false);
            }
        }

        foreach ($dataPonderedSuggered as $key => $value) {
            foreach ($value as $key2 => $id_cours) {
                $filiere = 0;
                if (($key == "prepa") || ($key == "G1")) {
                    $filiere = $this->modelDomaine->select_by_name("Generale")[0]["id"];
                } else {
                    $filiere = $this->modelUtilisateur->select_by_id($this->idUser)[0]["domaine_id"];
                }

                $promotion = $this->modelPromotion->select_id_by_name_domain($key, $filiere);
                $id_promotion = $promotion[0]["id"];
                $this->modelVotes->insert($this->idUser, $id_cours, $id_promotion, $dataPonderedNotSelected[$key][$key2], true);
            }
        }
    }

    private function user_student()
    {
        $user = $this->modelUtilisateur->select_by_id($this->idUser);
        return ($user[0]["categorie_id"] == $this->categorieModel->select_id_by_name("etudiant"));
    }

    public function process()
    {
        $this->save();
    }
}