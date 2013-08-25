<?php
/**
 * @author         Pierre-Henry Soria <ph7software@gmail.com>
 * @copyright      (c) 2011-2013, Pierre-Henry Soria. All Rights Reserved.
 * @license        MIT License (http://opensource.org/licenses/mit-license.php)
 * @package        pH7CMS
 */

/*** ionCube ***/
if (extension_loaded('ionCube Loader'))
   print "<p style='color:green'>Yes! ionCube PHP Loader is installed.</p>";
else
   print "<p style='color:red'>No! ionCube PHP Loader is not installed.</p>";


/*** Zend Optimizer/Guard ***/
if (function_exists('zend_loader_enabled') && zend_loader_enabled())
   printf("<p style='color:green'>Yes! Zend Guard %f is installed.</p>", zend_loader_version());
elseif (function_exists('zend_optimizer_version'))
   printf("<p style='color:green'>Yes! Zend Optimizer %f is installed.</p>", zend_optimizer_version());
else
   print "<p style='color:red'>No! Zend Optimizer/Guard is not installed.</p>";
