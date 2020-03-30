<?php

use ErMao\utils\lib\IdCardValidator;

if(!function_exists("check_mobile")){
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
}

if(!function_exists("check_id_card")){
	/**
	 * 验证身份证号码是否正确
	 *
	 * @param string $checkData             待验证数据
	 * @param bool   $isThrowException      是否抛出异常
	 *
	 * @throws \Exception                   身份证验证失败异常！
	 * @return bool                         返回值
	 */
	function check_id_card(string $checkData,$isThrowException = false):bool {
		return IdCardValidator::getInstance($checkData)->validate($isThrowException);
	}
}