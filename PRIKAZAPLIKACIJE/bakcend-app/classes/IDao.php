<?php
interface IDao{

	public function save($obj);
	public function update($obj);
	public function delete($obj);
	public function get($obj=null);
}