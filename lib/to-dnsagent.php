<?php
const SRC = __DIR__ . '/../src/blocklist.txt';
const DEST = __DIR__ . '/../out/rules.cfg';

$lines = [];

$hosts = @file(SRC, FILE_SKIP_EMPTY_LINES | FILE_IGNORE_NEW_LINES);
sort($hosts);

$config = [];
foreach ($hosts as $host) {
	$host = trim($host, '*');
	$config[] = [
		'Pattern' => escapeRE($host) . '$',
		'Address' => '0.0.0.0',
	];
}

file_put_contents(DEST, json_encode($config, JSON_PRETTY_PRINT));

function escapeRE($str) {
	$str = preg_replace('/([\\.])/', '\\\\$0', $str);
	$str = preg_replace('/\\*/', '.*', $str);
	return $str;
}
