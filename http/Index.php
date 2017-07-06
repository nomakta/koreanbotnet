<?php 
ob_start();
session_start();
define("PATH_ROOT", dirname(__FILE__));
require PATH_ROOT . "/_conf/conf.inc.php";


$GetURL = filter_input(INPUT_GET, 'url', FILTER_DEFAULT);
$SetURL = (empty($GetURL) ? 'index' : $GetURL);
$URL = explode('/', $SetURL);

echo  PanelReq . $URL[0];
// We will check if the theme is set up correctly
        if ($URL[0] == 'login'):
            if (file_exists(PanelReq . '/login.php')):
                require_once PanelReq . '/login.php';
            else:
                require_once PanelReq . '/404.php';
            endif;
        else:
            if (file_exists(PanelReq . '/inc/header.php')):
                  require_once PanelReq . '/inc/header.php';
            else:
                trigger_error('Can\'t find page  "/inc/header.inc.php"');
            endif;
            if (file_exists(PanelPath . "/{$URL[0]}.php")):
                require_once PanelReq . "/{$URL[0]}.php";
            else:
                if (file_exists(PanelReq . '/404.php')):
                    require_once PanelReq . '/404.php';
                else:
                    trigger_error('Can\'t find page "404.php"');
                endif;
            endif;
        endif;
        if (file_exists(PanelReq . '/inc/footer.php')):
            require_once PanelReq . '/inc/footer.php';
        else:
            trigger_error('Can\'t find page  "/inc/footer.inc.php"');
        endif;
        ?>

<?php
ob_end_flush();
if (!file_exists('.htaccess')):
    $htaccesswrite = "RewriteEngine On\r\nOptions All -Indexes\r\n\r\nRewriteCond %{SCRIPT_FILENAME} !-f\r\nRewriteCond %{SCRIPT_FILENAME} !-d\r\nRewriteRule ^(.*)$ index.php?url=$1\r\n\r\n<IfModule mod_expires.c>\r\nExpiresActive On\r\nExpiresByType image/jpg 'access 1 year'\r\nExpiresByType image/jpeg 'access 1 year'\r\nExpiresByType image/gif 'access 1 year'\r\nExpiresByType image/png 'access 1 year'\r\nExpiresByType text/css 'access 1 month'\r\nExpiresByType application/pdf 'access 1 month'\r\nExpiresByType text/x-javascript 'access 1 month'\r\nExpiresByType application/x-shockwave-flash 'access 1 month'\r\nExpiresByType image/x-icon 'access 1 year'\r\nExpiresDefault 'access 2 days'\r\n</IfModule>";
    $htaccess = fopen('.htaccess', "w");
    fwrite($htaccess, str_replace("'", '"', $htaccesswrite));
    fclose($htaccess);
endif;
?>