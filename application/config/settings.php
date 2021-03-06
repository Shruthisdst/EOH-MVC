<?php

// db table names
define('DEFAULT_LETTER', 'A');
define('METADATA_TABLE', 'encyclopaedia');

// search settings
define('SEARCH_OPERAND', 'AND');

// For use by word-of-the-day logic
define('TOTAL_WORDS', 3786);

// user settings (login and registration)
define('SALT', 'eoh');
define('REQUIRE_EMAIL_VALIDATION', True);//Set these values to True only
define('REQUIRE_RESET_PASSWORD', True);//if outbound mails can be sent from the server

// mailer settings
define('SERVICE_EMAIL', 'webadmin@uni-mysore.ac.in');
define('SERVICE_NAME', 'University of Mysore');


?>
