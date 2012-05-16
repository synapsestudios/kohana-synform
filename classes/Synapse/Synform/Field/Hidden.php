<?php defined('SYSPATH') OR die('No direct access allowed.');

class Synapse_Synform_Field_Hidden extends Synform_Element {

	protected $_has_label = FALSE;

	protected $_view = 'input/hidden';

	public function __construct($name, $value)
	{
		parent::__construct($name);

		$this->set_attribute('type', 'hidden')
			->set_value($value);
	}

}