<?php

/***************************************************************
 * Extension Manager/Repository config file for ext "cdsrc_tsredirect".
 *
 * Auto generated 03-04-2015 16:06
 *
 * Manual updates:
 * Only the data in the array - everything else is removed by next
 * writing. "version" and "dependencies" must not be touched!
 ***************************************************************/

$EM_CONF[$_EXTKEY] = array (
	'title' => 'Redirect via Typoscript',
	'description' => 'Add a typoscript user function to redirect properly to an other page and stop page processing',
	'category' => 'misc',
	'version' => '3.0.0',
	'state' => 'beta',
	'uploadfolder' => true,
	'createDirs' => '',
	'clearcacheonload' => true,
	'author' => 'Matthias Toscanelli',
	'author_email' => 'm.toscanelli@code-source.ch',
	'author_company' => 'Code-Source',
	'constraints' =>
	array (
		'depends' =>
		array (
			'typo3' => '6.2.0-7.1.99',
		),
		'conflicts' =>
		array (
		),
		'suggests' =>
		array (
		),
	),
);

