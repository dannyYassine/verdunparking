dump:
	cd src; composer dump-autoload
web:
	php -S localhost:8000 -t src/public
client:
	cd src/client; npm run serve