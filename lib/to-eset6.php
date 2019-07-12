<?php
const SRC = __DIR__ . '/../blocklist.txt';
const DEST = __DIR__ . '/../ESET6-blocklist.txt';

$lines = file(SRC, FILE_SKIP_EMPTY_LINES | FILE_IGNORE_NEW_LINES);
$lines = array_map(function($line) {
	return '*' . $line . '*';
}, $lines);
file_put_contents(DEST, implode("\n", $lines));
