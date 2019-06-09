<?php
class Compra extends model {

	public function getAll() 
	{
		$array = array();

		$sql = $this->db->prepare("SELECT * FROM compra");
		$sql->execute();

		if($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}

		return $array;
	}
}