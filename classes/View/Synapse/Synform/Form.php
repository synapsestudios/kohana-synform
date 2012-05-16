<?php defined('SYSPATH') OR die('No direct script access.');

class View_Synapse_Synform_Form extends Kostache
{
	public $attributes;
	public $object;
	public $open;

	public function attributes()
	{
		return HTML::attributes($this->attributes);
	}
}