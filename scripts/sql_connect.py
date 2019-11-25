import mysql.connector
from mysql.connector import Error


def connect():
    """ Connect to MySQL database """
    conn = None
    try:
        conn = mysql.connector.connect(host='canary.simmons.edu',
                                       database='lis45801fa19_bellanti_3',
                                       user='BrandonBel',
                                       password='1924917')
        if conn.is_connected():
            print('Connected to MySQL database')
 
    except Error as e:
        print(e)
 
    finally:
        if conn is not None and conn.is_connected():
            conn.close()

connect()


