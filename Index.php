<?php 

ob_start();
session_start();
require '_conf/conf.inc.php';
$GetURL = filter_input(INPUT_GET, 'url', FILTER_DEFAULT);
$SetURL = (empty($GetURL) ? 'index' : $GetURL);
$URL = explode('/', $SetURL);

//Panel Logs(Users who visited)


// Theme checks
if ($URL[0] == 'login'):
            if (file_exists(REQUIRE_PATH . '/login.php')):
                require_once REQUIRE_PATH . '/login.php';
            else:
                require_once REQUIRE_PATH . '/404.php';
            endif;
        else:
            if (file_exists(REQUIRE_PATH . '/inc/header.php')):
                require_once REQUIRE_PATH . '/inc/header.php';
            else:
                trigger_error('Theme Error: "Themes/" + PanelTheme + "/inc/header.php" doesn't exist, please create one!');
            endif;
        else: 
            if(file_Exists(REQUIRE_PATH . '/inc/footer.php));
              require_once REQUIRE_PATH . '/inc/footer.php';
        else: 
             trigger_error('Theme Error: "Themes/" + PanelTheme + "/inc/footer.php" doesn't exist, please create one!');
        endif;
                else: 
            if(file_Exists(REQUIRE_PATH . '/404.php));
              require_once REQUIRE_PATH . '/404.php';
        else: 
             trigger_error('Theme Error: "Themes/" + PanelTheme + "/404.php" doesn't exist, please create one!');
        endif;
        
?>





 

 



