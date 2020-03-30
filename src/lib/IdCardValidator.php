<?php


namespace ErMao\utils\lib;


use Exception;

class IdCardValidator
{
	/**
	 * @var \ErMao\utils\lib\IdCardValidator
	 */
	protected static $instance = null;
	
	/**
	 * @var string 待验证数据
	 */
	protected $checkData = "";
	
	/**
	 * @var array 加权因子
	 */
	private static $weightingFactor = [
		1 => 7,
		2 => 9,
		3 => 10,
		4 => 5,
		5 => 8,
		6 => 4,
		7 => 2,
		8 => 1,
		9 => 6,
		10 => 3,
	];
	
	/**
	 * @var array 校验数据
	 */
	private static $checkFactor = [
		1,
		0,
		10,
		9,
		8,
		7,
		6,
		5,
		4,
		3,
		2
	];
	
	/**
	 * 构造函数
	 * IdCardValidator constructor.
	 */
	protected function __construct()
	{
	}
	
	/**
	 * 获取身份校验实例
	 * @param string $checkData     待验证数据
	 *
	 * @return \ErMao\utils\lib\IdCardValidator
	 */
	public static function getInstance(string $checkData):IdCardValidator{
		if(self::$instance == null){
			self::$instance = new self();
		}
		self::$instance->checkData = strtolower($checkData);
		return self::$instance;
	}
	
	/**
	 * 是否抛出异常
	 *
	 * @param bool $isThrowException
	 *
	 * @throws \Exception
	 * @return bool
	 */
	public function validate(bool $isThrowException = false):bool {
		// 校验数据长度
		$regex = "/^[1-9][0-9]{16}[0-9|x]$/i";
		if(!preg_match_all($regex,$this->checkData)){
			return $this->throwException("身份号码格式错误!检查身份号码长度以及字符！",$isThrowException);
		}
		$sum = 0;
		$arr = str_split($this->checkData);
		foreach ($arr as $key=>$val){
			$index = $key + 1;
			$mod = $index % 10 == 0 ? 10 : $index % 10;
			$val = $val == "x" ? 10 : $val ;
			$sum += self::$weightingFactor[$mod] * $val;
		}
		$mod = $sum % 11;
		// 最后一位数
		$last = $arr[sizeof($arr) - 1];
		// 获取检验码
		return $last == self::$checkFactor[$mod] ? true : false;
	}
	
	/**
	 * 是否抛出异常
	 * @param string $errorMsg              异常信息
	 * @param bool   $isThrowException      是否报出异常？true -> 抛出异常； false -> 不抛出异常；直接返回False
	 *
	 * @throws \Exception
	 * @return bool
	 */
	private function throwException(string $errorMsg,bool $isThrowException):bool {
		if($isThrowException){
			throw new Exception($errorMsg);
		}else{
			return false;
		}
	}
}