<?php
/**
 * 增删查改接口
 */

namespace CodeLib\i;

interface iCURD {

    function create($data);
    function update($data);
    function read($index);
    function delete($index);
}