<?php

namespace ErMaoUtilsTest\utils;

use ErMao\utils\ArrayUtils;
use PHPUnit\Framework\TestCase;

class ArrayUtilsTest extends TestCase
{
	
	public function testGetArrayValue()
	{
		$arr = [
			"aa"=>1,
			"bb"=>[
				"cc" => true,
				"dd" => [
					"e",
					"f"
				]
			],
		];
		$this->assertEquals(1,ArrayUtils::getArrayValue("aa",$arr),"获取失败");
		$this->assertEquals(true,ArrayUtils::getArrayValue("aa.bb.cc",$arr),"获取失败");
		$this->assertTrue($this->arrayEquals(["e","f"],ArrayUtils::getArrayValue("bb.dd",$arr)),"获取失败");
	}
	
	private function arrayEquals(array $expected,array $actual):bool {
		if(sizeof($expected) != sizeof($actual)){
			return false;
		}
		// 获取键值
		$diff = array_diff_assoc($expected,$actual);
		return sizeof($diff) > 0 ? false:true;
	}
}
