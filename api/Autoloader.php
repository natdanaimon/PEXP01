<?php

function _require_all($dir, $depth = 0) {
    // require all php files
    $scan = glob("$dir/*");
    foreach ($scan as $path) {
        if (preg_match('/\.php$/', $path)) {
            require_once $path;
        } elseif (is_dir($path)) {
            $this->_require_all($path, $depth + 1);
        }
    }
}

_require_all(__DIR__ . '/Common');
_require_all(__DIR__ . '/Service');
