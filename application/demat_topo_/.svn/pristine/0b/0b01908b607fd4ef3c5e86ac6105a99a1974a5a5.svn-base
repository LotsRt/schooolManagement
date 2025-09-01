<?php

defined('BASEPATH') or exit('No direct script access allowed');

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
$route['default_controller'] = 'login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = false;


//routes reproduction de documents topo
$route['list_reproduction/(:num)/(:any)'] = 'reproduction/reproduction/list_reproduction/$1/$2';
$route['list_reproduction/(:num)'] = 'reproduction/reproduction/list_reproduction/$1';
$route['add_reproduction'] = 'reproduction/reproduction/add_reproduction';
$route['detail_reproduction/(:num)'] = 'reproduction/reproduction/detail_reproduction/$1';
$route['payer_reproduction'] = 'reproduction/reproduction/payer_reproduction';
$route['save_verif_doc_exist'] = 'reproduction/reproduction/save_verif_doc_exist';
$route['generate_rtx/(:num)'] = 'reproduction/reproduction/generate_rtx/$1';
$route['print_recu_reprod'] = 'reproduction/reproduction/print_recu_reprod';
$route['send_reproduction'] = 'reproduction/reproduction/send_reproduction';
$route['validate_scan'] = 'reproduction/reproduction/validate_scan';
$route['validate_vectorisation'] = 'reproduction/reproduction/validate_vectorisation';
$route['validate_verif_reprod'] = 'reproduction/reproduction/validate_verif_reprod';
$route['validate_signature_reprod'] = 'reproduction/reproduction/validate_signature_reprod';
$route['validate_delivrance'] = 'reproduction/reproduction/validate_delivrance';
$route['validate_reproduction'] = 'reproduction/reproduction/validate_reproduction';
$route['check_document'] = 'reproduction/reproduction/check_document';
$route['check_archive_numerique'] = 'reproduction/reproduction/check_archive_numerique';
$route['find_reproduction/(:any)'] = 'reproduction/reproduction/find_reproduction/$1';
$route['find_reproduction/(:any)/(:num)'] = 'reproduction/reproduction/find_reproduction/$1/$2';
$route['find_reproduction'] = 'reproduction/reproduction/find_reproduction';
//fin routes reproduction de documents topo

//routes dessin
$route['view_dessin'] = 'dessin/Dessin/view_dessin';
$route['auto_view'] = 'auto/Auto/view';
//fin routes dessin

// ---------------------------------------------valider -------------------------------------------
// debut route dossier

//nkitihana
// $route['list_dossier/(:num)'] = 'dossier/dossier/list_dossier/$1';
$route['rediriger_dossier/(:num)'] = 'dossier/dossier/rediriger_dossier/$1';
$route['list_dossier'] = 'dossier/dossier/list_dossier';
//atreto

$route['add_dossier'] = 'dossier/dossier/add_dossier';
$route['find_dossier_rtx_all_utilisateur'] = 'dossier/dossier/find_dossier_rtx_all_utilisateur';
$route['validate_satisfaction'] = 'dossier/dossier/validate_satisfaction';
$route['get_user_type/(:num)'] = 'dossier/dossier/get_user_type/$1';
$route['find_dossier'] = 'dossier/dossier/find_dossier';
$route['remise_geo'] = 'dossier/dossier/remise_geo';
$route['polygone'] = 'dossier/dossier/polygone';
$route['get_Data_dossier'] = 'dossier/dossier/get_Data_dossier';
$route['getFktBy_commune/(:any)'] = 'dossier/Dossier/getFktBy_commune/$1';
//Details Dossier
$route['detail_suivie_dossier/(:num)'] = 'dossier/dossier/detail_suivie_dossier/$1';
$route['detail_dossier/(:num)'] = 'dossier/dossier/detail_dossier/$1';
$route['payer_dossier'] = 'dossier/dossier/payer_dossier';
$route['validate_verif_avt_remise'] = 'dossier/dossier/validate_verif_avt_remise';
$route['get_list_pieces'] = 'dossier/dossier/get_list_pieces';
$route['print_recu'] = 'dossier/dossier/print_recu';
$route['validate_verification'] = 'dossier/dossier/validate_verification';
$route['validate_geometre'] = 'dossier/dossier/validate_geometre';
$route['validate_visa'] = 'dossier/dossier/validate_visa';
$route['send_dossier'] = 'dossier/dossier/send_dossier';
$route['list_visa'] = 'dossier/dossier/list_visa';
$route['remise_dossier'] = 'dossier/dossier/remise_dossier';
$route['renvoie_dossier'] = 'dossier/dossier/renvoie_dossier';
$route['rattacher_pj'] = 'dossier/dossier/rattacher_pj';
$route['validate_reperage'] = 'dossier/dossier/validate_reperage';
$route['info_dossier'] = 'dossier/dossier/info_dossier';
$route['observation_dossier'] = 'dossier/dossier/getObservation';
$route['historique_dossier/(:num)'] = 'dossier/dossier/historique_dossier/$1';
$route['list_origine'] = 'dossier/dossier/list_origine';
$route['notification'] = 'dossier/dossier/notification';
$route['notification_count'] = 'dossier/dossier/notification_count';
$route['rtx'] = 'dossier/dossier/rtx';
$route['verification_num'] = 'dossier/dossier/verification_num';
$route['integration'] = 'dossier/dossier/integration';
$route['get_details_dossier'] = 'dossier/dossier/get_details_dossier';
$route['get_commune_details_dossier'] = 'dossier/dossier/get_commune_details_dossier';
$route['update_details_dossier'] = 'dossier/dossier/update_details_dossier';
$route['update_req_dossier'] = 'dossier/dossier/update_req_dossier';

