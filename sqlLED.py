import pymysql
import RPi.GPIO as GPIO
import time

GPIO.setmode(GPIO.BCM)
GPIO.setwarnings(False)
GPIO.setup(18,GPIO.OUT)
            
lightValue = []
db = pymysql.connect(host="localhost", user="user", passwd="password", db="school")
db.autocommit(True)
# Create cursor
cur = db.cursor(pymysql.cursors.DictCursor)

# Create table as per requirement
def grabValue():
    sql = "SELECT * from students"

    cur.execute(sql)

    rows = cur.fetchmany(0)
 
    for row in rows:
        global lightValue
        #print(int(row["ledStatus"]))
        lightValue = int(row["ledStatus"])
        if lightValue == 1:
            print("Light is on")
            print("Light Value : " + str(lightValue))
            print("LED on")
            GPIO.output(18,GPIO.HIGH)
        else:
            print("Light is off")
            print("Light Value : " + str(lightValue))
            print("LED off")
            GPIO.output(18,GPIO.LOW)

import time
starttime=time.time()
while True:
  print("-----")
  grabValue()
  time.sleep(1.0 - ((time.time() - starttime) % 1.0))
  



# close connection
cur.close()
db.close()



