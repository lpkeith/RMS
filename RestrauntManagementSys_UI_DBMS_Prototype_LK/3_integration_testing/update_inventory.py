import db_connect
import pymysql
from pymysql import Error


connection = db_connect.server_connection("127.0.0.1", 3306, "root", "", "rms_c451_lk")

mycursor = connection.cursor()

def pass_inv_var(ingredientID, ingredientName, inventoryQty, UOM):
    try:
        sql = "INSERT INTO ingredients (ingredientID, ingredientName, inventoryQty, UOM) VALUES (%s, %s, %s, %s)"
        val = (ingredientID, ingredientName, inventoryQty, UOM)
        mycursor.execute(sql, val)

        connection.commit()

        print(mycursor.rowcount, "successful upload")
    except Error as err:
        print(f"Error: '{err}'")