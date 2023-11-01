<?php

use Tests\TestCase;
use App\Helpers\FakeUsername;

class FakeUsernameTest extends TestCase
{
	/** @test */
	public function it_generates_string()
	{
		$username = FakeUsername::generate();
		
		$this->assertIsString($username);
	}

	/** @test */
	public function it_has_default_length_between_5_and_32()
	{
		$username = FakeUsername::generate();
		$length = strlen($username);

		$this->assertGreaterThanOrEqual(5, $length);
		$this->assertLessThanOrEqual(32, $length);
	}

	/** @test */
	public function it_respects_custom_length()
	{
		$username = FakeUsername::generate(10, 15);
		$length = strlen($username);

		$this->assertGreaterThanOrEqual(10, $length);
		$this->assertLessThanOrEqual(15, $length);
	}

	/** @test */
	public function it_only_contains_valid_characters()
	{
		$username = FakeUsername::generate();
		$pattern = '/^[a-zA-Z0-9_]+$/';

		$this->assertMatchesRegularExpression($pattern, $username);
	}
}
