<?php

/**
 * Created by PhpStorm.
 * User: Vincent
 * Date: 15/12/2017
 * Time: 00:50
 */
class VueCommand {
	public static function printCommands(array $commands) {
		echo('
<div class="container">
    <div class="row">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>#</th>
                <th>Numéro de commande</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
		');
		$i = 1;
		foreach ($commands as $command) {
			self::printCommandInTable($i, $command);
			$i++;
		}

		echo('
            </tbody>
        </table>
    </div>
</div>		
		');
	}

	private static function printCommandInTable($i, $command) {
		echo("
	    <tr>
	        <th scope='row'>$i</th>
	        <td>" . $command['idCommand'] . "</td>
	        <td>" . $command['status'] . "</td>
	    </tr>
	    ");
	}
}