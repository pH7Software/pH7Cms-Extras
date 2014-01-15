<?php
/**
 * @title          Admin Password Generator for pH7CMS 1.1 or higher.
 * @desc           Generate the admin Password + Prefix & Suffix admin salt.
 *
 * @author         Pierre-Henry Soria <ph7software@gmail.com>
 * @copyright      (c) 2014, Pierre-Henry Soria. All Rights Reserved.
 * @license        GNU General Public License <http://www.gnu.org/licenses/gpl.html>
 */

if (version_compare(PHP_VERSION, '5.5.0', '<'))
    exit('Your PHP version is ' . PHP_VERSION . ' but this script requires PHP 5.5 or newer.');
    
/**
 * Your admin password in clear text (unencrypted).
 */
$sPassword = '123456_my_admin_password';

/**
 * This hashed password must be inserted into the "password" column of the "pH7_Admins" table.
 */
$sHashedPassword = password_hash($sPassword , PASSWORD_BCRYPT, array('cost' => 14));


/*** This will be displayed in your Web browser ***/
echo 'Password must be inserted into the "password" column of the "pH7_Admins" table is: ' . $sHashedPassword;
