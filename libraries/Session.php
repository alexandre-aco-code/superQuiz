<?php

class Session
{
    /**
     * Rediriger l'utilisateur s'il n'est pas connecté
     *
     * @return void
     */

    public static function redirectIfNotConnected()
    {
        if (!self::isConnected()) {
            \Http::redirect(
                WWW_URL . "index.php?controller=user&task=loginForm"
            );
        }
    }

    /**
     * Rediriger l'utilisateur s'il n'est pas admin
     *
     * @return void
     */

    public static function redirectIfNotAdmin()
    {
        //déjà s'il est pas connecté on le redirige
        self::redirectIfNotConnected();

        //s'il est connecté mais pas admin, on le déconnect
        if ($_SESSION['user']['Admin'] != 1) {
            \Http::redirect(WWW_URL . "index.php?controller=user&task=out");
        }
    }

    /**
     * Permet de mettre en place la session pour un utilisateur donné
     *
     * @param array $user
     * @return void
     */
    public static function connect(array $user)
    {
        $_SESSION['user'] = $user;
    }

    /**
     * Permet de supprimer les infos de connexion dans la session
     *
     * @return void
     */
    public static function disconnect()
    {
        $_SESSION['user'] = null;
    }

    /**
     * Permet de savoir si l'utilisateur est connecté ou non
     *
     * @return boolean
     */
    public static function isConnected(): bool
    {
        return !empty($_SESSION['user']);
    }

    /**
     * Permet de savoir si l'utilisateur est Admin
     *
     * @return boolean
     */
    public static function isAdmin(): bool
    {
        if ($_SESSION['user']['Admin'] == 1) {
            return true;
        }

        return false;
    }

    /**
     * renvoie le prénom
     *
     * @return string
     */
    public static function getFirstName(): string
    {
        return htmlspecialchars($_SESSION['user']['Pseudo']);
    }

    /**
     * renvoie l'Avatar de l'utilisateur
     *
     *@return string
     */
    public static function getAvatar(): string
    {
        return htmlspecialchars($_SESSION['user']['Avatar_Id']);
    }

    /**
     * renvoie l'id de l'utilisateur
     *
     *@return int
     */
    public static function getId(): int
    {
        return intval($_SESSION['user']['Id']);
    }

    /**
     * Permet d'ajouter un message Flash
     *
     * @param string $type
     * @param string $message
     * @return void
     */
    public static function addFlash(string $type, string $message)
    {
        if (empty($_SESSION['messages'])) {
            $_SESSION['messages'] = [
                'error' => [],
                'success' => [],
            ];
        }
        $_SESSION['messages'][$type][] = $message;
    }

    /**
     * Permet de récupérer tout en supprimant les messages d'un certain type
     *
     * @param string $type
     * @return array
     */
    public static function getFlashes(string $type): array
    {
        if (empty($_SESSION['messages'])) {
            return [];
        }

        $messages = $_SESSION['messages'][$type];

        $_SESSION['messages'][$type] = [];

        return $messages;
    }

    /**
     * Permet de savoir si il existe des messages d'un certain type
     *
     * @param string $type
     * @return boolean
     */
    public static function hasFlashes(string $type): bool
    {
        if (empty($_SESSION['messages'])) {
            return false;
        }

        return !empty($_SESSION['messages'][$type]);
    }
}
