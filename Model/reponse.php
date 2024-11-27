<?php

class reponse
{
    private $id_reponse=NULL;
    private $id_user=NULL;
    private $id_question=NULL ;   
    private $date=NULL;
    private $choix_rp=NULL; 


    
    public function __construct(string $id_user, string $date, int $id_question, string $choix_rp)
    {
        $this->setid_user($id_user);
        $this->setdate($date);
        $this->setid_question($id_question);
        $this->setchoix_rp($choix_rp);
       
    }

    
    public function getId_reponse(): int
    {
        return $this->id_reponse;
    }

    public function getId_user(): string
    {
        return $this->id_user;
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function getId_question(): int
    {
        return $this->id_question;
    }

    public function getChoix_rp(): string
    {
        return $this->choix_rp;
    }

   
    public function setid_reponse(int $id_reponse): void
    {
        $this->id_reponse= $id_reponse;
    }

    public function setid_user(string $id_user): void
    {
        $this->id_user = $id_user;
    }

    public function setdate(string $date): void
    {
       
        $this->date = $date;
    }

    public function setid_question(int $id_question): void
    {
        $this->id_question = $id_question;
    }

    public function setchoix_rp(string $choix_rp): void
    {
        $this->choix_rp = $choix_rp;
    }
}

?>
