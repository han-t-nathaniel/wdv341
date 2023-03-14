<?php 
class Event implements \JsonSerializable {
    private $eventName;
    private $eventDescription;
    private $eventPresenter;
    private $eventDate;
    private $eventTime;

    function __construct($inName, $inDescription, $inPresenter, $inDate, $inTime) {
        $this->setEventName($inName);
        $this->setEventDescription($inDescription);
        $this->setEventPresenter($inPresenter);
        $this->setEventDate($inDate);
        $this->setEventTime($inTime);
    }

    function setEventName($inName) {
        $this->eventName = $inName;
    }

    function getEventName() {
        return $this->eventName;
    }

    function setEventDescription($inDescription) {
        $this->eventDescription = $inDescription;
    }

    function getEventDescription() {
        return $this->eventDescription;
    }

    function setEventPresenter($inPresenter) {
        $this->eventPresenter = $inPresenter;
    }

    function getEventPresenter() {
        return $this->eventPresenter;
    }

    function setEventDate($inDate) {
        if(is_a($inDate, "DateTime")) {
            $this->eventDate = $inDate;
        } else {
            $this->eventDate = new DateTime($inDate);
        }
    }

    function getEventDate() {
        return $this->eventDate;
    }

    function setEventTime($inTime) {
        if(is_a($inTime, "DateTime")) {
            $this->eventTime = $inTime;
        } else {
            $this->eventTime = new DateTime($inTime);
        }
    }

    function getEventTime() {
        return $this->eventTime;
    }

    function jsonSerialize() {
        $vars = get_object_vars($this);
        return $vars;
    }
}
?>