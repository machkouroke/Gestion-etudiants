<?php

    namespace controller;

    use Exception\DataBaseException;
    use Exception\UserException;
    use model\LOPStudents\Student;
    use model\FormValidator;

    /**
     * @author Machkour Oke
     * Contient les fonctions propres aux étudiants
     */
    class StudentController
    {


        public static function addStudent(): void
        {
            try {
                $studentToAdd = new Student(...FormValidator::validateStudentAdd());
                $studentToAdd->add();
                header(INDEX_LOCATION . '?action=addStudentPage&sucess=' . 'Utilisateur ajoute');
            } catch (DataBaseException|UserException $e) {
                header(INDEX_LOCATION . '?action=addStudentPage&error=' . $e->getMessage());
            }

        }

        public static function delete(): void
        {
            Student::getByLogin($_GET['login'])->delete();
            header(INDEX_LOCATION . '?action=listingStudents&page=1&sucess=' . 'Utilisateur supprime');
        }

        public static function getByCity(): void
        {
            MenuController::listingStudents(Filter::CITY, $_POST['city']);

        }

        public static function getByFaculty(): void
        {
            MenuController::listingStudents(Filter::FACULTY, $_POST['faculty']);

        }

        public static function getByYear(): void
        {
            MenuController::listingStudents(Filter::YEAR, $_POST['year']);

        }

        public static function updateStudentPage(): void
        {


            MenuController::addStudent(Student::getByLogin($_GET['login']), 'updateStudent&login=' . $_GET['login']);
        }

        public static function updateStudent(): void
        {

            try {
                $studentToUpdate = Student::getByLogin(...FormValidator::validateStudentAdd());
                $studentToUpdate->update(...$_POST);
                header(INDEX_LOCATION . '?action=addStudentPage&sucess=' . 'Utilisateur modifié');
            } catch (DataBaseException|UserException  $e) {
                header(INDEX_LOCATION . '?action=addStudentPage&error=' . $e->getMessage());
            }
        }
    }

