<?php
class Purchases extends model {

	public function getList($offset, $id_company, $id_user) {
		$array = array();

		$sql = $this->db->prepare("
			
			SELECT purchases.id, purchases.date_purchase, purchases.total_price, purchases.id_company, users.email , companies.name
			FROM purchases 
			LEFT JOIN users ON users.id = :id_user 
			LEFT JOIN companies ON companies.id = :id_company
			WHERE purchases.id_company = :id_company 
			ORDER BY purchases.date_purchase DESC LIMIT 0, 10 

			");
		$sql->bindValue(":id_company", $id_company);
		$sql->bindValue(":id_user", $id_user);
		$sql->execute();



		if($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
        	//print_r($array);echo PHP_EOL;die();
		}

		return $array;
	}

	public function getAllInfo($id_sale, $id_company) {
		$array = array();

		$sql = "SELECT * FROM sales WHERE id = :id";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(":id", $id_sale);
		$sql->execute();

		if($sql->rowCount() > 0) {
			$array['info'] = $sql->fetch();
		}

		$sql = "SELECT id_product, quant, sale_price FROM sales_products WHERE id_sale = :id_sale";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(":id_sale", $id_sale);
		$sql->execute();

		if($sql->rowCount() > 0) {
			$array['products'] = $sql->fetchAll();

			$i = new Inventory();

			foreach($array['products'] as $pkey => $pval) {

				$array['products'][$pkey]['c'] = $i->getInfo($pval['id_product'], $id_company);

			}
		}

		return $array;
	}

	public function setNFEKey($chave, $id_sale) {

		$sql = $this->db->prepare("UPDATE sales SET nfe_key = :nfe_key WHERE id = :id");
		$sql->bindValue(":nfe_key", $chave);
		$sql->bindValue(":id", $id_sale);
		$sql->execute();

	}

	public function addPurchase($id_company, $id_user, $name, $quant, $preco_unidade, $preco_total) {
		$i = new Inventory();

		$sql = $this->db->prepare("
			INSERT INTO purchases 
			SET id_company 		= :id_company, 
				id_user 		= :id_user, 
				total_price 	= :total_price,
				date_purchase   = NOW()"
			);
		

		$sql->bindValue(":id_company"	, $id_company);
		$sql->bindValue(":id_user"		, $id_user);
		$sql->bindValue(":total_price"	, $preco_total);
		$sql->execute();
		//debug($sql->fetchAll(),1);

		$id_purchases = $this->db->lastInsertId();
		//debug($id_purchases,1);

		$sql = $this->db->prepare("
			INSERT INTO purchases_products 
			SET 
				id_company = :id_company, 
				name = :name, 
				id_purchase = :id_purchases, 
				quant = :quant, 
				purchase_price = :total_price");

		$sql->bindValue(":id_company"	, $id_company);
		$sql->bindValue(":name"			, $name);
		$sql->bindValue(":id_purchases" , $id_purchases);
		$sql->bindValue(":total_price"	, $preco_total);
		$sql->bindValue(":quant"		, $quant);
		$sql->execute();

		$id_purchases = $this->db->lastInsertId();
		//debug($id_purchases,1);
		$sql = $this->db->prepare("INSERT INTO inventory SET id_company = :id_company, name = :name , price = :price , quant = :quant , min_quant = 1");
		$sql->bindValue(":id_company"	, $id_company);
		$sql->bindValue(":name"			, $name);
		$sql->bindValue(":price"		, $preco_unidade);
		$sql->bindValue(":quant"		, $quant);
		//debug($sql,1);

		$sql->execute();

	}

	public function getInfo($id, $id_company) {
		$array = array();

		$sql = $this->db->prepare("
			SELECT
				*,
				( select clients.name from clients where clients.id = sales.id_client ) as client_name
			FROM sales
			WHERE 
				id = :id AND
				id_company = :id_company");
		$sql->bindValue(":id", $id);
		$sql->bindValue(":id_company", $id_company);
		$sql->execute();

		if($sql->rowCount() > 0) {
			$array['info'] = $sql->fetch();
		}

		$sql = $this->db->prepare("
			SELECT
				sales_products.quant,
				sales_products.sale_price,
				inventory.name
			FROM sales_products
			LEFT JOIN inventory
				ON inventory.id = sales_products.id_product
			WHERE
				sales_products.id_sale = :id_sale AND
				sales_products.id_company = :id_company");
		$sql->bindValue(":id_sale", $id);
		$sql->bindValue(":id_company", $id_company);
		$sql->execute();

		if($sql->rowCount() > 0) {
			$array['products'] = $sql->fetchAll();
		}


		return $array;
	}

	public function changeStatus($status, $id, $id_company) {

		$sql = $this->db->prepare("UPDATE sales SET status = :status WHERE id = :id AND id_company = :id_company");
		$sql->bindValue(":status", $status);
		$sql->bindValue(":id", $id);
		$sql->bindValue(":id_company", $id_company);
		$sql->execute();

	}

	public function getSalesFiltered($client_name, $period1, $period2, $status, $order, $id_company) {

		$array = array();

		$sql = "SELECT
			clients.name,
			sales.date_sale,
			sales.status,
			sales.total_price
		FROM sales
		LEFT JOIN clients ON clients.id = sales.id_client
		WHERE ";

		$where = array();
		$where[] = "sales.id_company = :id_company";

		if(!empty($client_name)) {
			$where[] = "clients.name LIKE '%".$client_name."%'";
		}

		if(!empty($period1) && !empty($period2)) {
			$where[] = "sales.date_sale BETWEEN :period1 AND :period2";
		}

		if($status != '') {
			$where[] = "sales.status = :status";
		}

		$sql .= implode(' AND ', $where);

		switch($order) {
			case 'date_desc':
			default:
				$sql .= " ORDER BY sales.date_sale DESC";
				break;
			case 'date_asc':
				$sql .= " ORDER BY sales.date_sale ASC";
				break;
			case 'status':
				$sql .= " ORDER BY sales.status";
				break;
		}

		$sql = $this->db->prepare($sql);
		$sql->bindValue(":id_company", $id_company);

		if(!empty($period1) && !empty($period2)) {
			$sql->bindValue(":period1", $period1);
			$sql->bindValue(":period2", $period2);
		}

		if($status != '') {
			$sql->bindValue(":status", $status);
		}

		$sql->execute();

		if($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}

		return $array;
	}

	public function getTotalRevenue($period1, $period2, $id_company) {
		$float = 0;

		$sql = "SELECT SUM(total_price) as total FROM sales WHERE id_company = :id_company AND date_sale BETWEEN :period1 AND :period2";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(':id_company', $id_company);
		$sql->bindValue(':period1', $period1);
		$sql->bindValue(':period2', $period2);
		$sql->execute();

		$n = $sql->fetch();
		$float = $n['total'];

		return $float;
	}

	public function getTotalExpenses($period1, $period2, $id_company) {
		$float = 0;

		$sql = "SELECT SUM(total_price) as total FROM purchases WHERE id_company = :id_company AND date_purchase BETWEEN :period1 AND :period2";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(':id_company', $id_company);
		$sql->bindValue(':period1', $period1);
		$sql->bindValue(':period2', $period2);
		$sql->execute();

		$n = $sql->fetch();
		$float = $n['total'];

		return $float;
	}

	public function getSoldProducts($period1, $period2, $id_company) {
		$int = 0;

		$sql = "SELECT id FROM sales WHERE id_company = :id_company AND date_sale BETWEEN :period1 AND :period2";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(':id_company', $id_company);
		$sql->bindValue(':period1', $period1);
		$sql->bindValue(':period2', $period2);
		$sql->execute();

		if($sql->rowCount() > 0) {
			$p = array();
			foreach($sql->fetchAll() as $sale_item) {
				$p[] = $sale_item['id'];
			}

			$sql = $this->db->query("SELECT COUNT(*) as total FROM sales_products WHERE id_sale IN (".implode(',', $p).")");
			$n = $sql->fetch();
			$int = $n['total'];

		}

		return $int;
	}

	public function getRevenueList($period1, $period2, $id_company) {
		$array = array();
		$currentDay = $period1;
		while($period2 != $currentDay) {
			$array[$currentDay] = 0;
			$currentDay = date('Y-m-d', strtotime('+1 day', strtotime($currentDay)));
		}

		$sql = "SELECT DATE_FORMAT(date_sale, '%Y-%m-%d') as date_sale, SUM(total_price) as total FROM sales WHERE id_company = :id_company AND date_sale BETWEEN :period1 AND :period2 GROUP BY DATE_FORMAT(date_sale, '%Y-%m-%d')";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(':id_company', $id_company);
		$sql->bindValue(':period1', $period1);
		$sql->bindValue(':period2', $period2);
		$sql->execute();

		if($sql->rowCount() > 0) {
			$rows = $sql->fetchAll();

			foreach($rows as $sale_item) {
				$array[$sale_item['date_sale']] = $sale_item['total'];
			}
		}


		return $array;
	}

	public function getExpensesList($period1, $period2, $id_company) {
		$array = array();
		$currentDay = $period1;
		while($period2 != $currentDay) {
			$array[$currentDay] = 0;
			$currentDay = date('Y-m-d', strtotime('+1 day', strtotime($currentDay)));
		}

		$sql = "SELECT DATE_FORMAT(date_purchase, '%Y-%m-%d') as date_purchase, SUM(total_price) as total FROM purchases WHERE id_company = :id_company AND date_purchase BETWEEN :period1 AND :period2 GROUP BY DATE_FORMAT(date_purchase, '%Y-%m-%d')";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(':id_company', $id_company);
		$sql->bindValue(':period1', $period1);
		$sql->bindValue(':period2', $period2);
		$sql->execute();

		if($sql->rowCount() > 0) {
			$rows = $sql->fetchAll();

			foreach($rows as $sale_item) {
				$array[$sale_item['date_purchase']] = $sale_item['total'];
			}
		}


		return $array;
	}

	public function getQuantStatusList($period1, $period2, $id_company) {
		$array = array('0'=>0, '1'=>0, '2'=>0);

		$sql = "SELECT COUNT(id) as total, status FROM sales WHERE id_company = :id_company AND date_sale BETWEEN :period1 AND :period2 GROUP BY status ORDER BY status ASC";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(':id_company', $id_company);
		$sql->bindValue(':period1', $period1);
		$sql->bindValue(':period2', $period2);
		$sql->execute();

		if($sql->rowCount() > 0) {
			$rows = $sql->fetchAll();

			foreach($rows as $sale_item) {
				$array[$sale_item['status']] = $sale_item['total'];
			}
		}

		return $array;
	}

}









