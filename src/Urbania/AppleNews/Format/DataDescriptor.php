<?php

namespace Urbania\AppleNews\Format;

use Carbon\Carbon;
use Urbania\AppleNews\Assert;

/**
 * The object for providing the data type, data formatting, and label for
 * a field in a table.
 *
 * @see https://developer.apple.com/documentation/apple_news/datadescriptor
 */
class DataDescriptor
{
    /**
     * The data type. Valid values:
     * @var string
     */
    protected $dataType;

    /**
     * Sets some additional formatting preferences if you are using the float
     * or image data type. For example, use a FloatDataFormat object in this
     * property to control rounding, or use an ImageDataFormat to control
     * image size.
     * @var \Urbania\AppleNews\Format\DataFormat
     */
    protected $format;

    /**
     * A unique identifier for this data descriptor. If used, identifiers
     * must be unique across descriptors in this data record store. An
     * identifier is required if you want to sort your table by any order
     * other than the order in which the records are provided.
     * @var string
     */
    protected $identifier;

    /**
     * The name of this data descriptor. In a data record, you will use this
     * name as the key in a key-value pair, where the value is the data
     * itself. This key must be unique across data descriptors in this data
     * record store. See RecordStore.
     * @var string
     */
    protected $key;

    /**
     * The text to appear in the table header for this data category. This
     * text can be provided as a string or a FormattedText object.
     * @var \Urbania\AppleNews\Format\FormattedText|string
     */
    protected $label;

    public function __construct(array $data = [])
    {
        if (isset($data['dataType'])) {
            $this->setDataType($data['dataType']);
        }

        if (isset($data['format'])) {
            $this->setFormat($data['format']);
        }

        if (isset($data['identifier'])) {
            $this->setIdentifier($data['identifier']);
        }

        if (isset($data['key'])) {
            $this->setKey($data['key']);
        }

        if (isset($data['label'])) {
            $this->setLabel($data['label']);
        }
    }

    /**
     * Get the dataType
     * @return string
     */
    public function getDataType()
    {
        return $this->dataType;
    }

    /**
     * Get the format
     * @return \Urbania\AppleNews\Format\DataFormat
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * Get the identifier
     * @return string
     */
    public function getIdentifier()
    {
        return $this->identifier;
    }

    /**
     * Get the key
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * Get the label
     * @return \Urbania\AppleNews\Format\FormattedText|string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * Set the dataType
     * @param string $dataType
     * @return $this
     */
    public function setDataType($dataType)
    {
        Assert::oneOf($dataType, [
            "string",
            "text",
            "image",
            "number",
            "integer",
            "float"
        ]);

        $this->dataType = $dataType;
        return $this;
    }

    /**
     * Set the format
     * @param \Urbania\AppleNews\Format\DataFormat|array $format
     * @return $this
     */
    public function setFormat($format)
    {
        if (is_object($format)) {
            Assert::isInstanceOf($format, DataFormat::class);
        } else {
            Assert::isArray($format);
        }

        $this->format = is_array($format)
            ? DataFormat::createTyped($format)
            : $format;
        return $this;
    }

    /**
     * Set the identifier
     * @param string $identifier
     * @return $this
     */
    public function setIdentifier($identifier)
    {
        Assert::string($identifier);

        $this->identifier = $identifier;
        return $this;
    }

    /**
     * Set the key
     * @param string $key
     * @return $this
     */
    public function setKey($key)
    {
        Assert::string($key);

        $this->key = $key;
        return $this;
    }

    /**
     * Set the label
     * @param \Urbania\AppleNews\Format\FormattedText|array|string $label
     * @return $this
     */
    public function setLabel($label)
    {
        if (is_object($label)) {
            Assert::isInstanceOf($label, FormattedText::class);
        } elseif (!is_array($label)) {
            Assert::string($label);
        }

        $this->label = is_array($label) ? new FormattedText($label) : $label;
        return $this;
    }

    /**
     * Convert the object into something JSON serializable.
     * @return array
     */
    public function jsonSerialize(int $options)
    {
        return $this->toArray();
    }

    /**
     * Convert the instance to JSON.
     * @param  int  $options
     * @return string
     */
    public function toJson(int $options = 0)
    {
        return json_encode($this->jsonSerialize(), $options);
    }

    /**
     * Get the object as array
     * @return array
     */
    public function toArray()
    {
        $data = [];
        if (isset($this->dataType)) {
            $data['dataType'] = $this->dataType;
        }
        if (isset($this->format)) {
            $data['format'] = is_object($this->format)
                ? $this->format->toArray()
                : $this->format;
        }
        if (isset($this->identifier)) {
            $data['identifier'] = $this->identifier;
        }
        if (isset($this->key)) {
            $data['key'] = $this->key;
        }
        if (isset($this->label)) {
            $data['label'] = is_object($this->label)
                ? $this->label->toArray()
                : $this->label;
        }
        return $data;
    }
}
