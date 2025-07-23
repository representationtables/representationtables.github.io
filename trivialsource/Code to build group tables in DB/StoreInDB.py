# Read csv file
import mysql
import pandas as pd
import csv
import numpy as np
#######################################3
from mysql.connector import Error

for i in range(1,121):
    file_name = f"C:/xampp/htdocs/Project_DB_test/Groups_of_order_{i}.csv"
    data = pd.read_csv(file_name, header=None, index_col=False, delimiter=',')
    data.columns=['a','b','c','d','e','f']
    #print(len(data))

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
            cursor.execute(f"CREATE TABLE group_order_{i} (group_order INT, group_name varchar(255), label varchar(50), id_whole varchar(255), id_only INT);")
            print("Table is created....")

            # if(len(data)<=9):
            #     # loop through the data frame
            #     for j, row in data.iterrows():
            #         # print(row[5]);
            #         # here %S means string values
            #         g_name_whole = row[1].split(';')
            #         g_name = g_name_whole[0]

            #         sql = f"INSERT INTO all_groups.group_order_{i} VALUES (%s,%s)"
            #         values = (g_name, row[5])
            #         cursor.execute(sql, values)

            #         # the connection is not auto committed by default, so we must commit to save our changes
            #         conn.commit()
            #     print('\n')
            #     cursor.execute(f'ALTER TABLE group_order_{i} ORDER BY id ASC;')
            #     conn.commit()
            # else:
            #     # loop through the data frame
            #     for j, row in data.iterrows():
            #         # print(row[5]);
            #         # here %S means string values
            #         g_name_whole = row[1].split(';')
            #         g_name = g_name_whole[0]

            #         sql = f"INSERT INTO all_groups.group_order_{i} VALUES (%s,%s)"
            #         values = (g_name, row[5])
            #         cursor.execute(sql, values)

            #         # the connection is not auto committed by default, so we must commit to save our changes
            #         conn.commit()
            #     print('\n')

            #Sort on id
            list_id=[]
            for j, row in data.iterrows():
                id_whole=row[5]
                id_whole=id_whole.split(',')
                id_only=int(id_whole[1])

                list_id.append(id_only)
            array_id=np.array(list_id)
            id_dataframe=pd.DataFrame(array_id, columns=['id'])
            data=pd.concat([data, id_dataframe], axis=1)
            data= data.sort_values(by=['id'])




            #storing in database

            for j, row in data.iterrows():
                g_order=i
                g_name_whole = row[1].split(';')
                g_name = g_name_whole[0]
                g_label=row[4]
                g_id_whole=row[5]
                g_id_only=row[6]
                sql = f"INSERT INTO all_groups.group_order_{i} VALUES (%s,%s,%s,%s,%s);"
                values = (g_order,g_name,g_label,g_id_whole,g_id_only)
                cursor.execute(sql, values)

                    # the connection is not auto committed by default, so we must commit to save our changes
                conn.commit()

    except Error as e:
        print("Error while connecting to MySQL", e)

#######################################33
#Merge into 1 table

try:

    if conn.is_connected():
        cursor = conn.cursor()
        cursor.execute("select database();")
        record = cursor.fetchone()
        print("You're connected to database: ", record)
        cursor.execute(f'DROP TABLE IF EXISTS all_groups_in_one;')
        print('Creating table....')
        # in the below line please pass the create table statement which you want #to create
        cursor.execute(f"CREATE TABLE all_groups_in_one(group_order INT, group_name varchar(255), label varchar(50), id_whole varchar(255), id_only INT);")
        print("Table is created....")


except Error as e:
    print("Error while connecting to MySQL", e)

for i in range(61,121):
    #file_name = f"C:/Users/jaiky/PycharmProjects/Project_DB_test/Groups_of_order_{i}.csv"
    #data = pd.read_csv(file_name, header=None, index_col=False, delimiter=',')
    #print(len(data))

    try:
        cursor.execute(f"SELECT * FROM all_groups.group_order_{i};")
        myresult = cursor.fetchall()

        for x in myresult:

            sql = f"INSERT INTO all_groups.all_groups_in_one VALUES (%s,%s,%s,%s,%s);"
            values = (x[0],x[1],x[2],x[3],x[4])
            cursor.execute(sql, values)

            # the connection is not auto committed by default, so we must commit to save our changes
            conn.commit()



    except Error as e:
        print("Error while connecting to MySQL", e)
# #Merge two csv files
# file1_name = f"C:/Users/jaiky/PycharmProjects/Project_DB_test/GroupsDataSizes1to60.csv"
# file2_name = f"C:/Users/jaiky/PycharmProjects/Project_DB_test/group_names.csv"



