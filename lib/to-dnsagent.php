<?php
const SRC = __DIR__ . '/../src/blocklist.txt';
const DEST = __DIR__ . '/../out/rules.cfg';

const HOSTS_PER_RULE = 5;

$lines = [];

$hosts = @file(SRC, FILE_SKIP_EMPTY_LINES | FILE_IGNORE_NEW_LINES);
sort($hosts);

$escapeRE = function($str) {
	$str = preg_replace('/([\\.])/', '\\\\$0', $str);
	$str = preg_replace('/\\*/', '.*', $str);
	return $str;
};

$config = [];
for ($i = 0, $len = count($hosts); $i < $len; $i += HOSTS_PER_RULE) {
	$lHosts = array_slice($hosts, $i, HOSTS_PER_RULE);
	$pattern = implode('|', array_map($escapeRE, $lHosts));
	$config[] = [
		'Pattern' => "($pattern)$",
		'Address' => '0.0.0.0',
	];
}

file_put_contents(DEST, json_encode($config, JSON_PRETTY_PRINT));
