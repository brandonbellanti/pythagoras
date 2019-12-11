import pandas as pd

trans_dict = {'2/2':1,
'3/2':2,
'2/4':3,
'3/4':4,
'4/4':5,
'5/4':6,
'6/4':7,
'9/4':8,
'3/8':9,
'4/8':10,
'6/8':11,
'7/8':12,
'9/8':13,
'12/8':14}


infile = 'works-time.csv'

df = pd.read_csv(infile,index_col='work_id')

print(df)
df['time_id'] = df['time_name'].apply(lambda x: trans_dict[x] if x in trans_dict.keys() else 'MISSING').astype(object)

df.to_csv('works-time_translated.csv',columns=['time_id'])