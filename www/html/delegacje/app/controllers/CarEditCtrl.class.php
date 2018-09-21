<?php

namespace app\controllers;

use core\App;
use core\Utils;
use core\ParamUtils;
use core\Validator;
use app\forms\CarEditForm;

class CarEditCtrl {

    private $form; //dane formularza

    public function __construct() {
        //stworzenie potrzebnych obiektów
        $this->form = new CarEditForm();
    }

    // Walidacja danych przed zapisem (nowe dane lub edycja).
    public function validateSave() {
        //0. Pobranie parametrów z walidacją
        $this->form->id = ParamUtils::getFromRequest('id', true, 'Błędne wywołanie aplikacji');
        $this->form->brand = ParamUtils::getFromRequest('brand', true, 'Błędne wywołanie aplikacji');
        $this->form->model = ParamUtils::getFromRequest('model', true, 'Błędne wywołanie aplikacji');
        $this->form->registrationNumber = ParamUtils::getFromRequest('registrationNumber', true, 'Błędne wywołanie aplikacji');
        $this->form->cubicCapacity = ParamUtils::getFromRequest('cubicCapacity', true, 'Błędne wywołanie aplikacji');
        $this->form->productionYear = ParamUtils::getFromRequest('productionYear', true, 'Błędne wywołanie aplikacji');

        if (App::getMessages()->isError())
            return false;

        // 1. sprawdzenie czy wartości wymagane nie są puste
        if (empty(trim($this->form->brand))) {
            Utils::addErrorMessage('Wprowadź markę');
        }
        if (empty(trim($this->form->model))) {
            Utils::addErrorMessage('Wprowadź model');
        }
        if (empty(trim($this->form->registrationNumber))) {
            Utils::addErrorMessage('Wprowadź numer rejestracyjny');
        }
        if (empty(trim($this->form->cubicCapacity))) {
            Utils::addErrorMessage('Wprowadź pojemność skokową pojazdu');
        }
        if (empty(trim($this->form->productionYear))) {
            Utils::addErrorMessage('Wprowadź rok produkcji');
        }

        if (App::getMessages()->isError())
            return false;

        // 2. sprawdzenie poprawności przekazanych parametrów

        function my_mb_ucfirst($str) {
            $fc = mb_strtoupper(mb_substr($str, 0, 1));
            return $fc . mb_substr($str, 1);
        }

        $check_brand = $this->form->brand;
        $check_registrationNumber = $this->form->registrationNumber;
        $check_cubicCapacity = $this->form->cubicCapacity;
        $check_productionYear = $this->form->productionYear;

        $this->form->brand = my_mb_ucfirst($check_brand);

        if (strlen($check_registrationNumber) <> 6) {
            Utils::addErrorMessage('Podano błędy numer rejestracyjny');
        }

        if (is_numeric($check_productionYear) === false || strlen($check_productionYear) <> 4 || date("Y") < $check_productionYear) {
            Utils::addErrorMessage('Podano błędy rok produkcji');
        }

        if (is_numeric($check_cubicCapacity) === false) {
            Utils::addErrorMessage('Błędna wartość pojemności');
        }


        return !App::getMessages()->isError();
    }

    //validacja danych przed wyswietleniem do edycji
    public function validateEdit() {
        //pobierz parametry na potrzeby wyswietlenia danych do edycji
        //z widoku listy osób (parametr jest wymagany)
        $this->form->id = ParamUtils::getFromCleanURL(1, true, 'Błędne wywołanie aplikacji');
        return !App::getMessages()->isError();
    }

    public function action_carNew() {
        $this->generateView();
    }

    //wysiweltenie rekordu do edycji wskazanego parametrem 'id'
    public function action_carEdit() {
        // 1. walidacja id osoby do edycji
        if ($this->validateEdit()) {
            try {
                // 2. odczyt z bazy danych osoby o podanym ID (tylko jednego rekordu)
                $record = App::getDB()->get("car", "*", [
                    "id" => $this->form->id
                ]);
                // 2.1 jeśli osoba istnieje to wpisz dane do obiektu formularza
                $this->form->id = $record['id'];
                $this->form->brand = $record['brand'];
                $this->form->model = $record['model'];
                $this->form->registrationNumber = $record['registration_number'];
                $this->form->cubicCapacity = $record['cubic_capacity'];
                $this->form->productionYear = $record['production_year'];
            } catch (\PDOException $e) {
                Utils::addErrorMessage('Wystąpił błąd podczas odczytu rekordu');
                if (App::getConf()->debug)
                    Utils::addErrorMessage($e->getMessage());
            }
        }

        // 3. Wygenerowanie widoku
        $this->generateView();
    }

    public function action_carDelete() {
        // 1. walidacja id osoby do usuniecia
        if ($this->validateEdit()) {

            try {
                // 2. usunięcie rekordu
                App::getDB()->delete("car", [
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
        App::getRouter()->forwardTo('carList');
    }

    public function action_carSave() {

        // 1. Walidacja danych formularza (z pobraniem)
        if ($this->validateSave()) {
            // 2. Zapis danych w bazie
            try {

                //2.1 Nowy rekord
                if ($this->form->id == '') {
                    App::getDB()->insert("car", [
                        "brand" => $this->form->brand,
                        "model" => $this->form->model,
                        "registration_number" => $this->form->registrationNumber,
                        "cubic_capacity" => $this->form->cubicCapacity,
                        "production_year" => $this->form->productionYear
                    ]);
                } else {
                    //2.2 Edycja rekordu o danym ID
                    App::getDB()->update("car", [
                        "brand" => $this->form->brand,
                        "model" => $this->form->model,
                        "registration_number" => $this->form->registrationNumber,
                        "cubic_capacity" => $this->form->cubicCapacity,
                        "production_year" => $this->form->productionYear
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
            App::getRouter()->forwardTo('carList');
        } else {
            // 3c. Gdy błąd walidacji to pozostań na stronie
            $this->generateView();
        }
    }

    public function generateView() {
        App::getSmarty()->assign('form', $this->form); // dane formularza dla widoku
        App::getSmarty()->display('CarEdit.tpl');
    }

}
