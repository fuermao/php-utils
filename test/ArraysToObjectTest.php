<?php

namespace ErMaoUtilsTest\utils;


use ErMao\utils\lib\ArraysToObject;
use PHPUnit\Framework\TestCase;

class ArraysToObjectTest extends TestCase
{
	
	public function testInvokeMethod()
	{
		$arr = [
			"aa" => "bb"
		];
		$arr1 = [
			"aa" => "cc"
		];
		
		$dataSrc = [
			"code"  => 200,
			"msg"   => "hello",
			"data"  => $arr
		];
		
		$instance = ArraysToObject::getInstance(ResponseEntity::class,$dataSrc)->exchangeToObject();
		
		// 获取属性值
		$code = $instance->invokeMethod("getCode");
		$msg = $instance->invokeMethod("getMsg");
		$data = $instance->invokeMethod("getData");
		
		print_r($data);
		$this->assertEquals(200,$code,"获取code属性失败！");
		$this->assertEquals("hello",$msg,"获取msg属性失败！");
		
		$this->assertTrue($data == $arr,"获取data属性失败！");
		
	}
}

class ResponseEntity{
	private $code;
	
	private $msg;
	
	private $data;
	
	/**
	 * ResponseEntity constructor.
	 *
	 * @param int    $code
	 * @param string $msg
	 * @param array  $data
	 */
	public function __construct(int $code, string $msg, array $data)
	{
		$this->code = (int)$code;
		$this->msg = (string)$msg;
		$this->data = (array)$data;
	}
	
	
	/**
	 * @return int
	 */
	public function getCode(): int
	{
		return $this->code;
	}
	
	/**
	 * @param int $code
	 */
	public function setCode(int $code): void
	{
		$this->code = $code;
	}
	
	/**
	 * @return string
	 */
	public function getMsg(): string
	{
		return $this->msg;
	}
	
	/**
	 * @param string $msg
	 */
	public function setMsg(string $msg): void
	{
		$this->msg = $msg;
	}
	
	/**
	 * @return array
	 */
	public function getData(): array
	{
		return $this->data;
	}
	
	/**
	 * @param array $data
	 */
	public function setData(array $data): void
	{
		$this->data = $data;
	}
	
	
}
