<?php
    if( ! function_exists('url') ) {
        function url(string $path = '') {
            return CONFIG['url']."{$path}";
        }
    }
?>