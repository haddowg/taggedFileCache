<?php

use haddowg\Cache\TaggableFileStore;
use haddowg\Cache\TaggedFileCache;
use haddowg\Cache\FileTagSet;

class TaggedFileCacheTest extends BaseTest
{

	public function testItemKeyCallsTaggedItemKey(){

		$store = new TaggableFileStore($this->app['files'], storage_path('framework/cache'),[]);
		$cache = new TaggedFileCache($store, new FileTagSet($store, ['foobar']));

		$mock = Mockery::mock($cache);

		$mock->shouldReceive('taggedItemKey')->with('test');

		$mock->itemKey('test');
	}

	public function testItemKeyReturnsTaggedItemKey(){

		$store = new TaggableFileStore($this->app['files'], storage_path('framework/cache'),[]);
		$cache = new TaggedFileCache($store, new FileTagSet($store, ['foobar']));

		$mock = Mockery::mock($cache);

		$mock->shouldReceive('taggedItemKey')->with('test')->andReturn('boofar');

		$this->assertEquals('boofar',$mock->itemKey('test'));
	}

	public function testTaggedItemKeyGeneratesCorrectlyNamespacedKey(){

		$store = new TaggableFileStore($this->app['files'], storage_path('framework/cache'),[]);

        \Cache::forever('cache_tags~#~foobar','56dc3ce3ed37d104639966');
		$cache = new TaggedFileCache($store, new FileTagSet($store, ['foobar']));


		$this->assertEquals('56dc3ce3ed37d104639966~#~test',$cache->taggedItemKey('test'));

        \Cache::forever('cache_tags~#~boofar','56dbfe2ea297d983644626');
		$cache = new TaggedFileCache($store, new FileTagSet($store, ['boofar']));
		$this->assertEquals('56dbfe2ea297d983644626~#~arg',$cache->taggedItemKey('arg'));
	}

}