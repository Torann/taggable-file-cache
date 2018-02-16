<?php

namespace Torann\TaggableFileCache;

use Illuminate\Cache\TaggedCache;

class TaggedFileCache extends TaggedCache
{
    /**
     * {@inheritdoc}
     */
    protected function itemKey($key)
    {
        return $this->taggedItemKey($key);
    }

    /**
     * Get a fully qualified key for a tagged item.
     *
     * @param  string $key
     *
     * @return string
     */
    public function taggedItemKey($key)
    {
        return $this->tags->getNamespace() . $this->store->separator . $key;
    }
}
