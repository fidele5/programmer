<?php 

include_once "../models/autoload.php";

class Compiler
{
    private $modelCours;
    private $modelPromotion;
    private $modelDomaine;
    private $modelUtilisateur;
    private $modelVotes;
    private $idFiliere;
    private $promotion_votes;
    private $resultats_cours;
    private $programme_final;

    public function __construct(int $idFiliere)
    {
        $this->modelCours = new Cours();
        $this->modelDomaine = new Domaines();
        $this->modelPromotion = new Promotions();
        $this->modelUtilisateur = new Utilisateurs();
        $this->modelVotes = new Votes();
        $this->cours = $this->modelCours->select();
        $this->promotions = $this->modelPromotion->select();
        $this->domaines = $this->modelDomaine->select();
        $this->utilisateurs = $this->modelUtilisateur->select();
        $this->votes = $this->modelVotes->select();
        $this->idFiliere = $idFiliere;
    }

    private function groupPoints()
    {
        //Cette methode permet de generer un programme de la filiere en fonction des votes qui concernent la filiere
        $votes_fil = $this->modelVotes->votes_filiere($this->idFiliere);

        $promotions_id = $this->modelPromotion->select_id_for_filieres($this->idFiliere);

        $votes_promotion = array(
            "Prepa" => array(),
            "G1" => array(),
            "G2" => array(),
            "G3" => array()
        );

        foreach($promotions_id as $promotion_id)
        {
            $promotion_id = $promotion_id["id"];
            $designation = $this->modelPromotion->select_by_id($promotion_id)[0]['designation'];
            $key = "";
            if(preg_match("/Prepa/", $designation)) $key = "Prepa";
            else if(preg_match("/G1/", $designation)) $key = "G1";
            else if(preg_match("/G2/", $designation)) $key = "G2";
            else if(preg_match("/G3/", $designation)) $key = "G3";
            foreach($votes_fil as $vote)
            {
                if($vote["promotion_id"] == $promotion_id)
                {
                    $votes_promotion[$key][] = $vote;
                }
            }
        }

        $this->promotion_votes = $votes_promotion;
    }

    private function compilationPoints()
    {
        $coursPonderes = array(
            "Prepa" => array(),
            "G1" => array(),
            "G2" => array(),
            "G3" => array()
        );
        foreach($this->promotion_votes as $key => $promotion)
        {
            for($i = 0; $i < count($promotion); $i++)
            {
                $cours = null;
                $somme = 0;
                if(!array_key_exists($promotion[$i]["cours_id"], $coursPonderes[$key])){
                    $cours = $promotion[$i]["cours_id"];
                    $points = $promotion[$i]["ponderation"];
                    $somme += $points;
                }
                else continue;

                for($j = $i+1; $j < count($promotion); $j++)
                {
                    if($promotion[$j]["cours_id"] == $cours) {
                        $points = $promotion[$j]["ponderation"];
                        $somme =  $somme + $points;
                    }
                }
                $coursPonderes[$key][$cours] = $somme;
            }
        }
        $this->resultats_cours = $coursPonderes;
    }

    private function minumumAvailable($max=5, $min=1)
    {
        $nombre = $this->modelVotes->nombre_participant($this->idFiliere);
        print("Nombre de participants : $nombre \n");
        return ($max+$min)*$nombre / 2;
    }

    public function compile()
    {
        $mean = $this->minumumAvailable();
        $this->groupPoints();
        $this->compilationPoints();
        $points = $this->resultats_cours;
        $programme = array(
            "Prepa" => array(),
            "G1" => array(),
            'G2' => array(),
            "G3" => array()
        );
        foreach($points as $promotion => $all_cours)
        {
            foreach($all_cours as $id_cours => $ponderation)
            {
                if($ponderation >= $mean) $programme[$promotion][] = $id_cours;
            }
        }
        $this->programme_final = $programme;
    }

    public function getProgrammeFinal()
    {
        return $this->programme_final;
    }
}

$c = new Compiler(1);
$c -> compile();
$prog = $c->getProgrammeFinal();
print_r($prog);