<?php

use ArandiLopez\Feed\Factories\FeedFactory;
use Mockery as m;

class FeedFactoryWithMultipleURLTest extends PHPUnit_Framework_TestCase
{

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
        $adapter = $this->feedFactory->make(['http://arandilopez.me/feed.xml', 'http://www.theverge.com/rss/index.xml']);

        $this->assertNotNull($adapter);
        $this->assertInstanceOf('ArandiLopez\Feed\Factories\FeedFactory', $this->feedFactory);
        $this->assertInstanceOf('ArandiLopez\Feed\Adapters\SimplePieAdapter', $adapter);

        return $adapter;
    }

    /**
     * @depends testFeedFactoryMakeByUrl
     */
    public function testFeedFactoryFeedReturnsSimplePieItemAdapters($feeder)
    {
        $items = $feeder->getItems();
        $this->assertContainsOnlyInstancesOf('ArandiLopez\Feed\Adapters\SimplePieItemAdapter', $items, 'It has other instances');

        // 10 from the verge + 3 from my blog = 13
        $this->assertCount(13, $items);
    }

    /**
     * @depends testFeedFactoryMakeByUrl
     */
    public function testFeederToArrayMethod($feeder)
    {
        $arry = $feeder->toArray();
        $this->assertCount(13, $arry);

        return $arry;
    }

    /**
     * @depends testFeederToArrayMethod
     */
    public function testItemDataInArray($items)
    {
        $item = $items[0];
        $this->assertNotNull($item['authors']);
        $this->assertNotNull($item['date']);
        $this->assertNotNull($item['description']);
        $this->assertNotNull($item['content']);
        $this->assertNotNull($item['permalink']);

        return $item['authors'];
    }

    /**
     * @depends testItemDataInArray
     */
    public function testAuthorsDataInArray($authors)
    {
        $this->assertCount(1, $authors);
        $author = $authors[0];
        $this->assertNotNull($author['name'], 'Name is null');
    }
}
