<?php
function old($input,$default=null){
    return $_REQUEST[$input] ?? $default;
}

