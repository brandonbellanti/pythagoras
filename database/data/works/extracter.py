import pandas as pd 

works_file = 'works.csv'

df = pd.read_csv(works_file, index_col='work_id')

df = df[['KEY','TIME','TEMPO']]

print(df)

df.to_csv('works_formatted.csv')