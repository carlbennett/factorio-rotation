#!/bin/bash

set -e

# ---
echo -e '\033[32mRotation started.\033[0m'

# ---
echo -e '\033[33m>> Stopping factorio server...\033[0m'
docker stop factorio || echo -e '\033[31mFailed to stop factorio server.\033[0m'

# ---
echo -e '\033[33m>> Removing factorio server...\033[0m'
docker rm factorio || echo -e '\033[31mFailed to remove factorio server.\033[0m'

# ---
echo -e '\033[33m>> Backing up factory config and saves...\033[0m'
pushd /opt/factorio
tar -cvzf "/opt/rotate-factorio/saves/`date +%Y-%m-%d_%H:%M:%S_%Z`.tgz" \
  config/map-gen-settings.json \
  config/map-settings.json \
  saves
popd

# ---
echo -e '\033[33m>> Deleting factory config and saves...\033[0m'
rm -Rfv \
  /opt/factorio/config/map-gen-settings.json \
  /opt/factorio/config/map-settings.json \
  /opt/factorio/config/server-settings.json \
  /opt/factorio/saves

# ---
echo -e '\033[33m>> Pulling latest factorio server version...\033[0m'
docker pull factoriotools/factorio

# ---
echo -e '\033[33m>> Starting factorio server...\033[0m'
docker run -d \
  -p 34197:34197/udp \
  -v /opt/factorio:/factorio \
  --name factorio \
  --restart=always \
  factoriotools/factorio

# ---
echo -e '\033[33m>> Waiting 5 seconds for server to initialize...\033[0m'
sleep 5

# ---
echo -e '\033[33m>> Stopping server...\033[0m'
docker stop factorio

# ---
echo -e '\033[33m>> Removing default factory saves...\033[0m'
rm -Rfv /opt/factorio/saves

# ---
echo -e '\033[33m>> Configuring server...\033[0m'
./config.php

# ---
echo -e '\033[33m>> Starting factorio server again...\033[0m'
docker start factorio

# ---
echo -e '\033[33m>> Pruning old server versions...\033[0m'
docker system prune -f

# ---
echo -e '\033[32mRotation finished.\033[0m'
