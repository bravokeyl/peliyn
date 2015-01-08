<?php

// Load Redux extensions - MUST be loaded before your options are set
if (file_exists(dirname(__FILE__).'/redux-extensions/extensions-init.php')) {
    require_once( dirname(__FILE__).'/redux-extensions/extensions-init.php' );
}    
// Load the embedded Redux Framework
if (file_exists(dirname(__FILE__).'/redux/ReduxCore/framework.php')) {
    require_once( dirname(__FILE__).'/redux/ReduxCore/framework.php' );
}
// Load the embedded Redux Framework
if (file_exists(dirname(__FILE__).'/tgm/tgm-init.php')) {
    require_once( dirname(__FILE__).'/tgm/tgm-init.php' );
}
// Load the theme options
if (file_exists(dirname(__FILE__).'/options-init.php')) {
    require_once( dirname(__FILE__).'/options-init.php' );
}
// Load the meta options
if (file_exists(dirname(__FILE__).'/cmb2-options.php')) {
    require_once( dirname(__FILE__).'/cmb2-options.php' );
}