<?php


namespace YiChUtils;


class ArrayUtils
{
	/**
	 * 递归获取数组值
	 * @param string $key 支持 "aa.bb"形式获取数值值;
	 * @param array  $arr
	 * @param string $defaultVal
	 *
	 * @return mixed|string
	 */
	public static function getArrayValue(string $key,array $arr,string $defaultVal = ""){
		$keyArr = explode(".",$key);
		// 去除空值
		$keyArr = array_filter($keyArr);
		// 直接返回值
		if(sizeof($arr) == 0){
			return $defaultVal;
		}
		// 遍历取值
		while (($keyName = array_shift($keyArr)) != null){
			if(array_key_exists($keyName,$arr)){
				
				if(is_array($arr[$keyName]) && sizeof($arr[$keyName]) > 0 && sizeof($keyArr) > 0){
					return self::getArrayValue(implode(".",$keyArr),$arr[$keyName]);
				}else{
					return $arr[$keyName];
				}
			}else{
				return $defaultVal;
			}
		}
	}
	
}