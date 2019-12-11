import pandas as pd

key_dict = {
    'Cb major':1,
    'Gb major':2,
    'Db major':3,
    'Ab major':4,
    'Eb major':5,
    'Bb major':6,
    'F major':7,
    'C major':8,
    'G major':9,
    'D major':10,
    'A major':11,
    'E major':12,
    'B major':13,
    'F# major':14,
    'C# major':15,
    'Ab minor':16,
    'Eb minor':17,
    'Bb minor':18,
    'F minor':19,
    'C minor':20,
    'G minor':21,
    'D minor':22,
    'A minor':23,
    'E minor':24,
    'B minor':25,
    'F# minor':26,
    'C# minor':27,
    'G# minor':28,
    'D# minor':29,
    'A# minor':30
}

infile = 'works-key.csv'

df = pd.read_csv(infile,index_col='work_id')

# print(df)

df['key_id'] = df['key_name'].apply(lambda x: key_dict[x] if x in key_dict.keys() else 'MISSING').astype(object)

# print(df[df['key_name'] == "MISSING"])

df.to_csv('works-key_translated.csv',columns=['key_id'])