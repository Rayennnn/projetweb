<?php

class Reponse
{
    private ?int $id = null; 
    private int $id_user;    
    private string $date;   
    private int $id_question; 
    private int $choix_rp;   

    
    public function __construct(int $id_user, string $date, int $id_question, int $choix_rp)
    {
        $this->setid_user($id_user);
        $this->setdate($date);
        $this->setid_question($id_question);
        $this->setchoix_rp($choix_rp);
    }

    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdUser(): int
    {
        return $this->id_user;
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function getIdQuestion(): int
    {
        return $this->id_question;
    }

    public function getChoixRp(): int
    {
        return $this->choix_rp;
    }

   
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setIdUser(int $id_user): void
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

    public function setIdQuestion(int $id_question): void
    {
        $this->id_question = $id_question;
    }

    public function setChoixRp(int $choix_rp): void
    {
        $this->choix_rp = $choix_rp;
    }
}

?>
