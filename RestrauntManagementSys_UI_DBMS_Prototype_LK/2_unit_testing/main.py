import datetime
import db_connect
from datetime import Error

connection = db_connect.server_connection("127.0.0.1", 3306, "root", "", "rms_c451_lk")

mycursor = connection.cursor()

#try:
   # sql = "INSERT INTO user (username, password, Fname, Lname, tipShare, uPhone, uEmail, permissionID) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)"
  #  val = ("jSmith67", "xkcdIsCool24", "John", "Smith", "5", "3175555555", "js@restaurant.com", "2")
  #  mycursor.execute(sql, val)

  #  connection.commit()

   # print(mycursor.rowcount, "successful upload")
#except Error as err:
 #   print(f"Error: '{err}'")

query =("SHOW DATABASES")
mycursor.execute(query)
for r in mycursor:
    print(r)

pt = datetime.datetime.now()

try:
    sql = "INSERT INTO activeorders (item, placedTime, cookNotes, tableID) VALUES (%s, %s, %s, %s)"
    val = ("steak", pt, "medium rare", 1)
    mycursor.execute(sql, val)

    connection.commit()

    print(mycursor.rowcount, "successful upload")
except Error as err:
    print(f"Error: '{err}'")

# def order_elapsed_time():
    

