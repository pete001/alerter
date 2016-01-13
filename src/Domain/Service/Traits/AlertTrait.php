<?php namespace Pete001\Alerter\Domain\Service\Traits;

/**
 * Various helper methods
 *
 * @author Pete Cheyne <pete.cheyne@gmail.com>
 */
trait AlertTrait
{
	/**
	 * Presentation layer to db transformation
	 *
	 * @param String $text The text to transform
	 *
	 * @return String
	 */
	public function textToDatastore($text) {
		return strtolower($text);
	}

	/**
	 * Traverse an array of objects to search for a property
	 * and return the value if found, otherwise throw exception if required
	 *
	 * @param String           $property     The property to search for
	 * @param Array            $details      Array of alert details
	 *
	 * @throws \ErrorException               If the property doesnt exist and its required
	 *
	 * @return Mixed                         The corresponding value, or false if optional and not found
	 */
	public function getRequirement($property, $details, $required = true) {
		foreach ($details as $object) {
			$requirements = $object->getAlertRequirement();
			if (property_exists($requirements, 'title') && $property === $requirements->title) {
				return $object->value;
			}
		}

		if ($required) throw new \ErrorException("Required alert property $property not set");

		return false;
	}
}
