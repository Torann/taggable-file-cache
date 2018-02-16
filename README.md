# Taggable File Cache

[![Latest Stable Version](https://poser.pugx.org/torann/taggable-file-cache/v/stable.png)](https://packagist.org/packages/torann/taggable-file-cache) [![Total Downloads](https://poser.pugx.org/torann/taggable-file-cache/downloads.png)](https://packagist.org/packages/torann/taggable-file-cache)

A Laravel file [cache driver](https://laravel.com/docs/cache#adding-custom-cache-drivers) that supports tagging.

- [Taggable File Cache on Packagist](https://packagist.org/packages/torann/taggable-file-cache)
- [Taggable File Cache on GitHub](https://github.com/torann/taggable-file-cache)

## Installation

### Composer

From the command line run:

```
$ composer require torann/taggable-file-cache
```

### The Service Provider

Open up `config/app.php` and find the `providers` key.

```php
'providers' => [

    \Torann\TaggableFileCache\TaggableFileCacheServiceProvider::class,

]
```

### Configuration

In your `config\cache.php`, create a new store:

```
'tagged_file' => [
    'driver' => 'tagged_file',
    'path' => storage_path('framework/cache'),
]
```

**Optional Configuration**

- `queue`: accepts the string name of a queue to use during [garbage collection](#garbage-collection), will use the default queue if omitted.
- `separator`: defines the separator character or sequence to be used internally, this should be chosen to **never** collide with a key value (default `~#~`)

## Garbage Collection

To offset the work of cleaning up cache entries when a tag is flushed this task is added as a Job
and queued using laravel's inbuilt [queueing](https://laravel.com/docs/queues).

> **Note:** laravel's default queue driver is `sync` which will result in the job being executed synchronously,
it is strongly advised you use an alternate queue driver with appropriate workers to offset this work
if you wish to use this cache driver.

