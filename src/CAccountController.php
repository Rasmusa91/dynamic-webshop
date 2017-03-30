<?php
	class CAccountController extends CController
	{
		public function __construct()
		{
		}

        public function login($email, $password)
        {
            $sql = "SELECT password FROM dynamicShopaccounts
                    WHERE email = ?";

            $res = $this->getControllerHandler()->get("database")->ExecuteSelectQueryAndFetchAll($sql, [
                $email
            ], false);

            foreach($res as $val)
			{
                if(password_verify($password, $val->password)) {
					$this->onLoggedIn();
                    return 1;
                }
            }

            return 0;
        }

		private function onLoggedIn()
		{
			$this->getControllerHandler()->get("session")->add("account", new CAccount());
		}

		public function isLoggedIn()
		{
			return $this->getControllerHandler()->get("session")->get("account") !== null;
		}

		public function logout()
		{
			$this->getControllerHandler()->get("session")->add("account", null);

			return 1;
		}
	}
