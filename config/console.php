<?php

require_once(dirname(__FILE__) . '/../components/utility/Helper.php');
require_once(dirname(__FILE__) . '/../components/utility/Setting.php');

## Setting initialization
Setting::init(__FILE__);
Setting::initPath();
$basePath = Setting::getBasePath();
$modules = Setting::getModules();

## define config
$config = array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'Plansys Console',
    'preload' => array('log', 'EJSUrlManager'),
    // autoloading model and component classes
    'import' => array(
        'app.models.*',
        'application.models.*',
        'application.forms.*',
        'application.components.*',
        'application.components.ui.*',
        'application.components.ui.FormFields.*',
        'application.components.ui.Widgets.*',
        'application.components.utility.*',
        'application.components.models.*',
        'application.components.codegen.*',
        'application.components.repo.*',
        'application.behaviors.*',
    ),
    'runtimePath' => Setting::getRuntimePath(),
    // preloading 'log' component
    'preload' => array('log'),
    'modules' => array_merge($modules, array(
        'nfy'
    )),
    'aliases' => array(
        'nfy' => realpath(__DIR__ . '/../modules/nfy'),
    ),
    // command map
    'commandMap' => Setting::getCommandMap($modules),
    // application components
    'components' => array(
        'assetManager' => array(
            'basePath' => Setting::getAssetPath()
        ),
        'db' => Setting::getDB(),
        'nfy' => array(
            'class' => 'nfy.components.NfyDbQueue',
            'id' => 'Notifications',
            'timeout' => 30,
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ),
            ),
        ),
    ),
);


$config = Setting::finalizeConfig($config);

return $config;
