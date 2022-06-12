<?php

class user
{
	private $id;
	private $name;
	private $last;
	private $address;
	private $phone;
	private $email;
	private $password;
	private $photo;

    public function __construct($id = null, $name, $last, $address, $phone, $email, $password, $photo = null)
	{
		$this->id = $id;
		$this->name = $name;
		$this->last = $last;
		$this->address = $address;
		$this->phone = $phone;
		$this->email = $email;
		$this->password = $password;
		$this->photo = $photo;
	}

    public function getId() { return $this->id; }
    public function getName() { return $this->name; }
    public function getLast() { return $this->last; }
    public function getAddress() { return $this->address; }
    public function getPhone() { return $this->phone; }
    public function getEmail() { return $this->email; }
    public function getPassword() { return $this->password; }
    public function getPhoto() { return $this->photo; }

    public function setId($value) {  $this->id = $value; }
    public function setName($value) {  $this->name = $value; }
    public function setLast($value) {  $this->last = $value; }
    public function setAddress($value) {  $this->address = $value; }
    public function setPhone($value) {  $this->phone = $value; }
    public function setEmail($value) {  $this->email = $value; }
    public function setPassword($value) {  $this->password = $value; }
    public function setPhoto($value) {  $this->photo = $value; }
}