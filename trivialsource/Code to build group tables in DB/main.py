# This is a sample Python script.

# Press Shift+F10 to execute it or replace it with your code.
# Press Double Shift to search everywhere for classes, files, tool windows, actions, and settings.
"""import mysql.connector

mydb = mysql.connector.connect(
  host="localhost",
  user="root",
  password="root@123"
)

mycursor = mydb.cursor()

#Create database
#mycursor.execute("CREATE DATABASE all_groups")

#Shows databases
mycursor.execute("SHOW DATABASES")
for x in mycursor:
  print(x)
"""


"""
# Read csv file
import mysql
import pandas as pd

#######################################3
from mysql.connector import Error

for i in range(1, 61):
    file_name = f"C:/Users/jaiky/PycharmProjects/Project_DB_test/Groups_of_order_{i}.csv"
    data = pd.read_csv(file_name, header=None, index_col=False, delimiter=',')

    try:
        conn = mysql.connector.connect(host='localhost', database='all_groups', user='root', password='root@123')
        if conn.is_connected():
            cursor = conn.cursor()
            cursor.execute("select database();")
            record = cursor.fetchone()
            print("You're connected to database: ", record)
            cursor.execute(f'DROP TABLE IF EXISTS group_order_{i};')
            print('Creating table....')
            # in the below line please pass the create table statement which you want #to create
            cursor.execute(f"CREATE TABLE group_order_{i}(group_order varchar(255),group_name varchar(255),d int,p varchar(255),label varchar(255),id varchar(255))")
            print("Table is created....")
            # loop through the data frame
            for j, row in data.iterrows():
                # here %S means string values
                sql = f"INSERT INTO all_groups.group_order_{i} VALUES (%s,%s,%s,%s,%s,%s)"
                cursor.execute(sql, tuple(row))
                print(tuple(row))
                # the connection is not auto committed by default, so we must commit to save our changes
                conn.commit()
    except Error as e:
        print("Error while connecting to MySQL", e)

#######################################33
"""

"""
import mysql.connector

mydb = mysql.connector.connect(
  host="localhost",
  user="root",
  password="root@123"
)

mycursor = mydb.cursor()

#Create database
mycursor.execute("CREATE DATABASE Groups_1_to_60")

#Shows databases
mycursor.execute("SHOW DATABASES")
for x in mycursor:
  print(x)

"""
# Read csv file
import mysql
import pandas as pd

#######################################3
from mysql.connector import Error


file_name = f"C:/Users/jaiky/PycharmProjects/Project_DB_test/Book1.csv"
data = pd.read_csv(file_name, header=None, index_col=False, delimiter=';')

try:
    conn = mysql.connector.connect(host='localhost', database='Groups_1_to_60', user='root', password='root@123')

    if conn.is_connected():
        cursor = conn.cursor()
        cursor.execute("select database();")
        record = cursor.fetchone()
        print("You're connected to database: ", record)
        cursor.execute(f'DROP TABLE IF EXISTS all_groups;')
        print('Creating table....')
        # in the below line please pass the create table statement which you want #to create
        cursor.execute(f"CREATE TABLE all_groups(group_order varchar(10),group_id varchar(255),structure_description varchar(255),  characteristic varchar(255), group_name varchar(255));")
        print("Table is created....")
        # loop through the data frame
        for j, row in data.iterrows():
            # here %S means string values
            print(tuple(row))
            sql = f"INSERT INTO Groups_1_to_60.all_groups VALUES (%s,%s,%s,%s,%s);"
            cursor.execute(sql, tuple(row))
            print(tuple(row))
            # the connection is not auto committed by default, so we must commit to save our changes
            conn.commit()
except Error as e:
    print("Error while connecting to MySQL", e)

