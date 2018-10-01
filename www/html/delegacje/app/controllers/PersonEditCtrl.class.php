<?php

namespace app\controllers;

use core\App;
use core\Utils;
use core\ParamUtils;
use core\Validator;
use app\forms\PersonEditForm;

class PersonEditCtrl {

    private $form; //dane formularza

    public function __construct() {
        //stworzenie potrzebnych obiektów
        $this->form = new PersonEditForm();
    }

    // Walidacja danych przed zapisem (nowe dane lub edycja).
    public function validateSave() {
        //0. Pobranie parametrów z walidacją
        $this->form->id = ParamUtils::getFromRequest('id', true, 'Błędne wywołanie aplikacji');
        $this->form->name = ParamUtils::getFromRequest('name', true, 'Błędne wywołanie aplikacji');
        $this->form->surname = ParamUtils::getFromRequest('surname', true, 'Błędne wywołanie aplikacji');
        $this->form->birthdate = ParamUtils::getFromRequest('birthdate', true, 'Błędne wywołanie aplikacji');
        $this->form->jobTitle = ParamUtils::getFromRequest('jobTitle', true, 'Błędne wywołanie aplikacji');
        $this->form->jobPlace = ParamUtils::getFromRequest('jobPlace', true, 'Błędne wywołanie aplikacji');
        $this->form->userName = ParamUtils::getFromRequest('userName', true, 'Błędne wywołanie aplikacji');
        $this->form->role = ParamUtils::getFromRequest('role', true, 'Błędne wywołanie aplikacji');
        $this->form->password = ParamUtils::getFromRequest('password', true, 'Błędne wywołanie aplikacji');

        if (App::getMessages()->isError())
            return false;

        // 1. sprawdzenie czy wartości wymagane nie są puste
        if (empty(trim($this->form->name))) {
            Utils::addErrorMessage('Wprowadź imię');
        }
        if (empty(trim($this->form->surname))) {
            Utils::addErrorMessage('Wprowadź nazwisko');
        }
        if (empty(trim($this->form->birthdate))) {
            Utils::addErrorMessage('Wprowadź datę urodzenia');
        }
        if (empty(trim($this->form->jobTitle))) {
            Utils::addErrorMessage('Wprowadź nazwę stanowiska');
        }
        if (empty(trim($this->form->jobPlace))) {
            Utils::addErrorMessage('Wprowadź miejsce');
        }
        if (empty(trim($this->form->userName))) {
            Utils::addErrorMessage('Wprowadź nazwę użytkownika');
        }
        if (empty(trim($this->form->role))) {
            Utils::addErrorMessage('Wprowadź role użytkownika');
        }
        if (empty(trim($this->form->password)) && empty(trim($this->form->id))) {
            Utils::addErrorMessage('Wprowadź hasło');
        }

        if (App::getMessages()->isError())
            return false;

        // 2. sprawdzenie poprawności przekazanych parametrów

        

        $check_birth = $this->form->birthdate;
        $check_name = $this->form->name;
        $check_surname = $this->form->surname;

        $d = checkdate(substr($check_birth, 5, 2), substr($check_birth, 8, 2), substr($check_birth, 0, 4));
        if ($d === false || strlen($check_birth) <> 10) {
            Utils::addErrorMessage('Zły format daty. Przykład: 2018-12-20 lub data nie istnieje');
        }
        

        function my_mb_ucfirst($str) {
            $fc = mb_strtoupper(mb_substr($str, 0, 1));
            return $fc . mb_substr($str, 1);
        }

        $this->form->name = my_mb_ucfirst($check_name);
        $this->form->surname = my_mb_ucfirst($check_surname);

//        $test = App::getDB()->get('person', '*', [
//                                'user_name' => $this->form->userName
//                ]);
//        $testUser = $test['user_name'];
//        var_dump($test);         
//        var_dump($test['user_name'] === $testUser);die;
//        
//        if($test['user_name'] === $testUser)
//        {
//            Utils::addErrorMessage('Podany użytkownik już istnieje');
//        }
        return !App::getMessages()->isError();
    }

    //validacja danych przed wyswietleniem do edycji
    public function validateEdit() {
        //pobierz parametry na potrzeby wyswietlenia danych do edycji
        //z widoku listy osób (parametr jest wymagany)
        $this->form->id = ParamUtils::getFromCleanURL(1, true, 'Błędne wywołanie aplikacji');
        return !App::getMessages()->isError();
    }

