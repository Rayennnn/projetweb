<?php

class reponse
{
    private $id=NULL;
    private $id_user=NULL;
    private $id_question=NULL ;   
    private $date=NULL;
    private $choix_rp=NULL; 


    
    public function __construct(string $id_user, string $date, int $id_question, string $choix_rp)
    {
        $this->setid_user($id_user);
        $this->setdate($date);
        $this->setid_question(id_question:$id_question);
        $this->setchoix_rp(choix_rp:$choix_rp);
       
    }

    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getId_User(): string
    {
        return $this->id_user;
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function getId_Question(): int
    {
        return $this->id_question;
    }

    public function getChoix_Rp(): string
    {
        return $this->choix_rp;
    }

   
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setId_User(string $id_user): void
    {
        $this->id_user = $id_user;
    }

    public function setDate(string $date): void
    {
        // Vérification du format de la date (exemple: YYYY-MM-DD)
        if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)) {
            throw new InvalidArgumentException("La date doit être au format YYYY-MM-DD.");
        }
        $this->date = $date;
    }

    public function setId_Question(int $id_question): void
    {
        $this->id_question = $id_question;
    }

    public function setChoix_Rp(string $choix_rp): void
    {
        $this->choix_rp = $choix_rp;
    }
}

?>
