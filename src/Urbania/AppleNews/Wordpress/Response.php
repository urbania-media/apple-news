<?php

namespace Urbania\AppleNews\Wordpress;

use Closure;
use ArrayIterator;
use Psr\Http\Message\ResponseInterface;
use Illuminate\Contracts\Support\Arrayable;
use Urbania\AppleNews\Support\BaseObject;

class Response extends BaseObject
{
    protected $response;
    protected $request;
    protected $data;
    protected $error;

    public function __construct(ResponseInterface $response, $request = [])
    {
        $this->response = $response;
        $this->request = $request;
        $this->data = $this->getPayload();
    }

    public function getPayload()
    {
        return json_decode((string)$this->response->getBody(), true);
    }

    public function getResponse()
    {
        return $this->response;
    }

    public function getData()
    {
        return $this->data;
    }

    public function isMultiple()
    {
        $total = $this->getTotal();
        return !is_null($total);
    }

    public function isPaginated()
    {
        $pages = $this->getTotalPages();
        return !is_null($pages);
    }

    public function getPage()
    {
        return $this->isPaginated() ? array_get($this->request, 'page', 1) : null;
    }

    public function getTotal()
    {
        $total = $this->response->getHeader('x-wp-total');
        return !is_null($total) && sizeof($total) ? (int)$total[0] : null;
    }

    public function getTotalPages()
    {
        $totalPages = $this->response->getHeader('x-wp-totalpages');
        return !is_null($totalPages) && sizeof($totalPages) ? (int)$totalPages[0] : null;
    }

    public function isError()
    {
        return $this->response->getStatusCode() >= 400;
    }

    /**
     * Get the object iterator
     * @return \Iterator
     */
    public function getIterator()
    {
        return new ArrayIterator($this->data);
    }

    /**
     * Get a property value
     * @param  string $name The name of the property
     * @return mixed|null
     */
    protected function propertyGet($name)
    {
        return $this->data[$name];
    }

    /**
     * Set a property value
     * @param  string $name The name of the property
     * @param  mixed $value The new value of the property
     * @return $this
     */
    protected function propertySet($name, $value)
    {
        $this->data[$name] = $value;
        return $this;
    }

    /**
     * Unset a property value
     * @param  string $name The name of the property
     * @return mixed|null
     */
    protected function propertyUnset($name)
    {
        unset($this->data[$name]);
    }

    /**
     * Check if a property exists
     * @param  string $name The name of the property
     * @return mixed|null
     */
    protected function propertyExists($name)
    {
        return isset($this->data[$name]);
    }

    /**
     * Get the object as array
     * @return array
     */
    public function toArray()
    {
        return $this->getData();
    }
}
