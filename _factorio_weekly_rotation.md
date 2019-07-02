# Factorio Weekly Rotation Script
## Usage
1. Clone this gist to `/opt/rotate-factorio`
2. Copy `rotate-factorio.timer` and `rotate-factorio.service` to `/etc/systemd/system`, change the timer interval to your preference.
3. Reload systemd and enable the timer and service: `systemctl daemon-reload && systemctl enable rotate-factorio.timer && systemctl enable rotate-factorio.service`
4. Edit `config.php` to your preferences.
5. Start the rotation timer: `systemctl start rotate-factorio.timer`

## License
Copyright © 2019 Carl Bennett

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.