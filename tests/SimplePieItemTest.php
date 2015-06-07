<?php

use ArandiLopez\Feed\Factories\FeedFactory;
use Mockery as m;

class SimplePieItemTest extends PHPUnit_Framework_TestCase {
    protected $feeder;

    public function setUp()
    {
        parent::setUp();
        $feedFactory = new FeedFactory(['cache.enabled' => false]);
        $this->feeder = $feedFactory->make('http://arandilopez.me/feed.xml');
    }

    public function tearDown()
    {
        parent::tearDown();
        m::close();
    }

    public function testFeedAdapterWithItemsData()
    {
        $items = $this->feeder->items;
        $this->assertContainsOnlyInstancesOf('ArandiLopez\Feed\Adapters\SimplePieItemAdapter', $items, 'It has other instances');

        $this->assertCount(3, $items);

        return $items;
    }

    /**
     * @depends testFeedAdapterWithItemsData
     */
    public function testItemsData($items)
    {
        $item = $items[0];
        $this->assertEquals('Construye Un Blog Que Empodere Tu Carrera', $item->title);
        $this->assertEquals('http://arandilopez.me/article/construye-un-blog-que-empodere-tu-carrera/', $item->permalink);

        return $item;
    }

    /**
     * @depends testItemsData
     */
    public function testItemsAuthorData($item)
    {
        $author = $item->author;

        $this->assertEquals('Arandi Lopez', $author->name);
        $this->assertEquals('arandilopez.93@gmail.com', $author->email);
    }
}
