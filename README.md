### Bedrock Admin Panel
Admin panel for Bedrock Dedicated Server

This repository uses [LomotHo docker image](https://github.com/LomotHo/minecraft-bedrock)

### Features

* Whitelist manage
* User roles manage
* Server settings manage
* Uploading, regenerating world
* Backups
* Logs
* Server starting, stopping and restarting

##### TODO:
* Scheduled backups
* Scheduled restart
* Flash messages
* Server exit / login notifications
* Session authentication

### Install

You can install panel in 2 commands!

Instead of {{IP}} write your vps (vds) IP (in first command)

For example:

    sudo sh -c "echo '80.87.202.253' >> /bedrock-admin-panel/web/server.ip" &&
    
Instead of:

    sudo sh -c "echo '{{IP}}' >> /bedrock-admin-panel/web/server.ip" &&

    
Instruction:
1. Buy vds/vps on Ubuntu (required) 18.04 (recommended and tested on this version) with KVM (required) virtualization
2. Connect by SSH (for example use [Putty program](https://www.putty.org/))
3. Execute this commands (RMB to paste and enter to execute in Putty)

First command:
    
    
    sudo apt update -y &&
    sudo apt upgrade -y &&
    sudo apt -y install software-properties-common &&
    sudo add-apt-repository ppa:ondrej/php -y &&
    sudo apt-get update -y &&
    
    cd / &&
    apt install git -y &&
    git clone https://github.com/Arslanoov/bedrock-admin-panel.git &&
    cd /bedrock-admin-panel &&
    
    apt install docker.io -y &&
    sudo gpasswd -a ${USER} docker &&
    sudo service docker restart &&
    
    mkdir -p /opt/mcpe-data &&
    docker run -itd --restart=always --name=mcpe --net=host \
      -v /opt/mcpe-data:/data \
      lomot/minecraft-bedrock:1.16.1.02 &&
    
    apt install docker-compose -y &&
    apt install make -y &&
    make init &&
    
    mkdir /opt/mcpe-data/backups && chmod -R 777 /opt/mcpe-data/backups &&
    chmod -R 777 /opt/mcpe-data/worlds &&
    
    echo 'www-data ALL=NOPASSWD: ALL' | sudo EDITOR='tee -a' visudo &&
    
    sudo sh -c "echo '{{IP}}' >> /bedrock-admin-panel/web/server.ip" &&
    
    sudo apt-get install php7.4 -y &&
    
    cd /bedrock-admin-panel/web &&
    chmod -R 777 var &&
    docker-compose run --rm php-cli chmod -R 777 /app/data &&
    cd .. &&
    docker-compose up -d &&
    cd web &&
    php generate.php
    
    
Second command:

    cd /bedrock-admin-panel &&
    nohup php -S 0.0.0.0:57152 -t command/ > /dev/null 2>&1 &
    
Done!

Now copy the link that appeared in putty. For example:

    http://80.87.202.253:8080/admin?key=kRTXY5xMJybCkhKDWIqO3PdonPPWmdRcIB9RJy9MnrjNfMskY69Uj0P7CZf1zsoN

### Change password key
    
    cd /bedrock-admin-panel && php generate.php

### Images

Some images of admin panel:

<p align="center"><b>Home page</b></p>
<p align="center">
    <img src="https://image.prntscr.com/image/D1UJz6OiSnu2ADK-jaz6Ew.png">
</p>

<p align="center"><b>Whitelist</b></p>
<p align="center">
    <img src="https://image.prntscr.com/image/pwR7_egETC2eafy0VAlNww.png">
</p>

<p align="center"><b>Properties manage (50% scale)</b></p>
<p align="center">
    <img src="https://image.prntscr.com/image/4t57eg8mRS_Y1E-UeBNCXQ.png">
</p>

<p align="center"><b>World manage</b></p>
<p align="center">
    <img src="https://image.prntscr.com/image/hljdoWFmSjKh35w_aweaSA.png">
</p>

<p align="center"><b>Backups</b></p>
<p align="center">
    <img src="https://image.prntscr.com/image/kjku2NJdSVq7Xtdw4SIMdA.png">
</p>

<p align="center"><b>Logs</b></p>
<p align="center">
    <img src="https://image.prntscr.com/image/n6MmmNxNRkWiWRapsDIMWg.png">
</p>

<p align="center"><b>Server manage</b></p>
<p align="center">
    <img src="https://image.prntscr.com/image/JpBHmnlhRMSuV4aiTj7qqQ.png">
</p>