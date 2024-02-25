import pymysql
from pymysql import Error





def server_connection(host_name, port_num, user_name, user_password, database_name):
    connection = None
    try:
        connection = pymysql.connect(
            host= host_name,
            port = port_num,
            user = user_name,
            passwd = user_password,
            database = database_name
        )
        print("Database successfully connected")
    except Error as err:
        print(f"Error: '{err}'")
    
    return connection