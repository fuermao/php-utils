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
	
	/**
	 * 数组合并，支持多维数组操作
	 * @param array $target 需要合并的目标数组
	 * @param array $source 合并的数据源
	 *
	 * @return array
	 */
	public static function assignmentParams(array $target,array $source){
		// 如果目标数组为空，则
		if(empty($target)){
			return $source;
		}
		// 如果数据源为空，则直接返回目标数组
		elseif (empty($source)){
			return $target;
		}
		// 两个数组都不为空的情况
		else{
			foreach ($source as $key=>$value){
				// 如果数据源【键】在目标数据组存在
				if(array_key_exists($key,$target)){
					if(is_array($value) && !empty($value)){
						$target[$key] = self::assignmentParams($target[$key],$value);
					}
					// 如果value是一个布尔类型
					elseif (is_bool($value) || is_numeric($value) || (!empty($value) && $value != null)){
						$target[$key] = $value;
					}
				}else{
					$target[$key] = $value;
				}
			}
			return $target;
		}
	}
}