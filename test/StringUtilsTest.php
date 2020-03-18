<?php

namespace YiChUtilsTest;

use PHPUnit\Framework\TestCase;
use YiChUtils\StringUtils;

class StringUtilsTest extends TestCase
{
	
	public function testRandomString()
	{
		$this->assertTrue(is_string(StringUtils::randomString(2222)));
		
		$this->assertTrue(check_mobile('18981768499'));
	}
}
