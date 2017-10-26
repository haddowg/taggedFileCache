<?php

use haddowg\Cache\TaggableFileStore;

class TaggableFileCacheServiceProviderTest extends BaseTest
{

	public function testCacheIsTaggableFileCacheWhenUsing(){

		$this->assertInstanceOf(TaggableFileStore::class,app('cache')->store()->getStore());
	}

}