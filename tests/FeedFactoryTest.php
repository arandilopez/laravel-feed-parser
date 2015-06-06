<?php

use ArandiLopez\Feed\Factories\FeedFactory;
use Mockery as m;

class FeedFactoryTest extends PHPUnit_Framework_TestCase {

    protected $feedFactory;

    public function setUp()
    {
        parent::setUp();

        $this->feedFactory = new FeedFactory(['cache.enabled' => false]);
    }

    public function tearDown()
    {
        parent::tearDown();
        m::close();
    }

    public function testFeedFactoryMakeByUrl()
    {
        $adapter = $this->feedFactory->make('http://arandilopez.me/feed.xml');

        $this->assertNotNull($adapter);
        $this->assertInstanceOf('ArandiLopez\Feed\Factories\FeedFactory', $this->feedFactory);

        return $adapter;
    }

    /**
     * @depends testFeedFactoryMakeByUrl
     */
    public function testFeedAdapter($adapter)
    {
        $this->assertInstanceOf('ArandiLopez\Feed\Adapters\SimplePieAdapter', $adapter);
        $this->assertEquals('Arandi Lopez', $adapter->title);
        $this->assertEquals('http://arandilopez.me/', $adapter->permalink);
    }

    /**
     * @depends testFeedFactoryMakeByUrl
     */
    public function testFeedAdapterWithAuthorData($adapter)
    {
        $this->assertEquals('Arandi Lopez', $adapter->author->name);
        $this->assertEquals('arandilopez.93@gmail.com', $adapter->author->email);
    }
}
