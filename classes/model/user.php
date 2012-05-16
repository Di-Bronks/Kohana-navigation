<?php defined('SYSPATH') or die('No direct script access.');

class Model_User extends Model_Auth_User {

	protected $_roles = array();

	public function has_role($role, $all_required = TRUE) 
	{
		$status = TRUE;
		
		if(is_array($role))
		{
			$status = (bool) $all_required;
			
			foreach ($role as $_role)
			{
				// If the user doesn't have the role
				if ( !in_array($_role, $this->_roles))
				{
					// Set the status false and get outta here
					$status = FALSE;

					if ($all_required)
					{
						break;
					}
				}
				elseif ( ! $all_required )
				{
				   $status = TRUE;
				   break;
				}
			}
		}
		else
		{
			$status = in_array($role, $this->_roles);
		}
		
		return $status;
	}
	
	public function roles()
	{
		return $this->_roles;
	}
	
	public function complete_login()
	{
		$roles = $this->roles->find_all();
		
		foreach ($roles as $role)
		{
			$this->_roles[] = $role->name;
		}

		parent::complete_login();
	}

	public function serialize()
	{
		$parameters = array(
			'_primary_key_value', '_object', '_changed', '_loaded', '_saved', '_sorting', 
			'_roles'
		);
		
		// Store only information about the object
		foreach ($parameters as $var)
		{
			$data[$var] = $this->{$var};
		}

		return serialize($data);
	}
}