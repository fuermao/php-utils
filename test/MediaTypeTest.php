<?php

namespace ErMaoUtilsTest\utils;

use ErMao\utils\constant\MediaType;
use PHPUnit\Framework\TestCase;

class MediaTypeTest extends TestCase
{
	public function testMediaTypeConstant():void {
		$mediaTypeStr = MediaType::APPLICATION_JSON_VALUE;
		echo "<pre>";
		print_r($mediaTypeStr);
		echo "</pre>";
		$this->assertTrue(strtolower($mediaTypeStr) == "application/json","获取正常");
	}
}
