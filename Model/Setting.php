<?php

namespace EM\SettingsBundle\Model;

/**
 * Settings\Bundle\Entity\Setting
 */
 abstract class Setting
{
    /**
     *
     */
    const TYPE_INT = 1;
    /**
     *
     */
    const TYPE_FLOAT = 2;
    /**
     *
     */
    const TYPE_STRING = 3;
    /**
     *
     */
    const TYPE_LIST = 4;

    /**
     * @var array
     */
    protected static $typeList = array(self::TYPE_INT    => 'integer',
                                       self::TYPE_FLOAT  => 'float',
                                       self::TYPE_STRING => 'string',
                                       self::TYPE_LIST   => 'array',);

    /**
     * @var array
     */
    protected static $typeListLabels = array(self::TYPE_INT    => 'label.integer',
                                              self::TYPE_FLOAT  => 'label.float',
                                              self::TYPE_STRING => 'label.text',
                                              self::TYPE_LIST   => 'label.list',);
    /**
     * @var integer $id
     *
     */
    protected $id;

    /**
     * @var string $identifier
     *
     */
    protected $identifier;

    /**
     * @var string $identifier
     *
     */
    protected $label;

    /**
     * @var smallint $type
     *
     */
    protected $type;

    /**
     * @var text $options
     *
     */
    protected $options;

    /**
     * @var text $value
     *
     */
    protected $value;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set identifier
     *
     * @param string $identifier
     */
    public function setIdentifier($identifier)
    {
        $this->identifier = $identifier;
    }

    /**
     * Get identifier
     *
     * @return string
     */
    public function getIdentifier()
    {
        return $this->identifier;
    }

    /**
     * Set type
     *
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set options
     *
     * @param text $options
     */
    public function setOptions($options)
    {
        $this->options = $options;
    }

    /**
     * Get options
     *
     * @return text
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Set value
     *
     * @param text $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * Get value
     *
     * @return text
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @stati   c
     * @return array of types System Configuration, readable
     */
    public static function getTypeList()
    {
        return self::$typeListLabels;
    }

    /**
     * @static
     *
     * @param $type for function settype
     *
     * @return mixed
     */
    public static function getCurrentType($type)
    {
        return self::$typeList[$type];
    }

    /**
     * Set label
     *
     * @param string $label
     */
    public function setLabel($label)
    {
        $this->label = $label;
    }

    /**
     * Get label
     *
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }
}