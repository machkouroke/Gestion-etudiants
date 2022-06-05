<?php

    namespace controller;

    use Closure;
    use Exception\DataBaseException;
    use Exception\UserException;
    use model\Authentification;
    use model\LOPStudents\Factory;

    /**
     * @author Machkour Oke
     * Contient les fonctionnalités requises à l'authentification de l'utilisateur
     */
    class AuthenticationController
    {
        /**
         * @param Closure $action Action à autoriser uniquement à l'utilisateur connecté
         */
        public static function loginRequired(Closure $action): Closure|null
        {
            if (isset($_SESSION['User'])) {
                return $action;
            } else {
                header(INDEX_LOCATION);
                return null;
            }
        }

        public static function roleRequired(Closure $action, bool $role): void
        {
            if ($role) {
                $action();
            } else {
                header(INDEX_LOCATION);
            }
        }

        public static function loginPage(): void
        {
            require_once(BASE_DIR . 'view\login.php');
        }

        public static function login(): void
        {

            try {

                $_SESSION['User'] = Authentification::authenticate($_POST['username'], $_POST['password']);
                header(INDEX_LOCATION);
            } catch (DataBaseException|UserException $e) {

                $query = ['error' => $e->getMessage()];
                header(INDEX_LOCATION . '?' .  http_build_query($query));

            }


        }

        public static function logout(): void
        {
            unset($_SESSION['User']);
            session_destroy();
            header(INDEX_LOCATION);
        }
    }
