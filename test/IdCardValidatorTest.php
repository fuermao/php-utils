<?php

namespace ErMaoUtilsTest\utils;

use ErMao\utils\lib\IdCardValidator;
use PHPUnit\Framework\TestCase;

class IdCardValidatorTest extends TestCase
{
	/**
	 * @throws \Exception
	 */
	public function testValidate()
	{
		$validator = IdCardValidator::getInstance("a1130319560102717X");
		$this->assertTrue($validator->validate(),"非有效身份证号码！");
	}
}
