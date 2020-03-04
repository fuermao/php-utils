<?php

namespace YiChUtilsTest;

use PHPUnit\Framework\TestCase;
use YiChUtils\lib\ArraysToObject;

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
		
		$code = ArraysToObject::getInstance(ResponseEntity::class,$dataSrc)->exchangeToObject()->invokeMethod("getCode");
		$msg = ArraysToObject::getInstance(ResponseEntity::class,$dataSrc)->exchangeToObject()->invokeMethod("getMsg");
		$data = ArraysToObject::getInstance(ResponseEntity::class,$dataSrc)->exchangeToObject()->invokeMethod("getData");
		
		$this->assertEquals(200,$code,"获取code属性失败！");
		$this->assertEquals("hello",$msg,"获取msg属性失败！");
		print_r($data);
		$this->assertTrue($data == $arr,"获取data属性失败！");
		
	}
}

class ResponseEntity{
	private int $code;
	
	private string $msg;
	
	private array $data;
	
	/**
	 * ResponseEntity constructor.
	 *
	 * @param int    $code
	 * @param string $msg
	 * @param array  $data
	 */
	public function __construct(int $code, string $msg, array $data)
	{
		$this->code = $code;
		$this->msg = $msg;
		$this->data = $data;
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
