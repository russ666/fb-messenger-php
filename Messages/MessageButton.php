<?php

namespace pimax\Messages;

/**
 * Class MessageButton
 * @package pimax\Messages
 */
class MessageButton
{
    /**
     * Web url button type
     */
    const TYPE_WEB = "web_url";

    /**
     * Postback button type
     */
    const TYPE_POSTBACK = "postback";

    /**
     * Postback button type
     */
    const TYPE_SHARE = "element_share";

    /**
     * Button type
     *
     * @var null|string
     */
    protected $type = null;

    /**
     * Button title
     *
     * @var null|string
     */
    protected $title = null;

    /**
     * Button url
     *
     * @var null|string
     */
    protected $url = null;

    /**
     * Additional params
     *
     * @var array
     */
    protected $options = [];

    /**
     * MessageButton constructor.
     *
     * @param string $type
     * @param string $title
     * @param string $url url or postback
     * @param array $options additional params
     */
    public function __construct($type, $title, $url = '', $options = [])
    {
        $this->type = $type;
        $this->title = $title;

        if (!$url) {
            $url = $title;
        }

        $this->url = $url;
        $this->options = $options;
    }

    /**
     * Get Button data
     * 
     * @return array
     */
    public function getData()
    {
        $result = $this->options;

        $result['type'] = $this->type;

        switch($this->type)
        {
            case self::TYPE_POSTBACK:
                $result['payload'] = $this->url;
                $result['title'] = $this->title;
            break;

            case self::TYPE_WEB:
                $result['url'] = $this->url;
                $result['title'] = $this->title;
            break;
        }

        return $result;
    }
}