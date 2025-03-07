<?php
$arUrlRewrite=array (
  38 => 
  array (
    'CONDITION' => '#^/shop_catalog/bitrix/services/ymarket/([\\w\\d\\-]+)?(/)?(([\\w\\d\\-]+)(/)?)?#',
    'RULE' => 'REQUEST_OBJECT=$1&METHOD=$4',
    'ID' => '',
    'PATH' => '/shop_catalog/bitrix/services/ymarket/index.php',
    'SORT' => 100,
  ),
  39 => 
  array (
    'CONDITION' => '#^/shop_catalog/personal/history-of-orders/#',
    'RULE' => '',
    'ID' => 'bitrix:sale.personal.order',
    'PATH' => '/shop_catalog/personal/history-of-orders/index.php',
    'SORT' => 100,
  ),
  76 => 
  array (
    'CONDITION' => '#^/online/([\\.\\-0-9a-zA-Z]+)(/?)([^/]*)#',
    'RULE' => 'alias=$1',
    'ID' => NULL,
    'PATH' => '/desktop_app/router.php',
    'SORT' => 100,
  ),
  78 => 
  array (
    'CONDITION' => '#^/video/([\\.\\-0-9a-zA-Z]+)(/?)([^/]*)#',
    'RULE' => 'alias=$1&videoconf',
    'ID' => 'bitrix:im.router',
    'PATH' => '/desktop_app/router.php',
    'SORT' => 100,
  ),
  40 => 
  array (
    'CONDITION' => '#^/shop_catalog/contacts/stores/#',
    'RULE' => '',
    'ID' => 'bitrix:catalog.store',
    'PATH' => '/shop_catalog/contacts/stores/index.php',
    'SORT' => 100,
  ),
  47 => 
  array (
    'CONDITION' => '#^/shop_catalog/company/vacancy/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/shop_catalog/company/vacancy/index.php',
    'SORT' => 100,
  ),
  41 => 
  array (
    'CONDITION' => '#^/shop_catalog/contacts/stores/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/shop_catalog/contacts/stores/index.php',
    'SORT' => 100,
  ),
  42 => 
  array (
    'CONDITION' => '#^/shop_catalog/personal/order/#',
    'RULE' => '',
    'ID' => 'bitrix:sale.personal.order',
    'PATH' => '/shop_catalog/personal/order/index.php',
    'SORT' => 100,
  ),
  14 => 
  array (
    'CONDITION' => '#^/personal/history-of-orders/#',
    'RULE' => '',
    'ID' => 'bitrix:sale.personal.order',
    'PATH' => '/personal/history-of-orders/index.php',
    'SORT' => 100,
  ),
  48 => 
  array (
    'CONDITION' => '#^/shop_catalog/company/staff/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/shop_catalog/company/staff/index.php',
    'SORT' => 100,
  ),
  45 => 
  array (
    'CONDITION' => '#^/shop_catalog/company/news/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/shop_catalog/company/news/index.php',
    'SORT' => 100,
  ),
  49 => 
  array (
    'CONDITION' => '#^/shop_catalog/info/brands/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/shop_catalog/info/brands/index.php',
    'SORT' => 100,
  ),
  0 => 
  array (
    'CONDITION' => '#^/bitrix/services/ymarket/#',
    'RULE' => '',
    'ID' => '',
    'PATH' => '/bitrix/services/ymarket/index.php',
    'SORT' => 100,
  ),
  13 => 
  array (
    'CONDITION' => '#^/bitrix/services/ymarket/#',
    'RULE' => '',
    'ID' => '',
    'PATH' => '/bitrix/services/ymarket/index.php',
    'SORT' => 100,
  ),
  50 => 
  array (
    'CONDITION' => '#^/shop_catalog/services/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/shop_catalog/services/index.php',
    'SORT' => 100,
  ),
  46 => 
  array (
    'CONDITION' => '#^/shop_catalog/projects/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/shop_catalog/projects/index.php',
    'SORT' => 100,
  ),
  52 => 
  array (
    'CONDITION' => '#^/shop_catalog/landings/#',
    'RULE' => '',
    'ID' => 'bitrix:catalog',
    'PATH' => '/shop_catalog/landings/index.php',
    'SORT' => 100,
  ),
  54 => 
  array (
    'CONDITION' => '#^/shop_catalog/personal/#',
    'RULE' => '',
    'ID' => 'bitrix:sale.personal.section',
    'PATH' => '/shop_catalog/personal/index.php',
    'SORT' => 100,
  ),
  55 => 
  array (
    'CONDITION' => '#^/shop_catalog/catalog/#',
    'RULE' => '',
    'ID' => 'bitrix:catalog',
    'PATH' => '/shop_catalog/catalog/index.php',
    'SORT' => 100,
  ),
  124 => 
  array (
    'CONDITION' => '#^/glaznye-zabolevaniya/#',
    'RULE' => '',
    'ID' => 'bitrix:catalog',
    'PATH' => '/glaznye-zabolevaniya/index.php',
    'SORT' => 100,
  ),
  43 => 
  array (
    'CONDITION' => '#^/shop_catalog/blog/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/shop_catalog/blog/index.php',
    'SORT' => 100,
  ),
  44 => 
  array (
    'CONDITION' => '#^/shop_catalog/auth/#',
    'RULE' => '',
    'ID' => 'aspro:auth.next',
    'PATH' => '/shop_catalog/auth/index.php',
    'SORT' => 100,
  ),
  53 => 
  array (
    'CONDITION' => '#^/shop_catalog/sale/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/shop_catalog/sale/index.php',
    'SORT' => 100,
  ),
  77 => 
  array (
    'CONDITION' => '#^/online/(/?)([^/]*)#',
    'RULE' => '',
    'ID' => NULL,
    'PATH' => '/desktop_app/router.php',
    'SORT' => 100,
  ),
  126 => 
  array (
    'CONDITION' => '#^/company/licenses/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/company/licenses/index.php',
    'SORT' => 100,
  ),
  110 => 
  array (
    'CONDITION' => '#^/company/reviews/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/company/reviews/index.php',
    'SORT' => 100,
  ),
  121 => 
  array (
    'CONDITION' => '#^/contacts/stores/#',
    'RULE' => '',
    'ID' => 'bitrix:catalog.store',
    'PATH' => '/contacts/stores/index.php',
    'SORT' => 100,
  ),
  123 => 
  array (
    'CONDITION' => '#^/company/history/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/company/history/index.php',
    'SORT' => 100,
  ),
  127 => 
  array (
    'CONDITION' => '#^/company/vacancy/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/company/vacancy/index.php',
    'SORT' => 100,
  ),
  18 => 
  array (
    'CONDITION' => '#^/personal/order/#',
    'RULE' => '',
    'ID' => 'bitrix:sale.personal.order',
    'PATH' => '/personal/order/index.php',
    'SORT' => 100,
  ),
  129 => 
  array (
    'CONDITION' => '#^/info/articles/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/info/articles/index.php',
    'SORT' => 100,
  ),
  135 => 
  array (
    'CONDITION' => '#^/company/staff/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/company/staff/index.php',
    'SORT' => 100,
  ),
  122 => 
  array (
    'CONDITION' => '#^/company/news/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/company/news/index.php',
    'SORT' => 100,
  ),
  137 => 
  array (
    'CONDITION' => '#^/info/stock/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/info/stock/index.php',
    'SORT' => 100,
  ),
  136 => 
  array (
    'CONDITION' => '#^/info/news/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/info/news/index.php',
    'SORT' => 100,
  ),
  30 => 
  array (
    'CONDITION' => '#^/personal/#',
    'RULE' => '',
    'ID' => 'bitrix:sale.personal.section',
    'PATH' => '/personal/index.php',
    'SORT' => 100,
  ),
  117 => 
  array (
    'CONDITION' => '#^/info/faq/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/info/faq/index.php',
    'SORT' => 100,
  ),
  132 => 
  array (
    'CONDITION' => '#^/projects/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/projects/index.php',
    'SORT' => 100,
  ),
  138 => 
  array (
    'CONDITION' => '#^/services/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/services/index.php',
    'SORT' => 100,
  ),
  59 => 
  array (
    'CONDITION' => '#^/catalog/#',
    'RULE' => '',
    'ID' => 'bitrix:catalog',
    'PATH' => '/catalog/index.php',
    'SORT' => 100,
  ),
  83 => 
  array (
    'CONDITION' => '#^/special/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/special/index.php',
    'SORT' => 100,
  ),
  12 => 
  array (
    'CONDITION' => '#^/study/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/study/index.php',
    'SORT' => 100,
  ),
  114 => 
  array (
    'CONDITION' => '#^/sale/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/sale/index.php',
    'SORT' => 100,
  ),
  118 => 
  array (
    'CONDITION' => '#^/auth/#',
    'RULE' => '',
    'ID' => 'aspro:auth.next',
    'PATH' => '/auth/index.php',
    'SORT' => 100,
  ),
  119 => 
  array (
    'CONDITION' => '#^/blog/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/blog/index.php',
    'SORT' => 100,
  ),
);
