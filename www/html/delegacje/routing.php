<?php

use core\App;
use core\Utils;

App::getRouter()->setDefaultRoute('delegationList'); // akcja/ścieżka domyślna
App::getRouter()->setLoginRoute('login'); // akcja/ścieżka na potrzeby logowania (przekierowanie, gdy nie ma dostępu)
//login
Utils::addRoute('login', 'LoginCtrl');
Utils::addRoute('logout', 'LoginCtrl', ['user', 'admin']);
Utils::addRoute('loginShow', 'LoginCtrl');

//person
Utils::addRoute('personList', 'PersonListCtrl', ['admin'], 'delegationList');
Utils::addRoute('personNew', 'PersonEditCtrl', ['admin'], 'delegationList');
Utils::addRoute('personEdit', 'PersonEditCtrl', ['admin'], 'delegationList');
Utils::addRoute('personSave', 'PersonEditCtrl', ['admin'], 'delegationList');
Utils::addRoute('personDelete', 'PersonEditCtrl', ['admin'], 'delegationList');

//cars
Utils::addRoute('carList', 'CarListCtrl', ['admin'], 'delegationList');
Utils::addRoute('carNew', 'CarEditCtrl', ['admin'], 'delegationList');
Utils::addRoute('carEdit', 'CarEditCtrl', ['admin'], 'delegationList');
Utils::addRoute('carSave', 'CarEditCtrl', ['admin'], 'delegationList');
Utils::addRoute('carDelete', 'CarEditCtrl', ['admin'], 'delegationList');

//city
Utils::addRoute('cityList', 'CityListCtrl', ['admin'], 'delegationList');
Utils::addRoute('cityNew', 'CityEditCtrl', ['admin'], 'delegationList');
Utils::addRoute('cityEdit', 'CityEditCtrl', ['admin'], 'delegationList');
Utils::addRoute('citySave', 'CityEditCtrl', ['admin'], 'delegationList');
Utils::addRoute('cityDelete', 'CityEditCtrl', ['admin'], 'delegationList');

//delegation
Utils::addRoute('delegationList', 'DelegationListCtrl', ['user', 'admin']);
Utils::addRoute('delegationNew', 'DelegationEditCtrl', ['user', 'admin']);
Utils::addRoute('delegationEdit', 'DelegationEditCtrl', ['user', 'admin']);
Utils::addRoute('delegationSave', 'DelegationEditCtrl', ['user', 'admin']);
Utils::addRoute('delegationDelete', 'DelegationEditCtrl', ['user', 'admin']);

