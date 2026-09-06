<?php
$path = dirname(__DIR__) . '/src/blocklist.txt';

$lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$lines = unique($lines);
usort($lines, function($a, $b) {
	return strcmp(invertDomain($a), invertDomain($b));
});

$temp = tempnam(dirname($path), 'blocklist_');
file_put_contents($temp, implode("\n", $lines) . "\n", LOCK_EX);
rename($temp, $path);

function invertDomain(string $domain): string {
	$parts = explode('.', $domain);
	return implode('.', array_reverse($parts));
}

function unique(array $lines): array {
	$unique = [];
	foreach ($lines as $line) {
		if (isset($unique[$line])) {
			echo "Duplicate: $line\n";
			continue;
		}
		$unique[$line] = true;
	}
	return array_keys($unique);
}
