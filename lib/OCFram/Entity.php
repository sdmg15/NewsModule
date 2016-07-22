<?php 
Namespace OCFram;

/**
 * @className Entity
 * @ClassInfo represent the base class of entities 
 * @Authored  8 sep 2015 
 * @Author Sonkeng Donfack Maldini (SMD)
 */
 
Abstract Class Entity implements \ArrayAccess
{
	protected $id,
			  $erreurs = [];
			  
	public function __construct(array $data = [])
	{
			$this->hydrater($data);	
	}
	
	public function hydrater(array $data)
	{
		foreach($data as $cle => $value)
		{
			$method = 'set'.ucfirst($cle);
			
			if(is_callable([$this,$method]))
			{
				$this->$method($value);
			}
		}
	}
	
	public function isNew()
	{
		return empty($this->id); 
	}
	
	public function getId()
	{
		return $this->id;
	}
	
	
	public function getErreurs()
	{
		return $this->erreurs;
	}
	
	public function setId($id)
	{
		$this->id = (int) $id;
	}
	
	//Methods of arrayAccess interface
	public function offsetGet($offset)
	{
		$getter = 'get'.ucfirst($offset);
		if(isset($this->$offset) && is_callable([$this,$getter]))
		{
			return $this->$getter();
		}
	}
	
	public function offsetExists($off)
	{
		return isset($this->$off) && is_callable([$this,$off]);
	}
	
	public function offsetUnset($offset)
	{
		throw new \LogicException('Désolé mais an offset cannot be deleted .');
	}
	
	public function offsetSet($cle,$value)
	{
		$setter = 'set'.ucfirst($cle);
		if(is_callable([$this,$setter]) && isset($this->$cle))
		{
			return $this->$setter($value);
		}
	}
	
}













