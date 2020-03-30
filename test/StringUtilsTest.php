<?php

namespace ErMaoUtilsTest\utils;

use ErMao\utils\StringUtils;
use PHPUnit\Framework\TestCase;

class StringUtilsTest extends TestCase
{
	/**
	 * 测试随机字符串
	 */
	public function testRandomString()
	{
		$randomStr = StringUtils::randomString(4);
		$this->assertTrue(is_string($randomStr));
		echo $randomStr;
		echo PHP_EOL;
		
	}
	
	/**
	 * 测试校验手机号码
	 */
	public function testCheckMobile(){
		$checkMobileRes = check_mobile("13888888888");
		var_dump($checkMobileRes);
		$this->assertTrue($checkMobileRes);
	}
	
	/**
	 * 测试用户脱敏处理
	 */
	public function testUserNameMosaic(){
		// 用户信息脱敏处理
		$userName1 = "张三";
		$userName2 = "张三丰";
		$userName3 = "张三丰帅";
		$userName4 = "张三丰帅气";
		
		// 手机号码脱敏处理
		$mobile = "13888888888";
		$mobile1 = mobile_mosaic($mobile);
		
		$userName11 = user_name_mosaic($userName1);
		$userName21 = user_name_mosaic($userName2);
		$userName31 = user_name_mosaic($userName3);
		$userName41 = user_name_mosaic($userName4);
		
		print_r(sprintf("脱敏前字符串：%s；脱敏后字符串：%s",$userName1,$userName11));
		echo PHP_EOL;
		print_r(sprintf("脱敏前字符串：%s；脱敏后字符串：%s",$userName2,$userName21));
		echo PHP_EOL;
		print_r(sprintf("脱敏前字符串：%s；脱敏后字符串：%s",$userName3,$userName31));
		echo PHP_EOL;
		print_r(sprintf("脱敏前字符串：%s；脱敏后字符串：%s",$userName4,$userName41));
		echo PHP_EOL;
		
		print_r(sprintf("脱敏前字符串：%s；脱敏后字符串：%s",$mobile,$mobile1));
		echo PHP_EOL;
		
		$this->assertTrue(user_name_mosaic("张三") == "张*","脱敏化失败");
	}
}
