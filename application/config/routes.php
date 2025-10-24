<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.coapplication/config/routes.php:22m/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'welcome';
// $route['404_override'] = '';
$route['404_override'] = 'welcome/vers_externe';
$route['translate_uri_dashes'] = FALSE;

//route dashbord
$route['Bord'] = 'dashbord/dashbord_controller/nombre_eleve';
$route['moyenne'] = 'dashbord/dashbord_controller/nombre_eleve';


$route['test'] = 'Authentification/authentification/test';
//route login
$route['Login'] = 'Authentification/controlle/affiche_login';
//-route_eleve
$route['Eleve'] = 'traitement/traitement_controller/view_ajout_eleve';
$route['api/v1/eleves']['GET']='traitement/traitement_controller/getApi_eleve';//api qui recupere les eleve
//route api version
$route['api/v1/eleves']['POST'] = 'traitement/traitement_controller/ajout_eleve';
// $route['Ajout'] = 'traitement/traitement_controller/ajout_eleve'; 09 09 25
$route['Accueil'] = 'welcome/index';
$route['get_eleve_matiere'] = 'traitement/traitement_controller/get_eleve';
$route['recupere_avecID_eleve'] = 'traitement/traitement_controller/getById_eleve';
// $route['upgrader_eleve'] = 'traitement/traitement_controller/update_eleve';09 09 25
$route['api/v1/eleves/(:num)']['PUT'] = 'traitement/traitement_controller/update_eleve/$1';

//pour cacher le id
$route['DetailE/(:num)'] = 'traitement/traitement_controller/rediriger_detail_eleve/$1';
$route['eleveD'] = 'traitement/traitement_controller/eleve_detail';
//-routes_enseignant
$route['Enseignant'] = 'traitement/Enseignant_controller/load_enseignant';
$route['enseignant_ajout'] = 'traitement/Enseignant_controller/ajout_enseignant';
$route['recup_donne_enseign'] = 'traitement/Enseignant_controller/recuperer';
$route['recupere_avecID'] = 'traitement/Enseignant_controller/getById';
$route['upgrader_enseignant'] = 'traitement/Enseignant_controller/update_enseignant';
//pour cacher le id
$route['Detail/(:num)'] = 'traitement/Enseignant_controller/rediriger_detail_enseignant/$1';
$route['detail'] = 'traitement/Enseignant_controller/enseignant_detail';

//-routes_filiere
$route['Filiere'] = 'traitement/filiere_controller/show_filiere';
$route['ajout_filier'] = 'traitement/filiere_controller/ajout_filier';


$route['EleveFiliere/(:num)'] = 'traitement/filiere_controller/rediriger_eleve_par_filier/$1';
$route['EleveF'] = 'traitement/filiere_controller/eleve_par_filiere';
//route-note
$route['add_note'] = 'traitement/traitement_controller/Ajout_note';

//pour cacher le id
$route['rediriger_note_eleve/(:num)/(:any)'] = 'traitement/filiere_controller/rediriger_note_eleve/$1/$2';
$route['Note'] = 'traitement/filiere_controller/note_eleve';
//route matiere
//pour cacher le id
$route['MatriereF/(:num)'] = 'traitement/filiere_controller/rediriger_matiere_eleve/$1';
$route['EleveM'] = 'traitement/filiere_controller/matiere_eleve';
$route['ajout_Matiere'] = 'traitement/filiere_controller/ajout_Matiere';

//route pour utilisateur
$route['Utilisateur'] = 'Authentification/controlle/view_utilisateur';
$route['ajout_utilisateur'] = 'Authentification/controlle/Add_utilisateur';

$route['get_utilisateur'] = 'Authentification/controlle/recuperer';
$route['controlle_de_connexion'] = 'Authentification/controlle/check_mdp';

$route['logout'] = 'Authentification/controlle/logout';

//route matiere_filiere
$route['ajoutMatFi'] = 'traitement/filiere_controller/ajout_MatiereFiliere';


$route['inscription'] = 'traitement/traitement_controller/view_inscription';
$route['add_inscription'] = 'traitement/traitement_controller/inscription_eleve';
$route['get_inscription'] = 'traitement/traitement_controller/get_inscription';
$route['recupere_avecID_inscription'] = 'traitement/traitement_controller/getById_inscription';
$route['modification_inscription'] = 'traitement/traitement_controller/modif_inscription';
//route pour la recherche
$route['api/v1/find']['POST'] = 'traitement/Enseignant_controller/chercher';
$route['api/v1/findEleve']['POST'] = 'traitement/traitement_controller/getEleve';
