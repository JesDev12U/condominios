<?php
set_include_path(
  get_include_path() .
    PATH_SEPARATOR . realpath(__DIR__ . '/..') . '/_model' .
    PATH_SEPARATOR . realpath(__DIR__ . '/..') . '/_controller' .
    PATH_SEPARATOR . realpath(__DIR__ . '/..') . '/classes'
);

define("SITE_URL", "http://localhost/condominios/");
define("DB_HOST", "127.0.0.1");
define("DB_BASE", "condominios");
define("DB_USR", "root");
define("DB_PASS", "Str0ngPassword!");
