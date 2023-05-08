check:
	composer check

csfix:
	composer fix

start:
	symfony serve -d

stop:
	symfony serve:stop

restart: stop start

update: 
	$(EXEC) composer install