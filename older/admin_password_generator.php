<?php
/**
 * @title          Admin Password Generator for pH7CMS
 * @desc           Generate the admin Password + Prefix & Suffix admin salt.
 *
 * @author         Pierre-Henry Soria <ph7software@gmail.com>
 * @copyright      (c) 2013, Pierre-Henry Soria. All Rights Reserved.
 * @license        GNU General Public License <http://www.gnu.org/licenses/gpl.html>
 */


/**
 * Your admin password in clear text (unencrypted).
 */
$sPassword = '123456_my_admin_password';


/**
 * The prefix salt must be inserted into the "prefixSalt" column of the "pH7_Admins" table.
 */
$sPrefixSalt = Various::genRnd();

/**
 * The suffix salt must be inserted into the "suffixSalt" column of the "pH7_Admins" table.
 */
$sSuffixSalt = Various::genRnd();

/**
 * The password must be inserted into the "password" column of the "pH7_Admins" table.
 */
$sGeneratedPassword = Security::hashPwd($sPrefixSalt, $sPassword, $sSuffixSalt, Security::ADMIN);


/*** This will be displayed in your Web browser ***/
echo 'Password must be inserted into the "password" column of the "pH7_Admins" table is: ' . $sGeneratedPassword . '<br /><br />';
echo 'Prefix Salt must be inserted into the "prefixSalt" column of the "pH7_Admins" table is: ' . $sPrefixSalt . '<br /><br />';
echo 'Suffix Salt must be inserted into the "suffixSalt" column of the "pH7_Admins" table is: ' . $sSuffixSalt;


final class Security
{
    const
    ADMIN = 'admin',
    USER = 'user',
    LENGTH_USER_PASSWORD = 120,
    LENGTH_ADMIN_PASSWORD = 240,
    /*** Our salts. Never change these values​​, otherwise all passwords and other strings will be incorrect ***/
    PREFIX_SALT = 'c好，你今Здраврыве ты ў паітаньне е54йте天rt&eh好嗎_dمرحبا أنت بخير ال好嗎attú^u5atá inniu4a,?478привіなたは大丈夫今日はтивпряьоהעלאai54ng_scси днесpt',
    SUFFIX_SALT = '*éà12_you_è§§=≃ù%µµ££$);&,?µp{èàùf*sxdslut_waruआप नमस्क你好，你今ार ठΓει好嗎α σαςb안녕하세oi요 괜찮은 o नमस्कार ठीnjre;,?*-<καλά σήμεραीक आजсегодняm_54tjהעלאdgezsядкمرحبا';

    public static function hashPwd($sPrefixSalt, $sPassword, $sSuffixSalt, $sMod = null)
    {
        // Password 240 characters for administrators and 120 characters for users
        $iLengthPwd = ($sMod === self::ADMIN) ? self::LENGTH_ADMIN_PASSWORD : self::LENGTH_USER_PASSWORD;

        // Chop the password
        return Various::padStr(hash('whirlpool', hash('sha512', self::PREFIX_SALT . hash('whirlpool', $sPrefixSalt)) . hash('whirlpool', $sPassword) . hash('sha512', hash('whirlpool', $sSuffixSalt) . self::SUFFIX_SALT)), $iLengthPwd);
    }
}

class Various
{
    public static function genRnd($sStr = null, $iLength = 40)
    {
        $sStr = (!empty($sStr)) ? (string) $sStr : '';
        $sChars = hash('whirlpool', hash('whirlpool', uniqid(mt_rand(), true) . $sStr . getenv('REMOTE_ADDR') . time()) . hash('sha512', getenv('HTTP_USER_AGENT') . microtime(true)*9999));
        return self::padStr($sChars, $iLength);
    }

    public static function padStr($sStr, $iLength = 40)
    {
        $iLength = (int) $iLength;
        return (mb_strlen($sStr) >= $iLength) ? substr($sStr, 0, $iLength) : str_pad($sStr, $iLength, $sStr);
    }
}
