serverUrl='http://127.0.0.1:4444'
serverVersion='2.32.0'
serverFile=selenium-server-standalone-$serverVersion.jar
firefoxUrl=http://ftp.mozilla.org/pub/mozilla.org/firefox/releases/21.0/linux-x86_64/en-US/firefox-21.0.tar.bz2
firefoxFile=firefox.tar.bz2
fixturePort=8080
phpVersion=`php -v`

pear channel-discover pear.phpunit.de
pear install phpunit/PHP_Invoker
pear install phpunit/DbUnit
pear install phpunit/PHPUnit_Selenium
pear install phpunit/PHPUnit_Story

echo "Downloading Firefox"
wget $firefoxUrl -O $firefoxFile
tar xvjf $firefoxFile

echo "Starting xvfb"
echo "Starting Selenium"
if [ ! -f $serverFile ]; then
    wget http://selenium.googlecode.com/files/selenium-server-standalone-$serverVersion.jar -O $serverFile
fi
xvfb-run java -Dwebdriver.firefox.bin=firefox/firefox-bin  -jar $serverFile > /tmp/selenium.log 2>&1 &

wget --retry-connrefused --tries=60 --waitretry=1 --output-file=/dev/null $serverUrl/wd/hub/status -O /dev/null
if [ ! $? -eq 0 ]; then
    echo "Selenium Server not started"
else
    echo "Finished setup"
fi