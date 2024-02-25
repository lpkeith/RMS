import db_connect
import datetime


connection = db_connect.server_connection("127.0.0.1", 3306, "root", "", "rms_c451_lk")

mycursor = connection.cursor()

query =("SELECT placedTime FROM activeorders")
mycursor.execute(query)
record = mycursor.fetchone()
print(record)

pt = record

ct = datetime.datetime.now()

# et = ct - pt

# print(et)

mycursor.close()

connection.close()