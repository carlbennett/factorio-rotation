#!/bin/bash

set -e

# ---
echo -e '\033[32mReconfigure started.\033[0m'

# ---
echo -e '\033[33m>> Stopping factorio server...\033[0m'
docker stop factorio

# ---
echo -e '\033[33m>> Configuring server...\033[0m'
./config.php keep_map_settings=1

# ---
echo -e '\033[33m>> Starting factorio server again...\033[0m'
docker start factorio

# ---
echo -e '\033[32mReconfigure finished.\033[0m'
