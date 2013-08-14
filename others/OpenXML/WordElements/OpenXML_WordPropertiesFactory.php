<?php
class OpenXML_WordPropertiesFactory {

	public static function CreateProperties(OpenXML_WordElement $parent) {
		$type = new ReflectionClass($parent);
		$type = $type->name;

		if(class_exists($type.'Properties')) {
			$type = new ReflectionClass($type.'Properties');
			return $type->newInstance($parent);
		} else {
			return null;
		}
	}

}