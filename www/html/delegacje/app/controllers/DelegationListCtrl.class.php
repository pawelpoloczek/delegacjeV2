<?php

namespace app\controllers;

use core\App;
use core\Utils;
use core\ParamUtils;
use app\forms\DelegationSearchForm;

class DelegationListCtrl {

    private $form; //dane formularza wyszukiwania
    private $records; //rekordy pobrane z bazy danych

    public function __construct() {
        //stworzenie potrzebnych obiektów
        $this->form = new DelegationSearchForm();
    }

    public function validate() {
        // 1. sprawdzenie, czy parametry zostały przekazane
        // - nie trzeba sprawdzać
        $this->form->personUserName = ParamUtils::getFromRequest('personUserName');

        // 2. sprawdzenie poprawności przekazanych parametrów
        // - nie trzeba sprawdzać

        return !App::getMessages()->isError();
    }

    public function action_delegationList() {
        // 1. Walidacja danych formularza (z pobraniem)
        // - W tej aplikacji walidacja nie jest potrzebna, ponieważ nie wystąpią błedy podczas podawania nazwiska.
        //   Jednak pozostawiono ją, ponieważ gdyby uzytkownik wprowadzał np. datę, lub wartość numeryczną, to trzeba
        //   odpowiednio zareagować wyświetlając odpowiednią informację (poprzez obiekt wiadomości Messages)
        $this->validate();

        // 2. Przygotowanie mapy z parametrami wyszukiwania (nazwa_kolumny => wartość)
        $search_params = []; //przygotowanie pustej struktury (aby była dostępna nawet gdy nie będzie zawierała wierszy)
        if (isset($this->form->personUserName) && strlen($this->form->personUserName) > 0) {
            $search_params['person.user_name[~]'] = $this->form->personUserName . '%'; // dodanie symbolu % zastępuje dowolny ciąg znaków na końcu
        }

        // 3. Pobranie listy rekordów z bazy danych
        // W tym wypadku zawsze wyświetlamy listę osób bez względu na to, czy dane wprowadzone w formularzu wyszukiwania są poprawne.
        // Dlatego pobranie nie jest uwarunkowane poprawnością walidacji (jak miało to miejsce w kalkulatorze)
        //przygotowanie frazy where na wypadek większej liczby parametrów
        $num_params = sizeof($search_params);
        if ($num_params > 1) {
            $where = ["AND" => &$search_params];
        } else {
            $where = &$search_params;
        }
        
        if(\core\RoleUtils::inRole('user'))
        {
            $where = ['person.id' => App::getConf()->user['id']];
        } 
        
        /*
        $roles = App::getConf()->roles;
        if (false == isset($roles['admin']) || $roles['admin'] != true) {
            $where = ["AND" => 'person.user_name'];
        }
        */
        //dodanie frazy sortującej po nazwisku
        $where ["ORDER"] = "id";
        //wykonanie zapytania
            
        try {
            
            $this->records = App::getDB()->select(
                    'delegation', [
                '[>]car' => ['car_id' => 'id'],
                '[>]person' => ['person_id' => 'id'],
                '[>]city(cityFrom)' => ['city_from' => 'id'],
                '[>]city(cityTo)' => ['city_to' => 'id'],
                    ], [
                'delegation.id',
                'delegation.distance',
                'delegation.start_time',
                'delegation.end_time',
                'delegation.city_from',
                'delegation.city_to',
                'car.brand',
                'car.model',
                'car.registration_number',
                'cityFrom.name (cityFrom)',
                'cityTo.name (cityTo)',
                'person.name',
                'person.surname',
                'person.user_name'
                    ], $where
            );
            
        } catch (\PDOException $e) {
            Utils::addErrorMessage('Wystąpił błąd podczas pobierania rekordów');
            if (App::getConf()->debug)
                Utils::addErrorMessage($e->getMessage());
        }

        // 4. wygeneruj widok
        App::getSmarty()->assign('searchForm', $this->form); // dane formularza (wyszukiwania w tym wypadku)
        App::getSmarty()->assign('delegation', $this->records);  // lista rekordów z bazy danych
        App::getSmarty()->display('DelegationList.tpl');
    }

}
