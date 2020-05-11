<?php

namespace Core\Validation\Rules;

use Core\Validation\Rule;

class After extends Rule
{

    use Traits\DateUtilsTrait;

    /** @var string */
    protected $message = "The :attribute must be a date after :time.";

    /** @var array */
    protected $fillableParams = ['time'];

    /**
     * Check the value is valid
     *
     * @param mixed $value
     * @return bool
     * @throws Exception
     */
    public function check($value): bool
    {
        $this->requireParameters($this->fillableParams);
        $time = $this->parameter('time');

        if (!$this->isValidDate($value)) {
            throw $this->throwException($value);
        }

        if (!$this->isValidDate($time)) {
            throw $this->throwException($time);
        }

        return $this->getTimeStamp($time) < $this->getTimeStamp($value);
    }
}
