<?php
	class CCategory
	{
		public $id;
		public $name;

		public function __construct($p_ID, $p_Name)
		{
			$this->id = $p_ID;
			$this->name = $p_Name;
		}
	}
