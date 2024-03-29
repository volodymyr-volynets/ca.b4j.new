<?php

$object_override_blank_object = Object\Override\Blank::__set_state(array(
   'data' => 
  array (
    'postlogin_dashboard' => 
    array (
      'numbers_b4j' => 
      array (
        'name' => 'Break For Jesus',
        'icon' => 'fas fa-building',
        'model' => '\\Helper\\Dashboard',
        'order' => -33000,
      ),
      'numbers_organizations' => 
      array (
        'name' => 'Organization Management',
        'icon' => 'fas fa-building',
        'model' => '\\Numbers\\Users\\Organizations\\Helper\\Dashboard',
        'order' => 33000,
      ),
      'numbers_users' => 
      array (
        'name' => 'User Management',
        'icon' => 'far fa-user',
        'model' => '\\Numbers\\Users\\Users\\Helper\\Dashboard\\Dashboard',
        'order' => 32000,
      ),
    ),
    'application_structure' => 
    array (
      'tenant' => 
      array (
        'tenant_datasource' => '\\Numbers\\Tenants\\Tenants\\DataSource\\Tenants',
        'column_prefix' => 'tm_tenant_',
      ),
    ),
    'modules' => 
    array (
      'primary' => 
      array (
        'datasource' => '\\Numbers\\Tenants\\Tenants\\DataSource\\Module\\AllModules',
      ),
    ),
    'registries' => 
    array (
      'primary' => 
      array (
        'datasource' => '\\Numbers\\Tenants\\Tenants\\DataSource\\Registries',
      ),
    ),
    'widgets' => 
    array (
      'audit' => 
      array (
        'model' => '\\Numbers\\Tenants\\Widgets\\Audit\\Model\\Virtual\\Audit',
      ),
      'addresses' => 
      array (
        'model' => '\\Numbers\\Countries\\Widgets\\Addresses\\Model\\Virtual\\Addresses',
      ),
    ),
    'layout' => 
    array (
      'logo' => 
      array (
        'method' => '\\Numbers\\Users\\Organizations\\Helper\\Logo::getURL',
      ),
    ),
    'authorization' => 
    array (
      'login' => 
      array (
        'url' => '/Numbers/Users/Users/Controller/Login',
      ),
      'logout' => 
      array (
        'url' => '/Numbers/Users/Users/Controller/Logout/Quick',
      ),
    ),
    'controllers' => 
    array (
      'primary' => 
      array (
        'datasource' => '\\Numbers\\Users\\Users\\DataSource\\ACL\\Controllers',
      ),
    ),
    'roles' => 
    array (
      'primary' => 
      array (
        'datasource' => '\\Numbers\\Users\\Users\\DataSource\\ACL\\Roles',
      ),
    ),
    'menu' => 
    array (
      'primary' => 
      array (
        'datasource' => '\\Numbers\\Users\\Users\\DataSource\\ACL\\Menu\\Permissions',
      ),
      'usage' => 
      array (
        'datasource' => '\\Numbers\\Users\\Users\\DataSource\\ACL\\Menu',
      ),
    ),
    'user_roles' => 
    array (
      'anonymous' => 
      array (
        'data' => 'SYSTEM_ANONYMOUS',
      ),
      'authorized' => 
      array (
        'data' => 'SYSTEM_AUTHORIZED',
      ),
    ),
    'destroy' => 
    array (
      'log_notifications' => 
      array (
        'method' => '\\Numbers\\Users\\Users\\Helper\\Notification\\Sender::destroy',
      ),
    ),
    'postlogin_brand_url' => 
    array (
      'url' => 
      array (
        'url' => '/Numbers/Users/Users/Controller/Helper/Dashboard',
      ),
    ),
    'form_overrides' => 
    array (
      'primary' => 
      array (
        'model' => '\\Numbers\\Users\\Users\\DataSource\\ACL\\Form\\Overrides',
      ),
    ),
    'actions' => 
    array (
      'primary' => 
      array (
        'datasource' => '\\Numbers\\Backend\\System\\Modules\\DataSource\\Resource\\Actions',
      ),
    ),
  ),
));