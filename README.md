

## Introduce

Project `pupa` is based on NexusPHP or hudpt(which is also based on nexusphp).

It's a completely rewrite for NexusPHP.

But the current version is rely on the `hudpt` project.

This project is still under early development.


## Install

0. Install NexusPHP or hudpt
1. `git clone git://github.com/kebot/pupa.git` and `cd pupa`
2. edit `./resources/nginx/pupa.conf` and put it to the nginx config folder(/etc/nginx)
3. `mv ./application/config/database.php.example ./application/config/database.php` and edit it
4. edit config.php and set the right nexusphp url


[project]: http://baidu.com/


## Roadmap

- ~~User login / logout ~~
- API wrap( json / jsonp )
- view seeds

## Used Technology

- PHP related technologies
	- CodeIginter Framework
	- Twig template engine