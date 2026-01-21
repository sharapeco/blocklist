<?php
const SRC = __DIR__ . '/../src/blocklist.txt';
const DEST = __DIR__ . '/../out/unbound/block.conf';

$lines = [];

$dir = dirname(DEST);
if (!file_exists($dir)) {
	mkdir($dir, 0755, true);
}

$hosts = @file(SRC, FILE_SKIP_EMPTY_LINES | FILE_IGNORE_NEW_LINES);
sort($hosts);

$config = [];
foreach ($hosts as $host) {
	$config[] = 'local-zone: "' . $host . '." static';
}

file_put_contents(DEST, implode(PHP_EOL, $config));
