<?php

use core\App;
use core\Utils;

App::getRouter()->setDefaultRoute('personList'); // akcja/ścieżka domyślna
App::getRouter()->setLoginRoute('login'); // akcja/ścieżka na potrzeby logowania (przekierowanie, gdy nie ma dostępu)
//login
Utils::addRoute('login', 'LoginCtrl');
Utils::addRoute('logout', 'LoginCtrl');
Utils::addRoute('loginShow', 'LoginCtrl');

//person
Utils::addRoute('personList', 'PersonListCtrl', ['user', 'admin']);
Utils::addRoute('personNew', 'PersonEditCtrl', ['user', 'admin']);
Utils::addRoute('personEdit', 'PersonEditCtrl', ['user', 'admin']);
Utils::addRoute('personSave', 'PersonEditCtrl', ['user', 'admin']);
Utils::addRoute('personDelete', 'PersonEditCtrl', ['admin']);

//cars
Utils::addRoute('carList', 'CarListCtrl', ['user', 'admin']);
Utils::addRoute('carNew', 'CarEditCtrl', ['admin']);
Utils::addRoute('carEdit', 'CarEditCtrl', ['admin']);
Utils::addRoute('carSave', 'CarEditCtrl', ['admin']);
Utils::addRoute('carDelete', 'CarEditCtrl', ['admin']);

//city
Utils::addRoute('cityList', 'CityListCtrl', ['user', 'admin']);
Utils::addRoute('cityNew', 'CityEditCtrl', ['admin']);
Utils::addRoute('cityEdit', 'CityEditCtrl', ['admin']);
Utils::addRoute('citySave', 'CityEditCtrl', ['admin']);
Utils::addRoute('cityDelete', 'CityEditCtrl', ['admin']);

//delegation
Utils::addRoute('delegationList', 'DelegationListCtrl', ['user', 'admin']);
Utils::addRoute('delegationNew', 'DelegationEditCtrl', ['admin']);
Utils::addRoute('delegationEdit', 'DelegationEditCtrl', ['admin']);
Utils::addRoute('delegationSave', 'DelegationEditCtrl', ['admin']);
Utils::addRoute('delegationDelete', 'DelegationEditCtrl', ['admin']);

