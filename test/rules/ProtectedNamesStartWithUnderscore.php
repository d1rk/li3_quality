<?php
/**
 * Lithium: the most rad php framework
 *
 * @copyright     Copyright 2011, Union of RAD (http://union-of-rad.org)
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 */

namespace li3_quality\test\rules;

use lithium\util\String;

class ProtectedNamesStartWithUnderscore extends \li3_quality\test\Rule {

	/**
	 * Will iterate the tokens looking for protected methods and variables, once
	 * found it will validate the name of it's parent starts with an underscore.
	 *
	 * @param  Testable $testable The testable object
	 * @return void
	 */
	public function apply($testable) {
		$message = 'Protected method {:name} must start with an underscore';
		$tokens = $testable->tokens();
		foreach ($tokens as $position => $token) {
			if ($token['id'] === T_PROTECTED) {
				$parentLabel = $tokens[$token['parent']]['label'];
				if (substr($parentLabel, 0, 1) !== '_') {
					$this->addViolation(array(
						'message' => String::insert($message, array(
							'name' => $parentLabel,
						)),
						'line' => $token['line']
					));
				}
			}
		}
	}

}

?>