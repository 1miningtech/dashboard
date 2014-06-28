#!/bin/bash 
sudo ./cgminer -o stratum+tcp://stratum.f2pool.com:3333 -u qq123456.test6 -p 1234 -o / -u / -p / -o / -u / -p /  --A1Pll1 1000 --A1Pll2 1000 --A1Pll3 1000 --A1Pll4 1000 --A1Pll5 1000 --api-listen --cs 8 --stmcu 0 -T --diff 12 > cgminer.log& 
