.PHONY: all
all: out/dnsagent.stamp out/eset6.stamp out/unbound.stamp

out/sort.stamp: src/blocklist.txt
	php lib/sort.php
	@mkdir -p out
	@touch $@

out/dnsagent.stamp: out/sort.stamp
	php lib/dnsagent.php
	@touch $@

out/eset6.stamp: out/sort.stamp
	php lib/eset6.php
	@touch $@

out/unbound.stamp: out/sort.stamp
	php lib/unbound.php
	@touch $@
