<?php

namespace app\controllers;

use core\App;
use core\ParamUtils;

class DelegationAjaxCtrl {

    
    public function action_delegationAjax() {
        //check if ajax request, if not, return 404
        if(empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
            http_response_code(404);
            echo 'Page not found';
            die;
        }
        
        $userId = (int) ParamUtils::getFromGet('user');
        
        if ($userId < 1) {
            http_response_code(500);
            echo 'Wrong user id';
            die;
        }
        
        $data = App::getDB()->select(
            'delegation',
            [
                '[>]car' => ['car_id' => 'id'],
                '[>]person' => ['person_id' => 'id'],
                '[>]city(cityFrom)' => ['city_from' => 'id'],
                '[>]city(cityTo)' => ['city_to' => 'id'],
            ],
            [
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
            ],
            ['person.id' => $userId]
        );
        
        header('Content-Type: application/json');
        echo json_encode($data);
    }

}