//route send Email usage
$route['informe_usage'] = 'dossier/Dossier/informe_usage';
// fin route dossier

//routes initialise base
$route['image_sql_admin'] = 'admin/admin/view_sql';
$route['insert_admin'] = 'admin/admin/insert_sql';
//routes initialise base

//route plan haveloMandrare
$route['plan'] = 'plan/Plan/view_plan';
//fin route plan havelomandrare

//routes utilisateurs
$route['login'] = '/authentification/utilisateur/login';
$route['accueil'] = 'Login';
$route['check_login'] = 'authentification/utilisateur/check_login';
$route['deconnexion'] = 'authentification/utilisateur/deconnexion/';
$route['list_user/(:num)'] = 'authentification/utilisateur/list_utilisateur/$1';
$route['chgstate_user/(:num)/(:num)'] = 'authentification/utilisateur/change_state_signup/$1/$2';
$route['search_users/(:any)'] = 'authentification/utilisateur/search_users/$1';
$route['search_list_user/(:num)'] = 'authentification/utilisateur/search_list_user/$1';
$route['add_user'] = 'authentification/Utilisateur/add_user';
$route['profile'] = 'authentification/Utilisateur/profil';
$route['edit_utilisateur'] = 'authentification/Utilisateur/edit_utilisateur';
$route['get_data_user'] = 'authentification/Utilisateur/get_data_user';
//Fin route utilisateur

//routes groupe ou type utilisateur
$route['list_group/(:num)'] = 'authentification/groupe/list_group/$1';
$route['new_group'] = 'authentification/groupe/new_group';
$route['edit_group/(:num)'] = 'authentification/groupe/edit_group/$1';
$route['update_group/(:num)'] = 'authentification/groupe/update_group/$1';
$route['get_Data_type_user'] = 'authentification/groupe/get_Data_type_user';
// $route['search_type_user/(:any)'] = 'authentification/groupe/search_type_user/$1';
// $route['search_liste_type_user/(:num)'] = 'authentification/groupe/search_liste_type_user/$1';

//Fin route groupe ou type utilisateur


//routes demandeur
// $route['list_demandeur/(:num)'] = 'dossier/demandeur/list_demandeur/$1';
$route['list_demandeur'] = 'dossier/demandeur/list_demandeur';
$route['new_demandeur'] = 'dossier/demandeur/new_demandeur';
$route['edit_demandeur/(:num)'] = 'dossier/demandeur/edit_demandeur/$1';
$route['update_demandeur/(:num)'] = 'dossier/demandeur/update_demandeur/$1';
$route['update_demandeur_json'] = 'dossier/demandeur/update_demandeur_json';
$route['add_demandeur_json'] = 'dossier/demandeur/add_demandeur_json';
$route['get_Data'] = 'dossier/demandeur/get_Data';
//Fin routes demandeur

//routes traitement
// $route['list_traitement/(:num)'] = 'traitement/traitement/list_traitement/$1';
$route['list_traitement'] = 'traitement/traitement/list_traitement';
$route['new_type_traitement'] = 'traitement/traitement/new_type_traitement';
$route['edit_type_traitement/(:num)'] = 'traitement/traitement/edit_type_traitement/$1';
$route['get_info_traitement'] = 'traitement/traitement/get_info_traitement';
$route['update_type_traitement/(:num)'] = 'traitement/traitement/update_type_traitement/$1';
$route['get_data_traitement'] = 'traitement/traitement/get_data_traitement';
// $route['search_type_traitement/(:any)'] = 'traitement/traitement/search_type_traitement/$1';
// $route['search_list_traitement/(:num)'] = 'traitement/traitement/search_list_traitement/$1';
//fin routes traitement

