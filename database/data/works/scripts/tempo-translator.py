import pandas as pd

# df = pd.read_csv('works-tempo.csv', index_col='work_id')
# tempos = df['tempo_name'].str.lower().unique()

trans_dict = {
    'adagietto':1,
    'adagio':2,
    'adagio di molto':3,
    'adagio molto':4,
    'allegretto':5,
    'allegretto grazioso':6,
    'allegretto scherzando':7,
    'allegrissimo':8,
    'allegro':9,
    'allegro animato':10,
    'allegro assai':11,
    'allegro con brio':12,
    'allegro con fuoco':13,
    'allegro con moto':14,
    'allegro con spirito':15,
    'allegro feroce':16,
    'allegro ma non troppo':17,
    'allegro maestoso':18,
    'allegro moderato':19,
    'allegro molto':20,
    'allegro non assai':21,
    'allegro non tanto':22,
    'allegro non troppo':23,
    'allegro scherzando':24,
    'allegro vivace':25,
    'allegro vivo':26,
    'andante':27,
    'andante con moto':28,
    'andante moderato':29,
    'andante sostenuto e molto cantabile':30,
    'andantino':31,
    'andantino grazioso':32,
    'con moto':33,
    'grave':34,
    'grazioso e lento, ma non troppo, quasi tempo di valse':35,
    'larghetto':36,
    'larghissimo':37,
    'largo':38,
    'lento':39,
    'marcia moderato':40,
    'moderato':41,
    'moderato, quasi menuetto':42,
    'molto vivace':43,
    'poco adagio':44,
    'poco allegretto':45,
    'poco allegro':46,
    'poco andante':47,
    'poco sostenuto':48,
    'prestissimo':49,
    'presto':50,
    'tempo di marcia':51,
    'tempo di menuetto':52,
    'trio':53,
    'un poco andante':54,
    'vivace':55,
    'vivacissimo':56
}

infile = 'works-tempo.csv'

df = pd.read_csv(infile,index_col='work_id')


df['tempo_name'] = df['tempo_name'].str.lower()

df['tempo_id'] = df['tempo_name'].apply(lambda x: trans_dict[x] if x in trans_dict.keys() else 'MISSING').astype(object)
print(df[df['tempo_id'] == 'MISSING'])

df.to_csv('works-tempo_translated.csv',columns=['tempo_id'])