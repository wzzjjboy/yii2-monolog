<?php


namespace yii2\monolog;

class LogIdProcessor
{
    private $uid;

    private static $instance;

    private $length = 32;

    public static function instance()
    {
        if (empty(self::$instance)){
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function __construct($length = 32)
    {
        if (!is_int($length) || $length > 32 || $length < 16) {
            throw new \InvalidArgumentException('The uid length must be an integer between 1 and 32');
        }

        $this->uid = substr(hash('md5', uniqid('', true)), 0, $length);
    }

    public function __invoke(array $record)
    {
        $record['extra']['uid'] = $this->uid;

        return $record;
    }

    /**
     * @return string
     */
    public function getUid(){
        return $this->uid;
    }

    /**
     *手动刷新logId
     */
    public function refresh(){
        $this->uid = str_replace(substr($this->uid, -8), substr($this->generateId(), -8), $this->uid);
    }

    private function generateId(){
        return substr(hash('md5', uniqid('', true)), 0, $this->length);
    }
}