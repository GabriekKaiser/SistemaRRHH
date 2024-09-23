<?php

const VALID_USERNAME_PATTERN =  '/^[a-zA-Z0-9_-]{3,20}$/';
const INVALID_USERNAME_PATTERN = '/^(?!^[a-zA-Z0-9_-]{3,20}$).+$/';

function isValidUsername($username)
{
    return boolval(preg_match(VALID_USERNAME_PATTERN, $username));
}
