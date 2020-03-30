<?php
namespace ErMao\utils;

class StringUtils
{
	/**
	 * 生成随机字符串
	 *
	 * @param int  $length
	 * @param bool $isContainsLetter
	 * @param bool $isContainsUpper
	 * @param bool $isContainsSymbols
	 *
	 * @return string
	 */
	public static function randomString($length,$isContainsLetter = true,$isContainsUpper=false,$isContainsSymbols=false):string {
		$numbers        = "123456789";
		$lettersLower   = "qwertyuipasdfghjkzxcvbnm";
		$lettersUpper   = "QWERTYUPASDFGHJKZXCVBNM";
		$symbols   = "!@#$%^&*_";
		
		$str = "";
		// 判断需要组装的那些
		$letterArr = [];
		array_push($letterArr,$numbers);
		// 是否包含字母
		if($isContainsLetter){
			array_push($letterArr,$lettersLower);
		}
		// 是否包含大写字母
		if($isContainsUpper){
			array_push($letterArr,$lettersUpper);
		}
		// 是否包含符号
		if($isContainsSymbols){
			array_push($letterArr,$symbols);
		}
		
		// 所有标识符字符长度
		$totalLen = mb_strlen(implode("",$letterArr));
		// 尽量保证字符串不重复
		if($length <= $totalLen && count($letterArr) == 1){
			$str = mb_substr(str_shuffle(implode("",$letterArr)),0,$length);
		}else{
			while (mb_strlen($str) < $length){
				// 随机选取字符串
				$arrIndex = rand(0,count($letterArr)-1);
				$strIndex = rand(0,mb_strlen($letterArr[$arrIndex])-1);
				$randomLetter = $letterArr[$arrIndex][$strIndex];
				// 查找生成字符是否已经出现过
				$result = strstr($str,$randomLetter)? true:false;
				if($result){
					// 目标长度大于或等于字符串总长度时，则允许重复
					if($length >= $totalLen){
						$str.=$randomLetter;
					}
				}else{
					$str.=$randomLetter;
				}
			}
		}
		return $str;
	}
	
	/**
	 * 驼峰命名转下划线命名
	 * @param string $camelCaps
	 * @param string $separator
	 *
	 * @return string
	 */
	public static function uncamelize(string $camelCaps,string $separator='_'):string
	{
		return strtolower(preg_replace('/([a-z])([A-Z])/', "$1" . $separator . "$2", $camelCaps));
	}
	
	/**
	 * 字符串脱敏化处理
	 * @param string $string        源字符串
	 * @param int    $mosaicLen     脱敏化长度
	 * @param string $type          脱敏方式，right 右侧填充脱敏字符表示；left 左侧填充脱敏字符表示，center 居中填充脱敏字符表示，
	 * @param string $mosaic        脱敏字符
	 *
	 * @return string
	 */
	public static function mosaicString(string $string,int $mosaicLen = -1,string $type = "center",string $mosaic='*'):string {
		$returnStr = "";
		if(empty($string)){
			return "";
		}
		// 脱敏字符串长度
		$length = mb_strlen($string);
		// 说明没传值，或所传值无效
		if($mosaicLen < 0){
			// 自动计算马赛克长度
			switch ($length){
				case 1:
					$mosaicLen = 0;
					break;
				case 2:
					$mosaicLen = 1;
					break;
				case 3:
					$mosaicLen = 2;
					break;
				default:
					// 说明未传参
					$mosaicLen = ceil($length/3);
					break;
			}
		}
		// 自动计算截取字符串长度
		$saveLen = (($length === 1 && $mosaicLen > 0 )|| $length <= $mosaicLen ) ? 0 : $length - $mosaicLen;
		
		// 如果保留字符串字符串长度为 ：0
		if($saveLen == 0 || ($length === 1 && $saveLen > 0)){
			return str_pad("",$length,$mosaic);
		}
		// 特殊情况 2：字符串长度等于2，且保留长度大于0；
		if($length === 2 && $saveLen > 0){
			$returnStr = "";
			// 这种情况需要分做填充还是有填充
			switch($type){
				case "right":
					$returnStr = mb_substr($string,0,$saveLen).str_pad("",$mosaicLen,$mosaic,STR_PAD_RIGHT);
					break;
				default:
					$returnStr = str_pad("",$mosaicLen,$mosaic,STR_PAD_LEFT).mb_substr($string,-1,$saveLen);
					break;
			}
			return $returnStr;
		}
		
		switch($type){
			case "right":
				$returnStr = mb_substr($string,0,$length-$mosaicLen,"utf8").str_pad("",$mosaicLen,$mosaic);
				break;
			case "left":
				$returnStr = str_pad("",$mosaicLen,$mosaic).mb_substr($string,$mosaicLen,$length - $mosaicLen,"utf8");
				break;
			// 默认居中填充
			default:
				$mid = ceil(($length -1 ) / 2);         // 中间索引位置
				$offset = ceil( $mosaicLen / 2);        // 偏移长度
				$leftLen = $length % 2 == 1 ? $mid - $offset + 1 : $mid - $offset ; // 左侧保留字符串
				$len = $length - $leftLen - $mosaicLen;  // 剩余字符串长度
				$rightIndex = $length % 2 == 1 ? $mid + ($mosaicLen - $offset) + 1 : $mid + ($mosaicLen - $offset) ;
				$returnStr = mb_substr($string,0,$leftLen,"utf8").str_pad("",$mosaicLen,$mosaic).mb_substr($string,$rightIndex,$len,"utf8");
				break;
			
		}
		return $returnStr;
	}
	
	/**
	 * 身份证号码验证规则
	 * @param string $idCard
	 *
	 * @return bool
	 */
	public static function checkIdCard(string $idCard):bool {
	
	}
}