<?php
// This is my original work and it shall not be used anywhere else without my written permission.
// this class named ListItem containts a class definition to hold a single list item. since variables are private
// function jsconSerialize is used 
class ListItem implements JsonSerializable
{

    private $firstname;
    private $lastname;
    private $customerid;
    private $addres;
    private $phone;
    private $balance;

    // constructor for the class ListItem
    function __construct($firstname,$lastname,$customerid, $addres,$phone,$balance)
    {
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->addres = $addres;
        $this->phone = $phone;
        $this->balance = $balance;
        $this->customerid=$customerid;
    }

    function get_firstname(){
        return $this->firstname;
    }


    public function jsonSerialize(){
        return get_object_vars($this);
    }
}
?>