# Factorio Rotation
Automates the [factoriotools/factorio](https://hub.docker.com/r/factoriotools/factorio) ([source](https://github.com/factoriotools/factorio-docker)) docker container by refreshing the current map/factory at a set interval. This project provides a configuration and set of scripts that allow a user to maintain a Factorio server easily.

Both the upstream project and this project are MIT-licensed. See [LICENSE](./LICENSE.txt) for more info.

## Quick Start
1. Clone this repository: `git clone https://github.com/carlbennett/factorio-rotation.git /opt/rotate-factorio`
2. Copy [`rotate-factorio.timer`](./rotate-factorio.timer) and [`rotate-factorio.service`](./rotate-factorio.service) to `/etc/systemd/system`, change the timer interval (see [`OnCalendar=`](https://www.freedesktop.org/software/systemd/man/systemd.timer.html)) to your preference.
3. Edit [`config.php`](./config.php) to your preferences.
4. Reload systemd and enable the timer and service: `systemctl daemon-reload && systemctl enable rotate-factorio.timer && systemctl enable rotate-factorio.service`
5. Start the rotation timer: `systemctl start rotate-factorio.timer`

## Requirements
* A Linux server running SystemD, such as a modern version of Fedora/CentOS/RHEL.
* [Docker](https://docs.docker.com/install/)
* Bash.
* The php-cli and php-json packages, for using `config.php` \*

\* I plan to convert this script to a more native language at a future date, so that php-cli is no longer required.
