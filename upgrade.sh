#!/bin/bash

set -e

# ---
echo -e '\033[32mUpgrade started.\033[0m'

# ---
echo -e '\033[33m>> Stopping factorio server...\033[0m'
docker stop factorio

# ---
echo -e '\033[33m>> Removing factorio server...\033[0m'
docker rm factorio

# ---
echo -e '\033[33m>> Pulling latest container...\033[0m'
docker pull factoriotools/factorio

# ---
echo -e '\033[33m>> Starting factorio server again...\033[0m'
docker run -d \
  -p 34197:34197/udp \
  -v /opt/factorio:/factorio \
  --name factorio \
  --restart=always \
  factoriotools/factorio

# ---
echo -e '\033[32mUpgrade finished.\033[0m'
