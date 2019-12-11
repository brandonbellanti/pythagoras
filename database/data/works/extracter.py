import pandas as pd 

works_file = 'works.csv'

df = pd.read_csv(works_file, index_col='work_id',dtype='object')

# print(df.columns)


tempo_df = df['TEMPO']
tempo_df.to_csv('works-tempo.csv',header=['tempo_name'])

time_df = df['TIME']
time_df.to_csv('works-time.csv',header=['time_name'])

instrumentation_df = df['INSTRUMENTATION']
instrumentation_df.to_csv('works-instrumentation.csv',header=['instrument_name'])


columns = ['work_title', 'work_alttitle', 'work_opus', 'work_identifier',
       'work_mvtitle', 'work_mvnumber', 'work_yearbegun', 'work_yearcompleted',
       'work_yearpublished', 'work_yearpremiered', 'work_relatedto', 'work_measures',
       'work_genre', 'work_form', 'work_note', 'work_wiki',
       'work_imslp', 'work_viaf', 'comp_id', 'era_id']

df.to_csv('works_formatted.csv',columns=columns)