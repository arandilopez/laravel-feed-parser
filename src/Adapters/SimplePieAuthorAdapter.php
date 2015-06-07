<?php namespace ArandiLopez\Feed\Adapters;

use Illuminate\Support\Str;

use JsonSerializable;
use ArrayAccess;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Contracts\Support\Arrayable;

class SimplePieAuthorAdapter implements JsonSerializable, Jsonable, ArrayAccess, Arrayable {

    protected $author;

    function __construct($author)
    {
        $this->author = $author;
    }

    public function getRawAuthor()
    {
        return $this->author;
    }

    public function __get($attribute)
    {
        $attr = Str::snake($attribute);
        switch ($attr) {
            case 'name':
                return $this->author->get_name();
                break;
            case 'email':
                return $this->author->get_email();
                break;
            case 'link':
                return $this->author->get_link();
                break;
            default:
                return null;
                break;
        }
    }

    public function toJson($option = 0)
    {
        return json_encode($this->toArray(), $option);
    }

    public function jsonSerialize()
    {
        return $this->toArray();
    }

    public function toArray()
    {
        return [
            'name'  => $this->name,
            'link'  => $this->link,
            'email' => $this->email
        ];
    }

    /**
     * Determine if the given attribute exists.
     *
     * @param  mixed  $offset
     * @return bool
     */
    public function offsetExists($offset)
    {
        return isset($this->$offset);
    }

    /**
     * Get the value for a given offset.
     *
     * @param  mixed  $offset
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return $this->$offset;
    }

    /**
     * Set the value for a given offset.
     *
     * @param  mixed  $offset
     * @param  mixed  $value
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        $this->$offset = $value;
    }

    /**
     * Unset the value for a given offset.
     *
     * @param  mixed  $offset
     * @return void
     */
    public function offsetUnset($offset)
    {
        unset($this->$offset);
    }
}
