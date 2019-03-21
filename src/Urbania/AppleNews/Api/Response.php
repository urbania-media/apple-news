<?php

namespace Urbania\AppleNews\Api;

use Closure;
use Psr\Http\Message\ResponseInterface;
use Illuminate\Contracts\Support\Arrayable;
use Urbania\AppleNews\Api\Objects\Error;
use Urbania\AppleNews\Support\BaseObject;
use Urbania\AppleNews\Support\BaseObjectIterator;

class Response extends BaseObject
{
    protected $response;
    protected $object;
    protected $error;

    public function __construct(ResponseInterface $response)
    {
        $this->response = $response;

        if ($this->isError()) {
            $this->setErrorType(Error::class);
        }
    }

    public function getPayload()
    {
        return json_decode((string)$this->response->getBody(), true);
    }

    public function getData()
    {
        $payload = $this->getPayload();
        return $payload['data'] ?? null;
    }

    public function getErrors()
    {
        $payload = $this->getPayload();
        return $payload['errors'] ?? [];
    }

    public function getResponse()
    {
        return $this->response;
    }

    public function getObject()
    {
        return $this->object;
    }

    public function getNextPageToken()
    {
        $payload = $this->getPayload();
        $meta = $payload['meta'] ?? null;
        if (!is_null($meta)) {
            return $meta['nextPageToken'] ?? null;
        }
        return null;
    }

    public function isError()
    {
        return $this->response->getStatusCode() >= 400;
    }

    public function setErrorType($type)
    {
        $data = $this->getErrors();
        if ($type instanceof Closure) {
            $this->error = $type($data);
        } else {
            $this->error = array_map(function ($item) use ($type) {
                return new $type($item);
            }, $data);
        }
        return $this;
    }

    public function setObjectType($type, $isMultipleItems = false)
    {
        if ($this->isError()) {
            return $this;
        }

        $data = $this->getData();
        if ($type instanceof Closure) {
            $this->object = $type($data);
        } else {
            $this->object = $isMultipleItems ? array_map(function ($item) use ($type) {
                return new $type($item);
            }, $data) : new $type($data);
        }

        return $this;
    }

    /**
     * Get the object iterator
     * @return \Iterator
     */
    public function getIterator()
    {
        return $this->object->getIterator();
    }

    /**
     * Get a property value
     * @param  string $name The name of the property
     * @return mixed|null
     */
    protected function propertyGet($name)
    {
        return $this->object->{$name};
    }

    /**
     * Set a property value
     * @param  string $name The name of the property
     * @param  mixed $value The new value of the property
     * @return $this
     */
    protected function propertySet($name, $value)
    {
        $this->object->{$name} = $value;
        return $this;
    }

    /**
     * Unset a property value
     * @param  string $name The name of the property
     * @return mixed|null
     */
    protected function propertyUnset($name)
    {
        unset($this->object->{$name});
    }

    /**
     * Check if a property exists
     * @param  string $name The name of the property
     * @return mixed|null
     */
    protected function propertyExists($name)
    {
        return isset($this->object->{$name});
    }

    /**
     * Call method on the object
     * @param  string $name      The name of the method
     * @param  array  $arguments The arguments
     * @return mixed
     */
    public function __call(string $name, array $arguments)
    {
        return call_user_func_array([$this->object, $name], $arguments);
    }

    /**
     * Get the object as array
     * @return array
     */
    public function toArray()
    {
        if (!is_null($this->object)) {
            return $this->object instanceof Arrayable ? $this->object->toArray() : $this->object;
        }
        return $this->getData();
    }
}
