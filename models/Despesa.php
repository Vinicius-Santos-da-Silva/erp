<?php
class Despesa extends model {

	public function add($array) 
	{

		$campos = '(';
		$values = '(';

		foreach ($array as $campo => $value) {
			$campos = $campos.'`'.$campo.'`,';
			$values = $values.'"'.$value.'",';
		}

		$campos = $campos.')';
		$values = $values.')';

		$remove = array(",)");
		$add   = array(")");

		$campos = str_replace($remove, $add, $campos);
		$values = str_replace($remove, $add, $values);

		$sql = $this->db->prepare("INSERT INTO compra $campos VALUES $values");
		$sql->execute();

		$id = $this->db->lastInsertId();

		return $id;		
	}

	public function update($array , $id){
	
		$campos = ' ';
		$values = ' ';

		foreach ($array as $campo => $value) {
			$campos = $campos." ".$campo." = '".$value."' AND ";
			
		}

		$campos = $campos.')';
		$values = $values.')';
		//print_r($campos);PHP_EOL;

		$remove = array("AND )");
		$add   = array(" ");

		$campos = str_replace($remove, $add, $campos);
		//$values = str_replace($remove, $add, $values);
		//print_r($campos);PHP_EOL;die();

		#print_r("UPDATE compra SET $campos  WHERE id = $id");PHP_EOL;
		$sql = $this->db->prepare("UPDATE compra SET $campos WHERE id = :id");
		$sql->bindValue(':id' , $id);
		
		$status = $sql->execute();

		#print_r($status);PHP_EOL;



		//$id = $this->db->lastInsertId();

		return $status;	
	}

	public function getById($id)
	{
		$data = array();

		$sql = $this->db->prepare("SELECT *FROM compra WHERE id = :id");
		$sql->bindValue(':id', $id);
		$sql->execute();

		$data[] = $sql->fetch();

		return $data;
	}
}