//routes procedures
// $route['list_procedure/(:num)'] = 'traitement/procedure/list_procedure/$1';
$route['list_procedure'] = 'traitement/procedure/list_procedure';
$route['new_procedure'] = 'traitement/Procedure/new_procedure';
$route['edit_procedure/(:num)'] = 'traitement/procedure/edit_procedure/$1';
$route['update_procedure/(:num)'] = 'traitement/procedure/update_procedure/$1';
$route['all_procedure'] = 'traitement/procedure/all_procedure';
$route['get_data_procedure'] = 'traitement/procedure/get_data_procedure';
// $route['search_procedure/(:any)'] = 'traitement/Procedure/search_procedure/$1';
// $route['search_list_procedure/(:num)'] = 'traitement/Procedure/search_list_procedure/$1';
//fin routes procedures

//Debut route territoire
$route['import_territoire'] = 'territoire/territoire/import_territoire';
$route['list_commune/(:num)'] = 'territoire/territoire/list_commune/$1';
$route['add_commune'] = 'territoire/territoire/add_commune';
$route['update_commune'] = 'territoire/territoire/get_commune_by_id';
$route['edit_commune/(:num)'] = 'territoire/territoire/edit_commune/$1';
$route['get_data_commune'] = 'territoire/territoire/get_data_commune';
// $route['search_commune'] = 'territoire/territoire/search_commune';
//FOKONTANY
$route['add_fokontany'] = 'territoire/territoire/add_fokontany';
$route['update_fokontany'] = 'territoire/territoire/get_fokontany_by_id';
$route['edit_fokontany/(:num)'] = 'territoire/territoire/edit_fokontany/$1';
$route['list_fokontany/(:num)'] = 'territoire/territoire/list_fokontany/$1';
$route['get_data_fokontany'] = 'territoire/territoire/get_data_fokontany';
// $route['search_fokontany'] = 'territoire/territoire/search_fokontany';
//Fin route territoire

//routes ge
$route['add_ge'] = 'ge/ge/add_ge';
$route['list_ge/(:num)'] = 'ge/ge/list_ge/$1';
$route['list_ge_json/(:num)'] = 'ge/ge/list_ge_json/$1';
$route['search_ge/(:any)'] = 'ge/ge/search_ge/$1';
$route['get_ge/(:num)'] = 'ge/ge/get_ge/$1';
$route['edit_ge/(:num)'] = 'ge/ge/edit_ge/$1';
$route['get_Data_ge'] = 'ge/ge/get_Data_ge';
$route['search_liste_ge/(:num)'] = 'ge/ge/search_liste_ge/$1';
$route['search_geometre'] = 'ge/ge/search_geometre';
//fin routes ge

//route Parametres
$route['liste_circonscription/(:num)'] = 'parametres/Parametres/liste_circonscription/$1';
$route['edit_circonscription/(:num)'] = 'parametres/Parametres/edit_circonscription/$1';
$route['update_circonscription/(:num)'] = 'parametres/Parametres/update_circonscription/$1';
$route['new_cir'] = 'parametres/Parametres/new_cir';
$route['get_Data_cir'] = 'parametres/Parametres/get_Data_cir';
// $route['search_cir/(:any)'] = 'parametres/Parametres/search_cir/$1';
// $route['search_list_cir/(:num)'] = 'parametres/Parametres/search_list_cir/$1';
$route['import_dossier'] = 'parametres/Parametres/import_';
//fin route Parametres

// route reperage_plof
$route['view_rep_plof'] = 'cartographie/Cartographie/view_rep_plof';
$route['import_dxf'] = 'cartographie/Cartographie/import_dxf';
$route['reperage'] = 'cartographie/Cartographie/reperage';
$route['import_dxf_rep'] = 'cartographie/Cartographie/import_dxf_rep';
$route['import_csv_rep'] = 'cartographie/Cartographie/import_csv_rep';
// fin route reperage_plof

//route archive
$route['view_archive/(:num)'] = 'archive/Archive/view_archive/$1';
$route['archive_detail/(:any)'] = 'archive/Archive/archive_detail/$1';
$route['piece_joint'] = 'archive/Archive/piece_joint';
$route['search_archive'] = 'archive/Archive/search';
$route['info_numero'] = 'archive/Archive/info_numero';
//fin route archive

// debut route dashbord
$route['dashboard'] = 'dashboard/dashboard/view_dashboard';
$route['dashboard_mes_dossier'] = 'dashboard/dashboard/view_dashboard_dossier';
$route['dashboard_filtre_service'] = 'dashboard/Dashboard/dashboard_filtre_service';
$route['dashboard_filtre_rapport_activites'] = 'dashboard/Dashboard/dashboard_filtre_rapport_activites';
// fin route dashbord

//debut route inventaire calque
$route['View_inventaire'] = 'inventaire/inventaire/view_inventaire';
$route['add_calque'] = 'inventaire/inventaire/add_calque';
$route['get_Data_calque'] = 'inventaire/inventaire/get_Data_calque';
$route['get_calque_id'] = 'inventaire/inventaire/get_calque_by_id';
$route['update_calque'] = 'inventaire/inventaire/update_calque';
$route['import_calque'] = 'inventaire/inventaire/import_input_calque';
