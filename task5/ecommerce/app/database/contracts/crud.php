<?php 
namespace app\database\contracts;
interface crud {
    function create();
    function read();
    function update();
    function delete();
}