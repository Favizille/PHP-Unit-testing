<?php

use PHPUnit\Framework\TestCase;
use App\Support\Collection;
class CollectionTest extends TestCase
{
    protected $collection; 

    public function setUp():void
    {
        $this->collection = new Collection;
    }

    /** @test */
    public function empty_instantiated_collection_returns_no_items()
    {
        $this->assertEmpty($this->collection->get());
    }

    /** @test */
    public function count_is_correct_for_items_passed_in(){
        $collection = new Collection([
            "one", "two", "three"
        ]);

        $this->assertEquals(3, $collection->count());
    }

    public function items_returned_match_items_passed_in(){
        $collection = new Collection([
            "one", "two"
        ]);

        $this->assertCount(2, $collection->get());
        $this->assertEquals($collection->get()[0], 'one');
        $this->assertEquals($collection->get()[1], 'two');
    }

    /** @test */
    public function collection_is_instance_of_iterator_aggregate(){
        $this->assertInstanceOf(IteratorAggregate::class, $this->collection);
    }

    /** @test */
    public function collection_can_be_iterated(){
        $collection = new Collection([
            "one", "two", "three"
        ]);

        $items =[];

        foreach ($collection as $item){
            $items[] = $item;
        }

        $this->assertCount(3, $items);
        $this->assertInstanceOf(ArrayIterator::class, $collection->getIterator());
    }

    /**@test */
    public function collection_can_be_merged_with_another_collection(){
        $collection1 = new Collection(['one', "two"]);
        $collection2 = new Collection (['three', 'four', 'five']);

        $newCollection = $collection1->merge($collection2);

        $this->assertCount(5, $newCollection->get());
        $this->assertEquals(5, $newCollection->count());
    }
}