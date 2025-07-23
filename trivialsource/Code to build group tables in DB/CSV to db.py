import mysql.connector
from mysql.connector import Error
try:
    conn = msql.connect(host='localhost:3306', user='root',
                        password='root@123')#give ur username, password
    if conn.is_connected():
        cursor = conn.cursor()
        cursor.execute("CREATE DATABASE Groups")
        print("Database is created")
except Error as e:
    print("Error while connecting to MySQL", e)
