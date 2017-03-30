<?php
	class CProduct
	{
		public $id;
		public $name;
		public $priceCost;
		public $priceSales;
		public $category;
		public $unit;
		
		public function __construct($p_ID, $p_Name, $p_PriceCost, $p_PriceSales, $p_Cat = null, $p_Unit = null)
		{
			$this->id = $p_ID;
			$this->name = $p_Name;
			$this->priceCost = $p_PriceCost;
			$this->priceSales = $p_PriceSales;
			$this->category = $p_Cat;
			$this->unit = $p_Unit;
		}
	}