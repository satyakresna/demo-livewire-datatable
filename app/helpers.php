<?php

if (!function_exists('users_type')) {
    function users_type()
    {
        return [
            'admin' => 'admin',
            'employee' => 'employee'
        ];
    }
}
