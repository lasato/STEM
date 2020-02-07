#Import MySQLdb
import MySQLdb

#Initiate connection to server DB
db = MySQLdb.connect(host="localhost", user="school", passwd="password", db="school")

# Create cursor
cur = db.cursor(MySQLdb.cursors.DictCursor)

# Autocommit
#db.autocommit(True)
db.autocommit = True

#Ask user for name and job
name = input("What is your name? ")
age = input("What is your age? ")
gradeLevel = input("What grade are in you in?")
int_grade = int(gradeLevel)
int_age = int(age)


def nameThatType(parameter1):
	loVar = "kill me"
	print(parameter1)
def nameThatType2 (parameter2)
	print(parameter2)
	
returnedData = nameThatType2(int_age)	
returnedData = nameThatType(name)
	
#Return Datatype
print(type(name))
print(type(int_age))
print(type(int_grade))


#Shame them.
print(f"Your name is {name}, and you are {int_age} years old. ")

#Autocommit
#db.autocommit(True)

#Insert data into table
sql = f"INSERT INTO `students` (`name`, `age`, `gradeLevel`) VALUES ('{name}', {int_age}, {int_grade})"
cur.execute(sql)

# Create table as per requirement
sql = "SELECT * from students"

cur.execute(sql)

rows = cur.fetchall()
for row in rows:
	print(row)

# close connection
cur.close()
db.close()

