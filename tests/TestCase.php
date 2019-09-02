<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use \MarvinRabe\LaravelGraphQLTest\TestGraphQL;
    use DatabaseTransactions;

    /**
     * @var \Faker\Generator
     */
    protected $faker;
    
    public function setUp(): void
    {
        $this->faker = \Faker\Factory::create();
        parent::setUp();
    }

    public function tearDown(): void
    {
        parent::tearDown();
    }
}
