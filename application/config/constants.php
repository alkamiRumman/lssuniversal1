<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') or define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE') or define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') or define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE') or define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE') or define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ') or define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE') or define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE') or define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE') or define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE') or define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE') or define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT') or define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT') or define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS') or define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR') or define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG') or define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE') or define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS') or define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') or define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT') or define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE') or define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN') or define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX') or define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code


defined('TABLE_ENTERTAINER') or define('TABLE_ENTERTAINER', "entertainer");
defined('TABLE_CREWMEMBERS') or define('TABLE_CREWMEMBERS', "crewMembers");
defined('TABLE_THEATRECREW') or define('TABLE_THEATRECREW', "theatreCrew");
defined('TABLE_PRODUCTIONS') or define('TABLE_PRODUCTIONS', "productions");
defined('TABLE_MARKETINGFEE') or define('TABLE_MARKETINGFEE', "marketingFee");
defined('TABLE_RENTALANDMISC') or define('TABLE_RENTALANDMISC', "rentalAndMisc");
defined('TABLE_TICKETTIERING') or define('TABLE_TICKETTIERING', "ticketTiering");
defined('TABLE_VENDORINVOICE') or define('TABLE_VENDORINVOICE', "vendorInvoice");
defined('TABLE_VENDORINVOICEDETAILS') or define('TABLE_VENDORINVOICEDETAILS', "vendorInvoiceDetails");
defined('TABLE_VENUE') or define('TABLE_VENUE', "venues");
defined('TABLE_VENUEPOC') or define('TABLE_VENUEPOC', "venuePoc");
defined('TABLE_VENUEATTACHMENT') or define('TABLE_VENUEATTACHMENT', "venueAttachment");
defined('TABLE_RUNOFSHOW') or define('TABLE_RUNOFSHOW', "runOfShow");
defined('TABLE_RUNOFSHOWITEMS') or define('TABLE_RUNOFSHOWITEMS', "runOfShowItems");
defined('TABLE_RUNOFSHOWTITLES') or define('TABLE_RUNOFSHOWTITLES', "runOfShowTitles");
defined('TABLE_RUNOFSHOWCREWTRAVEL') or define('TABLE_RUNOFSHOWCREWTRAVEL', "runOfShowCrewTravel");
defined('TABLE_RUNOFSHOWTALENTCREW') or define('TABLE_RUNOFSHOWTALENTCREW', "runOfShowTalentCrew");
defined('TABLE_RUNOFSHOWPOC') or define('TABLE_RUNOFSHOWPOC', "runOfShowPoc");
defined('TABLE_TIMEDACCESSLINK') or define('TABLE_TIMEDACCESSLINK', "timedAccessLink");
defined('TABLE_TIMEDACCESSLINKCREWTRAVEL') or define('TABLE_TIMEDACCESSLINKCREWTRAVEL', "timedAccessLinkCrewTravel");
defined('TABLE_TIMEDACCESSLINKTALENTTRAVEL') or define('TABLE_TIMEDACCESSLINKTALENTTRAVEL', "timedAccessLinkTalentTravel");
defined('TABLE_TIMEDACCESSLINKPOC') or define('TABLE_TIMEDACCESSLINKPOC', "timedAccessLinkPoc");
defined('TABLE_PROJECTS') or define('TABLE_PROJECTS', "projects");
defined('TABLE_PROJECTOVERVIEW') or define('TABLE_PROJECTOVERVIEW', "projectOverview");
defined('TABLE_PROJECTKPITITLE') or define('TABLE_PROJECTKPITITLE', "projectKpiTitle");
defined('TABLE_PROJECTKPIITEM') or define('TABLE_PROJECTKPIITEM', "projectKpiItem");
defined('TABLE_USERS') or define('TABLE_USERS', "users");
define('COMPANY', 'LSS UNIVERSAL');
define('SHORTNAME', 'LSS');
