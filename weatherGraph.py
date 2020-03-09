print("end me")
import Adafruit_DHT
import time
import pymysql
from datetime import datetime

# Set sensor type : Options are DHT11,DHT22 or AM2302
sensor=Adafruit_DHT.DHT11
 
# Set GPIO sensor is connected to
gpio=18
 
# Use read_retry method. This will retry up to 15 times to
# get a sensor reading (waiting 2 seconds between each retry).
humidity, temperature = Adafruit_DHT.read_retry(sensor, gpio)
 
# Reading the DHT11 is very sensitive to timings and occasionally
# the Pi might fail to get a valid reading. So check if readings are valid.
def grabTempHum():
    if humidity is not None and temperature is not None:    
        print(temperature)
        print(humidity)
        print(datetime.now())
        timeGrab1 = datetime.now()
        floatTemp = temperature
        floatHumid = humidity
        db = pymysql.connect(host="192.168.0.216", user="remote", passwd="anime", db="weatherData")
        db.autocommit(True)
        cur = db.cursor(pymysql.cursors.DictCursor)
        sql = "SELECT * FROM dataTable"
        sql = f"INSERT INTO dataTable (`temp`, `humid`, `time`) VALUES ({floatTemp}, {floatHumid}, '{timeGrab1}')"
        cur.execute(sql)
        #Close Connection
        cur.close()
        db.close()
        
    else:
        print('Failed to get reading. Try again!')
        print(temperature)
                
        
        #sql = "UPDATE dataTable SET dataInt=1";






starttime=time.time()
while True:
    print("-----")
    grabTempHum()
    time.sleep(3 - ((time.time() - starttime) % 3))



