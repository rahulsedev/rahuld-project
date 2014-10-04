<?php

$config['Email'] = array(
	'EmailSupport' => 'support@tridev.com',
    'EmailName' => 'Tridev Support Team',
	'EmailAdmin' => 'admin@riversonata.com'
);

$config['SITE_SETTINGS'] = array(
	'Name' => 'Tridev Sales & Marketing Services',
  'Slogan' => 'Tridev Sales & Marketing Services',
	'Copyright' => "All Rights Reserved. Copyright &copy; Tridev Sales & Marketing Services 2014"
);

$config['LIST_NUM_RECORDS'] = array(
	'Superadmin' => 10,
	'Admin' => 10,
	'User' => 10,
);

$config['EntityStatus'] = array(
    0 => 'In Active',
    1 => 'Active'
);

$config['StockTypes'] = array(
    1 => 'Kg. Percentages',
    2 => 'Number'
);

$config['PremiumProduct'] = array(
    0 => 'N/A',
    1 => 'Yes',
    2 => 'No'
);

$config['InvoicePaymentMethods'] = array(
    1 => 'Cash', 2 => 'Checque', 3 => 'Card', 4 => 'Bank Transfer'
);


$config['LIST_PROD_NUM_RECORDS'] = 100;
$config['PRODUCT_THUMB_WIDTH']  = 150;
$config['PRODUCT_THUMB_HEIGHT'] = 150;
$config['PRODUCT_THUMB_PATH'] = WWW_ROOT . 'img/thumb/';
$config['PRODUCT_IMAGE_PATH'] = WWW_ROOT . 'img/upload/';

$config['SETTINGS'] = array(
    'VAT_PERCENTAGE' => 20,
    'CURRENCY' => 'GBP',
    'CURRENCY_ENTITY' => "&pound;",
    'ORDER_STATUS' => array(
        1 => 'Open',
        2 => 'Recieved',
        3 => 'Cancelled',
        4 => 'Delievred',
    )
);

$config['UserType'] = array(
	'superadmin' => 1,
	'admin' => 2,
	'branchadmin' => 3,
);

$config['PROJECT_BASE_PATH'] = array('URL' => dirname(dirname(dirname($_SERVER['PHP_SELF']))));
$config['FULL_BASE_URL'] = array('URL' => 'http://' . $_SERVER['HTTP_HOST'] . dirname(dirname(dirname($_SERVER['PHP_SELF']))));

$config['LOGIN_URL'] = array('URL' => $config['FULL_BASE_URL']['URL'] . '/users/login');
$config['SIGNUP_URL'] = array('URL' => $config['FULL_BASE_URL']['URL'] . '/users/signup');

// Product price calculation factor
$config['FACTOR_SMPRICE'] = '1.2';
$config['FACTOR_WHOLESALEPRICE'] = '1.75';

$config['DATE_FORMAT'] = array('Date' => '%d/%m/%Y');
$config['DATETIME_FORMAT'] = array('DateTime' => '%d/%m/%Y %H:%M %p');
$config['DB_DATE_TIME_FORMAT'] = array('DateTime' => '%Y-%m-%d %H:%i:%s');
$config['DB_DATETIME_FORMAT'] = array('DateTime' => 'Y-m-d H:i:s');
$config['DISPLAY_DATETIME'] = array('DateTime' => 'd-m-Y H:i:s');
$config['DISPLAY_DATE'] = array('Date' => 'd-m-Y');

$config['IMAGE_SIZES'] = array(
	'ProfilePic' => array('width' => 125, 'height' => 125),
	'GalleryImage' => array('width' => 320, 'height' => 200),
	'SenderAvatar' => array('width' => 40, 'height' => 40)
);

$config['CardTypes'] = array(
    'Visa' => 'Visa',
    'Mastercard' => 'Mastercard',
    'American Express' => 'American Express',
    'Discover' => 'Discover'
);

$config['TimeZones'] = array(
    'GMT -12:00' => '(GMT -12:00) Eniwetok, Kwajalein',
    'GMT -11:00' => '(GMT -11:00) Midway Island, Samoa',
    'GMT -10:00' => '(GMT -10:00) Hawaii',
    'GMT -9:00' => '(GMT -9:00) Alaska',
    'GMT -8:00' => '(GMT -8:00) Pacific Time (US & Canada)',
    'GMT -7:00' => '(GMT -7:00) Mountain Time (US & Canada)',
    'GMT -6:00' => '(GMT -6:00) Central Time (US & Canada), Mexico City',
    'GMT -5:00' => '(GMT -5:00) Eastern Time (US & Canada), Bogota, Lima',
    'GMT -4:00' => '(GMT -4:00) Atlantic Time (Canada), Caracas, La Paz',
    'GMT -3:30' => '(GMT -3:30) Newfoundland',
    'GMT -3:00' => '(GMT -3:00) Brazil, Buenos Aires, Georgetown',
    'GMT -2:00' => '(GMT -2:00) Mid-Atlantic',
    'GMT -1:00' => '(GMT -1:00 hour) Azores, Cape Verde Islands',
    'GMT +0:00' => '(GMT) Western Europe Time, London, Lisbon, Casablanca',
    'GMT +1:00' => '(GMT +1:00 hour) Brussels, Copenhagen, Madrid, Paris',
    'GMT +2:00' => '(GMT +2:00) Kaliningrad, South Africa',
    'GMT +3:00' => '(GMT +3:00) Baghdad, Riyadh, Moscow, St. Petersburg',
    'GMT +3:30' => '(GMT +3:30) Tehran',
    'GMT +4:00' => '(GMT +4:00) Abu Dhabi, Muscat, Baku, Tbilisi',
    'GMT +4:30' => '(GMT +4:30) Kabul',
    'GMT +5:00' => '(GMT +5:00) Ekaterinburg, Islamabad, Karachi, Tashkent',
    'GMT +5:30' => '(GMT +5:30) Bombay, Calcutta, Madras, New Delhi',
    'GMT +5:45' => '(GMT +5:45) Kathmandu',
    'GMT +6:00' => '(GMT +6:00) Almaty, Dhaka, Colombo',
    'GMT +7:00' => '(GMT +7:00) Bangkok, Hanoi, Jakarta',
    'GMT +8:00' => '(GMT +8:00) Beijing, Perth, Singapore, Hong Kong',
    'GMT +9:00' => '(GMT +9:00) Tokyo, Seoul, Osaka, Sapporo, Yakutsk',
    'GMT +9:30' => '(GMT +9:30) Adelaide, Darwin',
    'GMT +10:00' => '(GMT +10:00) Eastern Australia, Guam, Vladivostok',
    'GMT +11:00' => '(GMT +11:00) Magadan, Solomon Islands, New Caledonia',
    'GMT +12:00' => '(GMT +12:00) Auckland, Wellington, Fiji, Kamchatka'
);
