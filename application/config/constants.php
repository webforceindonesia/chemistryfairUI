<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

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
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

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
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code

/*
|   Custom Constants
*/

// Online registration openings timestamp
defined('CF_SEMINAR_OPEN_REGISTRATION')     OR define('CF_SEMINAR_OPEN_REGISTRATION',   '2016-09-26 00:00:00');
defined('CF_CFK_OPEN_REGISTRATION')         OR define('CF_CFK_OPEN_REGISTRATION',       '2016-09-01 00:00:00');
defined('CF_CC_OPEN_REGISTRATION')          OR define('CF_CC_OPEN_REGISTRATION',        '2016-09-01 00:00:00');
defined('CF_CIP_OPEN_REGISTRATION')         OR define('CF_CIP_OPEN_REGISTRATION',       '2016-07-01 00:00:00');
defined('CF_CAC_OPEN_REGISTRATION')         OR define('CF_CAC_OPEN_REGISTRATION',       '2016-09-01 00:00:00');

defined('CF_SEMINAR_CLOSE_REGISTRATION')     OR define('CF_SEMINAR_CLOSE_REGISTRATION',   '2016-11-18 00:00:00');
defined('CF_CFK_CLOSE_REGISTRATION')         OR define('CF_CFK_CLOSE_REGISTRATION',       '2016-10-29 00:00:00');
defined('CF_CC_CLOSE_REGISTRATION')          OR define('CF_CC_CLOSE_REGISTRATION',        '2016-10-26 00:00:00');
defined('CF_CIP_CLOSE_REGISTRATION')         OR define('CF_CIP_CLOSE_REGISTRATION',       '2016-10-01 00:00:00');
defined('CF_CAC_CLOSE_REGISTRATION')         OR define('CF_CAC_CLOSE_REGISTRATION',       '2016-10-30 00:00:00');
defined('CF_CIP_PENGUMUMAN_ABSTRAK')         OR define('CF_CIP_PENGUMUMAN_ABSTRAK',       '2016-10-25 00:00:00');

defined('CIP_PENGUMUMAN_FINALIS')           OR define('CIP_PENGUMUMAN_FINALIS',       '2016-10-29 00:00:00');
defined('CC_TRYOUT_ONE')           			OR define('CC_TRYOUT_ONE',     			  '2016-10-24 00:00:00');
defined('CC_TRYOUT_TWO')           			OR define('CC_TRYOUT_TWO',      		  '2016-10-28 00:00:00');
defined('PEREMPAT_FINALIST_CC')           	OR define('PEREMPAT_FINALIST_CC',      	  '2016-11-2 00:00:00');
defined('PEREMPAT_FINAL_CC')           		OR define('PEREMPAT_FINAL_CC',     	  	  '2016-11-12 00:00:00');
defined('CAC_BATAS_AKHIR_UPLOAD')     		OR define('CAC_BATAS_AKHIR_UPLOAD',       '2016-11-12 00:00:00');
