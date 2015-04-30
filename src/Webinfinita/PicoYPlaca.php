<?php

namespace Webinfinita;

class PicoYPlaca {

    protected $allowedTime = [
        'morning_starts_at'   => 700,
        'morning_ends_at'     => 930,
        'afternoon_starts_at' => 1600,
        'afternoon_ends_at'   => 1930
    ];

    protected $allowedDays = [
        'Mon' => [1,2],
        'Tue' => [3,4],
        'Wed' => [5,6],
        'Thu' => [7,8],
        'Fri' => [9,0]
    ];

    public function check($plateNumber, $date, $hour)
    {
        $lastPlateNumber = $this->getPlateLastNumber($plateNumber);

        $day = $this->getDay($date);

        $hour = $this->getHourAsInteger($hour);

        if($this->isNumberPlateAllowedDay($lastPlateNumber, $day))
        {
            return $this->isNumberPlateAllowedTime($hour);
        }

        return false;

    }

    /**
     * @param $date
     * @return mixed
     */
    private function getDay($date)
    {
        $date = new \DateTime($date);

        return $date->format('D');
    }

    /**
     * @param $hour
     * @return int
     */
    private function getHourAsInteger($hour)
    {
        $hour = str_replace(':', '', $hour);

        return (int) $hour;
    }

    /**
     * @param $plateNumber
     * @return string
     */
    private function getPlateLastNumber($plateNumber)
    {
        return substr($plateNumber, -1);
    }

    /**
     * @param $lastPlateNumber
     * @param $day
     * @return bool
     */
    private function isNumberPlateAllowedDay($lastPlateNumber, $day)
    {
        if($day == 'Sat' or $day == 'Sun') return true;

        return in_array($lastPlateNumber, $this->allowedDays[$day]);
    }

    /**
     * @param $hour
     * @return bool
     */
    private function isNumberPlateAllowedTime($hour)
    {
        return ($hour >= $this->allowedTime['morning_starts_at']
        and $hour <= $this->allowedTime['morning_ends_at']) or
        ($hour >= $this->allowedTime['afternoon_starts_at']
        and $hour <= $this->allowedTime['afternoon_ends_at']);
    }
}
