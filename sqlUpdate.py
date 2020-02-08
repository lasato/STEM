import mysql.connector

mydb = mysql.connector.connect(
  host="localhost",
  user="user",
  passwd="password",
  database="school"
)

mycursor = mydb.cursor()

sql = "UPDATE students SET name = 'Bob'"

mycursor.execute(sql)

mydb.commit()

print(mycursor.rowcount, "success")
