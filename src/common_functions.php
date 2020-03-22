<?php

use YiChUtils\StringUtils;

/**
 * 手机号脱敏处理
 * @param $value
 *
 * @return string
 */
function mobile_mosaic($value) : string {
	return StringUtils::mosaicString($value,3,"center");
}

/**
 * 用户真实姓名脱敏化处理
 * @param $value
 *
 * @return string
 */
function user_name_mosaic($value):string {
	switch (mb_strlen($value)) {
		case 2:
			$len = 1;
			$type = "right";
			break;
		case 3:
			$len = 1;
			$type = "center";
			break;
		default:
			$type = "center";
			$len = -1;
			break;
	}
	return StringUtils::mosaicString($value, $len, $type);
}