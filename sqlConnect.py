import MySQLdb

db = MySQLdb.connect(host="localhost", user="user", passwd="password", db="school")
db.autocommit(True)
# Create cursor
cur = db.cursor(MySQLdb.cursors.DictCursor)

# Create table as per requirement
sql = "SELECT * from students"

cur.execute(sql)

rows = cur.fetchall()
for row in rows:
	print(row)

# close connection
cur.close()
db.close()
