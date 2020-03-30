<?php

namespace ErMaoUtilsTest\utils;

use ErMao\utils\constant\HttpHeader;
use PHPUnit\Framework\TestCase;

class HttpHeaderTest extends TestCase
{
	public function testHttpHeaderConstant(){
		$header1 = HttpHeader::ACCEPT;
		echo "<pre>";
		print_r($header1);
		echo "</pre>";
		$this->assertTrue(strtolower($header1) == "accept","获取正常");
	}
	
}
