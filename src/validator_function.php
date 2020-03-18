<?php
/**
 * 验证手机号码是否正确
 * @param string $value 待验证数据
 *
 * @return bool
 */
function check_mobile(string $value):bool{
	$regex = "/^1[3-9][0-9]{9}$/";
	return preg_match_all($regex,$value)?true:false;
}