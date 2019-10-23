<?php
const SRC = __DIR__ . '/../src/blocklist.txt';
const DEST = __DIR__ . '/../out/unbound-blocking.conf';

$lines = [];

$hosts = @file(SRC, FILE_SKIP_EMPTY_LINES | FILE_IGNORE_NEW_LINES);
sort($hosts);

$config = [];
foreach ($hosts as $host) {
	$config[] = 'local-zone: "' . $host . '." static';
}

file_put_contents(DEST, implode(PHP_EOL, $config));
