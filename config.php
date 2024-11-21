<?php
class Config
{
    private static ?PDO $pdo = null;

    public static function getConnexion()
    {
        // Si la connexion n'existe pas, créez-la
        if (!isset(self::$pdo)) {
            try {
                self::$pdo = new PDO(
                    'mysql:host=localhost;dbname=baseprojet', // Remplacez 'projet_web' par le nom de votre base de données
                    'root', // Remplacez 'root' par votre nom d'utilisateur MySQL si nécessaire
                    '', // Mot de passe (mettez votre mot de passe ici si vous en avez un)
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Active les exceptions pour les erreurs
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC // Retourne les résultats sous forme de tableau associatif
                    ]
                );
            } catch (Exception $e) {
                die('Erreur : ' . $e->getMessage());
            }
        }

        // Retourne l'instance PDO
        return self::$pdo;
    }
}
?>