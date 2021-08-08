<?php


class Shift
{
    private $shiftId;
    private $employee;
    private $startDate;
    private $endDate;

    /**
     * @return mixed
     */
    public function getShiftId()
    {
        return $this->shiftId;
    }

    /**
     * @param mixed $shiftId
     */
    public function setShiftId($shiftId): void
    {
        $this->shiftId = $shiftId;
    }

    /**
     * @return mixed
     */
    public function getEmployee()
    {
        return $this->employee;
    }

    /**
     * @param mixed $employee
     */
    public function setEmployee($employee): void
    {
        $this->employee = $employee;
    }

    /**
     * @return mixed
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * @param mixed $startDate
     */
    public function setStartDate($startDate): void
    {
        $this->startDate = $startDate;
    }

    /**
     * @return mixed
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * @param mixed $endDate
     */
    public function setEndDate($endDate): void
    {
        $this->endDate = $endDate;
    }


}
