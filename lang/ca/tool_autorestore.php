<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

defined('MOODLE_INTERNAL') || die;

/**
 * Strings for component 'tool_autorestore', language 'en'.
 *
 * @package    tool_autorestore
 * @copyright  Campus Extens - UIB Virtual. 2015 Universitat de les Illes Balears http://www.uib.es
 * @author     Maria Rosa Pérez, Toni Mas, Ricardo Díaz
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$string['active'] = 'Actiu';
$string['aftersaving'] = 'Després de desar els paràmetres, potser voldreu';
$string['autoactivedescription'] = 'Trieu si voleu fer restauracions automatitzades o no. Si seleccioneu l\'opció d\'habilitar-les, podeu especificar quan voleu executar-les emprant tasques programades. Si seleccioneu l\'opció manual, les restauracions automatitzades només es podran dur a terme mitjançant l\'script CLI de restauració automatitzada. Podeu fer-ho de manera manual a la línia d\'ordres o mitjançant cron.';
$string['autoactivedisabled'] = 'Inhabilitat';
$string['autoactiveenabled'] = 'Habilitat';
$string['autoactivemanual'] = 'Manual';
$string['automatedrestoreschedule'] = 'Programa';
$string['automatedrestoreschedulehelp'] = 'Trieu quins dies de la setmana voleu dur a terme restauracions automatitzades.';
$string['autorestore:config'] = 'Permet configurar l\'eina de restauració automàtica';
$string['autorestore:view'] = 'Permet visualitzar totes les coses de l\'eina';
$string['autorestorecrontask'] = 'Restauracions automatitzades';
$string['autorestoreexecuteathelp'] = 'Trieu a quina hora és recomanable que s\'executin les restauracions automatitzades.';
$string['autorestoreexecuted'] = 'La restauració automàtica s\'ha dut a terme dins Moodle';
$string['autorestorefromhelp'] = 'Trieu el directori de còpies de seguretat per als cursos que es restauren automàticament';
$string['autorestoretohelp'] = 'Trieu el directori al qual s\'han de moure els cursos restaurats';
$string['backupname'] = 'Nom de la còpia de seguretat';
$string['backups'] = 'Ubicació dels fitxers de les còpies de seguretat';
$string['backupsdirectory'] = 'Seleccioneu el directori de les còpies de seguretat';
$string['backupwitherrors'] = 'Còpies de seguretat amb problemes/errors.';
$string['basicsettings'] = 'Paràmetres bàsics';
$string['checkdirpermissions'] = 'Comproveu que el servidor pot escriure el fitxer:';
$string['configincludeactivities'] = 'Estableix el valor per defecte per incloure activitats en una restauració.';
$string['configincludebadges'] = 'Estableix el valor per defecte per incloure insígnies en una restauració.';
$string['configincludeblocks'] = 'Estableix el valor per defecte per incloure blocs en una restauració.';
$string['configincludecalendarevents'] = 'Estableix el valor per defecte per incloure esdeveniments del calendari en una restauració.';
$string['configincludecomments'] = 'Estableix el valor per defecte per incloure comentaris en una restauració.';
$string['configincludefilters'] = 'Estableix el valor per defecte per incloure filtres en una restauració.';
$string['configincludehistories'] = 'Estableix el valor per defecte per incloure l\'historial d\'usuari dins una restauració.';
$string['configincludelogs'] = 'Si s\'habilita, els registres s\'inclouran per defecte en les restauracions.';
$string['configincludenrolmanual'] = 'Estableix el valor per defecte per no incloure el mètode d\'inscripció. Totes es faran com "Inscripció manual"';
$string['configincluderoleassignments'] = 'Si s\'habilita, també es restauraran per defecte les assignacions de rols.';
$string['configincludeusers'] = 'Estableix el valor per defecte per incloure els usuaris en les restauracions.';
$string['configincludeuserscompletion'] = 'Si s\'habilita, els detalls de progrés de l\'usuari s\'inclouran per defecte en les restauracions.';
$string['disabled'] = 'El connector està inhabilitat. Si voleu utilitzar-lo, cal que l\'activeu';
$string['doitnow'] = 'Fes ara una restauració massiva';
$string['emailsended'] = 'S\'ha enviat un missatge de correu electrònic de notificació a l\'administrador.';
$string['emptydirbackup'] = 'No s\'ha trobat cap còpia de seguretat de Moodle.';
$string['emptydirrestored'] = 'No s\'ha restaurat cap còpia de seguretat de Moodle.';
$string['errordate'] = 'Executa la data';
$string['errortext'] = 'Error o problema';
$string['executeat'] = 'Executa a l\'hora següent:';
$string['executingrestore'] = 'La comprovació prèvia s\'ha dut a terme amb èxit. La restauració està començant'; 
$string['failcreatenewcourse'] = 'No es pot crear aquest curs: {$a}';
$string['failedcreatedir'] = 'El directori ({$a}) no existeix. No s\'ha pogut crear. Comproveu el camí a MoodleData o els permisos.';
$string['failedexecuterestore'] = 'El procés de restauració ha fallat amb: {$a}';
$string['failedmovedbackup'] = 'ERROR: La còpia de seguretat no s\'ha mogut.';
$string['failedopencourse'] = 'No s\'ha trobat el fitxer {$a} o no teniu permís de lectura';
$string['failprecheck'] = 'Error de la comprovació prèvia: {$a}';
$string['filenotexists'] = 'El fitxer {$a} no existeix';
$string['filesizeproblems'] = 'La mida de la còpia de seguretat és {$a}; això pot ser un problema.';
$string['filespending'] = 'Fitxers pendents de restaurar';
$string['filesrestored'] = 'Còpies de seguretat restaurades';
$string['forceexecution'] = 'Imposa que s\'executi la restauració automàtica';
$string['forceexecution_desc'] = 'La restauració automàtica s\'executarà la pròxima vegada que executeu cron.';
$string['generalautorestoredefaults'] = 'Valors per defecte generals de les restauracions automàtiques';
$string['generalsettings'] = 'Paràmetres generals de restauració';
$string['generaluserscompletion'] = 'Inclou els detalls de progrés de l\'usuari';
$string['invalidbackupdir'] = 'El directori {$a} no existeix';
$string['invalidcategoryname'] = 'El nom de la categoria: {$a} és buit o no és vàlid';
$string['launched'] = 'El procés cron de restauració automàtica es va executar a aquesta hora {$a}';
$string['loggingnotactive'] = 'El registre no està actiu actualment.';
$string['logisnotfile'] = 'La destinació del registre ha de ser un fitxer. ({$a} no és un fitxer)';
$string['lognowritten'] = 'Sembla que el fitxer de registre no s\'ha escrit amb èxit.';
$string['logsize'] = '(Mida del fitxer de registre: {$a})'; 
$string['logtolocation'] = 'Ubicació de sortida del fitxer de registre';
$string['logwrittento'] = 'Les dades de registre s\'han escrit a:';
$string['mailadmins'] = 'Notifica als administradors per correu electrònic';
$string['maildefaultsubject'] = 'Notificació del connector de restauració automàtica de Moodle';
$string['mailsubject'] = 'Assumpte de les notificacions per correu electrònic';
$string['messageprovider:autorestore'] = 'Notificacions del connector de restauració automàtica';
$string['movedbackup'] = 'La còpia de seguretat s\'ha mogut al directori amb èxit';
$string['newcourse'] = 'Crea un curs nou anomenat {$a}';
$string['nobackupswitherrors'] = 'No s\'ha trobat cap error ni problema a les còpies de seguretat';
$string['norestored'] = 'Ubicació dels fitxers no restaurats';
$string['pluginname'] = 'Eina de restauració automatitzada';
$string['pluginname_desc'] = 'Descripció';
$string['processcompleted'] = 'Aquest procés s\'ha completat. Temps emprat: {$a} segons.';
$string['restore'] = 'Restaura';
$string['restored'] = 'Ubicació dels fitxers restaurats';
$string['restoredcourses'] = 'Cursos restaurats';
$string['restorefrom'] = 'Obté còpies de seguretat de';
$string['restores'] = 'Eina de restauració automàtica';
$string['restoresucceded'] = 'La restauració de la còpia de seguretat s\'ha dut a terme amb èxit.';
$string['restoreto'] = 'Mou els cursos restaurats a';
$string['setautorestoreparameters'] = 'Estableix els paràmetres de la restauració automàtica';
$string['settingactivities'] = 'Inclou les activitats i els recursos';
$string['settingbadges'] = 'Inclou les insígnies';
$string['settingblocks'] = 'Inclou els blocs';
$string['settingcalendarevents'] = 'Inclou els esdeveniments de calendari';
$string['settingcomments'] = 'Inclou els comentaris';
$string['settingenrolmanual'] = 'Restaura com a inscripcions manuals';
$string['settingfilters'] = 'Inclou els filtres';
$string['settinggradehistories'] = 'Inclou l\'historial de qualificacions';
$string['settingincludeusers'] = 'Inclou els usuaris inscrits';
$string['settinglogs'] = 'Inclou els registres del curs';
$string['settingroleassignments'] = 'Inclou les assignacions de rol d\'usuari';
$string['settinguserscompletion'] = 'Inclou els detalls de progrés de l\'usuari';
$string['startrestoring'] = 'Està començant la restauració de la còpia de seguretat al curs';
$string['timetaken'] = 'Temps emprat: {$a} segons';
