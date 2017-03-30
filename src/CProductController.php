<?php
	class CProductController
	{
		private $databaseController;
		private $products;
		private $categories;
		private $units;

		public $totalProductsAmount;
		public $productsPerPage;

		public function __construct($p_DatabaseController)
		{
			$this->databaseController = $p_DatabaseController;
			$this->products = [];
			$this->productsPerPage = 10;
		}

		public function getCategories()
		{
			$sql = "SELECT id, name FROM dynamicShopcategories";
			$res = $this->databaseController->ExecuteSelectQueryAndFetchAll($sql);

			foreach($res as $val) {
				$this->categories[] = new CCategory($val->id, $val->name);
			}

			return $this->categories;
		}

		public function getUnits()
		{
			$sql = "SELECT id, name FROM dynamicShopunits";
			$res = $this->databaseController->ExecuteSelectQueryAndFetchAll($sql);

			foreach($res as $val) {
				$this->units[] = new CCategory($val->id, $val->name);
			}

			return $this->units;
		}

		public function getProducts($options = [])
		{
			$defaultOptions = [
				"page" => 1,
				"query" => "",
				"cats" => [],
				"units" => []
			];

			$options = array_merge($defaultOptions, $options);

			$sql = "SELECT SQL_CALC_FOUND_ROWS pr.* FROM(SELECT p.id, p.name, p.price_cost, p.price_sales, (
				SELECT GROUP_CONCAT(\" \", dynamicShopcategories.name)
				FROM dynamicShopcatprodrel, dynamicShopcategories
				WHERE dynamicShopcatprodrel.prod_id = p.id AND dynamicShopcatprodrel.cat_id = dynamicShopcategories.id
			) as category, (
				SELECT GROUP_CONCAT(\" \", dynamicShopunits.name)
				FROM dynamicShopunitprodrel, dynamicShopunits
				WHERE dynamicShopunitprodrel.prod_id = p.id AND dynamicShopunitprodrel.unit_id = dynamicShopunits.id
			) as unit
			FROM dynamicShopproducts AS p
			WHERE p.name LIKE ?";

			if(count($options["cats"]) > 0)
			{
				$sql .= " AND p.id IN (
					SELECT prod_id FROM dynamicShopcatprodrel WHERE cat_id IN (" . join(',', array_fill(0, count($options["cats"]), '?')) . ")
				)";
			}

			if(count($options["units"]) > 0)
			{
				$sql .= " AND p.id IN (
					SELECT prod_id FROM dynamicShopunitprodrel WHERE unit_id IN (" . join(',', array_fill(0, count($options["units"]), '?')) . ")
				)";
			}

			$sql .= ") pr
			LIMIT ?, ?";

			$params = [];
			$params[] = "%" . $options["query"] . "%";
			$params = array_merge($params, $options["cats"]);
			$params = array_merge($params, $options["units"]);
			$params[] = (($options["page"] - 1) * $this->productsPerPage);
			$params[] = $this->productsPerPage;

			$res = $this->databaseController->ExecuteSelectQueryAndFetchAll($sql, $params, false);

			$this->totalProductsAmount = $this->databaseController->ExecuteSelectQueryAndFetchAll("SELECT FOUND_ROWS() as counter;")[0]->counter;

			foreach($res as $val) {
				$this->products[] = new CProduct($val->id, $val->name, $val->price_cost, $val->price_sales, trim($val->category), trim($val->unit));
			}

			return $this->products;
		}

		public function getProductsJson($options = []) {
			return json_encode($this->getProducts($options));
		}
	}
