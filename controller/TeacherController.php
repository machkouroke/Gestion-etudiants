<?php

    namespace controller;

    use controller\AuthenticationController;
    use Exception\DataBaseException;
    use Exception\UserException;
    use model\LOPStudents\Module;
    use model\LOPStudents\Student;
    use model\LOPStudents\Teacher;
    use model\FormValidator;


    /**
     * @author Machkour Oke
     * Contient les fonctions propres aux Proffesseur
     */
    class TeacherController
    {


        public static function addTeacher(): void
        {
            try {


                $teacherToAdd = new Teacher(...FormValidator::validateTeacherAdd());
                echo $teacherToAdd->getMatricule();
                $teacherToAdd->add();

                header(INDEX_LOCATION . '?action=addTeacherPage&sucess=' . 'Utilisateur ajoute');
            } catch (DataBaseException|UserException $e) {
                header(INDEX_LOCATION . '?action=addTeacherPage&error=' . $e->getMessage());
            }

        }
    }