    public function action_personNew() {
        $this->generateView();
    }

    //wysiweltenie rekordu do edycji wskazanego parametrem 'id'
    public function action_personEdit() {
        // 1. walidacja id osoby do edycji
        if ($this->validateEdit()) {
            try {
                // 2. odczyt z bazy danych osoby o podanym ID (tylko jednego rekordu)
                $record = App::getDB()->get("person", "*", [
                    "id" => $this->form->id
                ]);
                // 2.1 jeśli osoba istnieje to wpisz dane do obiektu formularza
                $this->form->id = $record['id'];
                $this->form->name = $record['name'];
                $this->form->surname = $record['surname'];
                $this->form->birthdate = $record['birthdate'];
                $this->form->jobTitle = $record['job_title'];
                $this->form->jobPlace = $record['job_place'];
                $this->form->userName = $record['user_name'];
                $this->form->role = $record['role'];
            } catch (\PDOException $e) {
                Utils::addErrorMessage('Wystąpił błąd podczas odczytu rekordu');
                if (App::getConf()->debug)
                    Utils::addErrorMessage($e->getMessage());
            }
        }

        // 3. Wygenerowanie widoku
        $this->generateView();
    }

    public function action_personDelete() {
        // 1. walidacja id osoby do usuniecia
        if ($this->validateEdit()) {

            try {
                // 2. usunięcie rekordu
                App::getDB()->delete("person", [
                    "id" => $this->form->id
                ]);
                Utils::addInfoMessage('Pomyślnie usunięto rekord');
            } catch (\PDOException $e) {
                Utils::addErrorMessage('Wystąpił błąd podczas usuwania rekordu');
                if (App::getConf()->debug)
                    Utils::addErrorMessage($e->getMessage());
            }
        }

        // 3. Przekierowanie na stronę listy osób
        App::getRouter()->forwardTo('personList');
    }

    public function action_personSave() {

        // 1. Walidacja danych formularza (z pobraniem)
        if ($this->validateSave()) {
            // 2. Zapis danych w bazie
            try {

                //2.1 Nowy rekord
                if ($this->form->id == '') {
                    //sprawdź liczebność rekordów - nie pozwalaj przekroczyć 20
                    $count = App::getDB()->count("person");
                    
                        App::getDB()->insert("person", [
                            "name" => $this->form->name,
                            "surname" => $this->form->surname,
                            "birthdate" => $this->form->birthdate,
                            "job_title" => $this->form->jobTitle,
                            "job_place" => $this->form->jobPlace,
                            "user_name" => $this->form->userName,
                            "role" => $this->form->role,
                            "password" => md5($this->form->password)
                        ]);
                } else {
                    $user = App::getDB()->get("person", "*", [
                        "id" => $this->form->id
                    ]);
                    
                    if (empty(trim($this->form->password))) {
                        $password = $user['password'];
                    } else {
                        $password = md5($this->form->password);
                    }
                    
                    //2.2 Edycja rekordu o danym ID
                    App::getDB()->update("person", [
                        "name" => $this->form->name,
                        "surname" => $this->form->surname,
                        "birthdate" => $this->form->birthdate,
                        "job_title" => $this->form->jobTitle,
                        "job_place" => $this->form->jobPlace,
                        "user_name" => $this->form->userName,
                        "role" => $this->form->role,
                        "password" => $password
                            ], [
                        "id" => $this->form->id
                    ]);
                }
                Utils::addInfoMessage('Pomyślnie zapisano rekord');
            } catch (\PDOException $e) {
                Utils::addErrorMessage('Wystąpił nieoczekiwany błąd podczas zapisu rekordu');
                if (App::getConf()->debug)
                    Utils::addErrorMessage($e->getMessage());
            }

            // 3b. Po zapisie przejdź na stronę listy osób (w ramach tego samego żądania http)
            App::getRouter()->forwardTo('personList');
        } else {
            // 3c. Gdy błąd walidacji to pozostań na stronie
            $this->generateView();
        }
    }

    public function generateView() {
        App::getSmarty()->assign('form', $this->form); // dane formularza dla widoku
        App::getSmarty()->display('PersonEdit.tpl');
    }

}
