# Docker Compose LAMP stack
Based on the Docker images, built to be fast, small and extendable LAMP stack.

I made this lab for my students with a windows 10 family installed in their laptop.
The most powerfull technology is docker to have strictly the same lab for us.
But docker can't run on this OS.

That's possible with this solution : a VirtualBox Linux VM with docker inside !

With virtualBox, this lab can run on Linux and MacOS too.

## Stack and documentation
See READMEs for more details, like environment variables for images:
* [PHP-FPM alpine](https://github.com/a-kom/alpine-php_fpm)
* [Apache2 alpine with MPM mode](https://github.com/a-kom/alpine-apache)
* [NGINX](https://github.com/a-kom/alpine-nginx)
* [Node.js](https://github.com/nodejs/docker-node)
* [MailHog](https://github.com/mailhog/MailHog)
* [NGROK alpine](https://github.com/a-kom/alpine-ngrok)
* [Solr](https://github.com/docker-solr/docker-solr)
* [PhpMyAdmin](https://github.com/phpmyadmin/docker)
* [Adminer](https://github.com/TimWolla/docker-adminer)
* [MySQL](https://github.com/docker-library/mysql)
* [MariaDB alpine](https://github.com/yobasystems/alpine-mariadb)
* [PostgreSQL alpine](https://github.com/docker-library/postgres)
* [MongoDB](https://github.com/docker-library/mongo)
* [MongoDB alpine](https://hub.docker.com/r/mvertes/alpine-mongo/)
* [Redis](https://github.com/docker-library/redis)
* [Memcached](https://github.com/docker-library/memcached)
* [StandaloneFirefoxDebug](https://github.com/SeleniumHQ/docker-selenium/tree/master/StandaloneFirefoxDebug)
* [Portainer](https//github.com/portainer/portainer)

The LAMP stack consists of the following containers:

| Container | Versions | Service name | Image | Enabled by default |
| --------- | -------- | ------------ | ----- | ------------------ |
| PHP-FPM                   | php-7, php-5       | php-fpm     | [lordius/alpine-php_fpm]            | ✓ |
| Apache                    | latest             | apache2_mpm | [lordius/alpine-apache]             | ✓ |
| Nginx                     | latest             | nginx       | [lordius/alpine-nginx]              | ✓ |
| Node.js                   | node:alpine        | node        | [node]                              |   |
| Mailhog                   | latest             | mailhog     | [mailhog/mailhog]                   | ✓ |
| NGROK                     | latest             | ngrok       | [lordius/alpine-ngrok]              | ✓ |
| Solr                      | 6-alpine           | solr        | [solr]                              |   |
| PhpMyAdmin                | latest             | phpmyadmin  | [phpmyadmin/phpmyadmin]             | ✓ |
| Adminer                   | latest             | adminer     | [adminer]                           | ✓ |
| MySQL                     | latest             | mysql       | [mysql]                             | ✓ |
| PostgreSQL                | postgres:alpine    | postgres    | [postgres]                          | ✓ |
| MongoDB                   | latest             | mongo       | [mongo]                             | ✓ |
| Redis                     | redis:alpine       | redis       | [redis]                             |   |
| Memcached                 | memcached:alpine   | memcached   | [memcached]                         |   |
| PHP-FPM-DATA              | php-7, php-5       | php-fpm-data| [lordius/alpine-php_fpm]            |   |
| StandaloneFirefoxDebug    | 2.48.2             | selenium    | [selenium/standalone-firefox-debug] |   |
| Portainer                 | portainer          | portainer   | [portainer]                         |   |

## Download requirements
### VirtualBox
* [VirtualBox](https://www.virtualbox.org/wiki/Downloads) software for your platform.
### Virtual Machine
* [Alpine linux standard x86_64](https://https://alpinelinux.org/downloads/) iso image.
### ssh client
* Windows: [PuTTY](https://www.putty.org) a free ssh client.
* Linux and MacOS: nothing to download !
### NetBeans IDE
* OSX (GUI or CLI)
  * [NetBeans](https://github.com/carljmosca/netbeans-macos-bundle)
  * bash -c "$(curl -fsSL https://raw.githubusercontent.com/carljmosca/netbeans-macos-bundle/master/install-custom.sh) »
* Windows 
  * [NetBeans](https://netbeans.apache.org/download/nb100/nb100.html)
* Linux
  * sudo apt -y install wget unzipwget https://www-us.apache.org/dist/incubator/netbeans/incubating-netbeans/incubating-10.0/incubating-netbeans-10.0-bin.zip
  * unzip incubating-netbeans-10.0-bin.zip
  * sudo mv netbeans/ /opt/
  * echo ‘export PATH="$PATH:/opt/netbeans/bin/’ > ~/.bashrc (or ~/.zshrc)
  * source ~/.bashrc (or ~/.zshrc)

## VirtualBox
Install and launch VirtualBox on your machine
### Create a new VM "based on Alpine linux
* Screen 1
  * Name: alpine2201
  * Type: Linux
  * Version: Other Linux (64-bit)
  * Mémory: 512 Mo
  * Hard disk: Create a virtual disk now
  * Press on « create » button
* Screen 2
  * HDD File type: VDI
  * File space: 8,00 Go
  * Physical HDD storage: Dynamic
  * Press on « create » button
### New VM configuration
* Clic on the « Configuration » icône
* Clic on the « Network » icône
  * Network accès mode: NAT
  * Clic on the « Advenced »
  * Clic on the « Ports redirection »
  * Clic on the « + »
  * Name: ssh2201
  * Protocol: TCP
  * Host Ip: take empty
  * Host port: 2201
  * Guest Ip: 10.0.2.15
  * Guest port: 22
  * Clic on the « OK »
* Clic on the « Storage » icône 
* Clic on the storage unity: optic reader (left)
* Clic on the CD/DVD icône (right)
* Choice a virtual optical disk file
  * alpine-linux iso you have downloaded
* Clic the on the « OK » button
### Launch the VM
* Clic on the « Start » icône 
### VM Install for frenchies
* Localhost login: root (no password) and « enter »
* Enter « setu » and « tabulation » and « ql » and « tabulation »
* Keyboard layout: fr and « envoi »
* Keyboard variant: fr-qwerty (fr-qwerty for the frenchies, it's a qwerty keyboard)
* Hostname système: alpine2201
* Network interface: « enter » (eth0)
* Ip address: « enter » (dhcp)
* Manual network configuration: « enter » (no)
* New password: what you want but simple, it's a lab
* Timezone: Europe and « envoi »
* Sub-timezone: Paris and « envoi »
* Proxy: « enter » (none)
* Mirror number: « enter » (f to search best repository time response)
* SSH server: « enter » (openssh)
* NTP client: « enter » (chrony)
* Disk to use: sda and « enter » (the VirtualBox HDD)
* How would you like to use it: sys and « enter »
* Erase the above disk: y and « enter »
### Utilities install
* Enter: apk add vim sudo nmap
* Enter: apk adduser user1
* Enter: visudo
* Go to line 92 with arrows and press x when you are on the # to delete it
* Go to line 93 with arrows la lettre x  Installation d’utilitaires
* Enter: :wq (: is important)
* Enter: reboot
### Finalise
* Go back VirtualBox GUI
* Clic on Configuration
* Clic on Storage
* Clic on alpine iso file and on the CD icône at the right
* Clic on « remove the disk from the virtual drive »
* Clic on the « OK button »
* Go back the VM console
* Enter: reboot and press « return »
### Port redirection on virtualBox for this VM
* Clic on the « Configuration » icône
* Clic on the « Network » icône
  * Network accès mode: NAT
  * Clic on the « Advenced »
  * Clic on the « Ports redirection »
  * Clic on the « + »
  * Put these rules:

| Name        | Protocol | Host Ip | Host port | Guest Ip  | Guest port |
| ----------- | -------- | ------- | --------- | --------- | ---------- |
| ssh         | TCP      |         | 2201      | 10.0.2.15 | 22         |
| apache      | TCP      |         | 8080      | 10.0.2.15 | 80         |
| nginx       | TCP      |         | 8081      | 10.0.2.15 | 81         |
| phpmyadmin  | TCP      |         | 8082      | 10.0.2.15 | 82         |
| Adminer     | TCP      |         | 8083      | 10.0.2.15 | 83         |
| ngrok       | TCP      |         | 8084      | 10.0.2.15 | 84         |
| mailhog     | TCP      |         | 8085      | 10.0.2.15 | 85         |
| portainer   | TCP      |         | 8086      | 10.0.2.15 | 86         |

  * Clic the on the « OK » button

## docker
docker installation on the alpine VM
### Remote handshake on Windows machine (PuTTY)
* Port: 2201
* Adresse: 10.0.2.15
* User: user1 (created on alpine2201 VM)
### Remote handshake on Linux and MacOS
* ssh -p 2201 user1@10.0.2.15
### docker installation
* sudo vi /etc/apk/repositories
* sudo apk update
* sudo apk upgrade
* sudo apk add php7 git docker py-pip
* sudo adduser user1 docker
* sudo rc-update add docker boot
* sudo service docker start
* sudo pip install docker-compose
* sudo pip install --upgrade pip
* docker --version
* docker pull hello-world
* git clone https://github.com/dexterg/docker-compose-lamp.git
* cd docker-compose-lamp
* docker-compose up

## lamp stack
Install lamp stack on the Alpine VM
* Go to the alpine-linux VM with ssh (user1)
* Enter: git clone https://github.com/dexterg/docker-compose-lamp.git
* Enter: cd docker-compose-lamp
* Enter: docker-compose up

## Test lamp stack
Go to your desktop and launch a browser

To view the **PHP** info with the **Apache2 in MPM mode** use the IP: **http://localhost:8080**.

To view the **PHP** info with the **NGINX** use the IP: **http://localhost:8081**.

**PhpMyAdmin** is available under **http://localhost:8082**

**Adminer** is available under **http://localhost:8083**

**NGROK** is available under **http://localhost:8084**

**MailHog** is available under **http://localhost:8085**

## Development with NetBeans IDE
* Launch NetBeans
* File > New project > PHP > PHP Application from Remote Server
* Next
* Project url: http://localhost:8080
* Remote connexion
* Manage
* Name: alpine2201
* Host Name: localhost
* Port: 2201
* Password: *******
* Private key File: /Users/pascalgautherot/.ssh/id_rsa
* Known Host File: /Users/pascalgautherot/.ssh/known_hosts
* Initial Directory: /home/user1/docker-compose-lamp/htdocs
* OK
* Upload Directory: /
* Next
* Finish


##### Docker Toolbox Known Issues
* (MariaDB doesn't start) https://github.com/a-kom/docker-compose-lamp/issues/5
* (MariaDB is aborting always) https://github.com/a-kom/docker-compose-lamp/issues/4

If you want to archive your project on Linux and extract to use on Windows with Docker Toolbox just remove `ibdata` and `ib_logfile*` files in your MySQL data directory. Uncomment in `docker-compose.yml` section `# build: docker/images/mysql/.` and remove section `image: mysql`. Then run a command:
`docker-compose stop && docker-compose rm -f && docker-compose up --build -d`
To verify work check that MySQL container run a command:
`docker-compose ps`.

#### MacOS
Similar to Windows section instruction.

### Extra features

To enable **Selenium** check **docker-compose.yml** and uncomment related **selenium** and **php-fpm-data** sections.
The same for other images not enabled by default.

To enable custom configs from files, please, check the image info and uncomment related image volumes section.

You can build own images based on base images. Check the `php-fpm` section for using custom image builds. 
The custom PHP-FPM image sample is located in the directory - `docker/images/php-fpm`. 

For running multiple instances on your local machine, you can update the IP range or ports inside **docker-compose.yml**. For this, on your instance, change IPs to another range, e.g. from `172.55` to `172.54.*`. The same are for ports.


## License

This project is licensed under the MIT open source license.
# docker-compose-lamp
