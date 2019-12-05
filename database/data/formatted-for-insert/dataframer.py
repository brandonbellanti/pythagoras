import pandas as pd 

works_df = pd.read_csv('works.csv')
# print(len(works_df["work_tempomark"]))
# print(len(works_df["work_tempomark"].unique()))
tempos_df = pd.read_csv('tempos.csv')

tempo_series = works_df["key_id"].drop_duplicates()

print(tempo_series)