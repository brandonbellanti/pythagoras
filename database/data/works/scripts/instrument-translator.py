trans_dict = {
    'flute': 1,
    'piccolo': 2,
    'alto flute': 3,
    'oboe': 4,
    'english horn': 5,
    'cor anglais': 5,
    'clarinet': 7,
    'alto clarinet': 8,
    'bass clarinet': 9,
    'bassoon': 10,
    'contrabassoon': 11,
    'double bassoon': 11,
    'french horn': 12,
    'horn': 12,
    'trumpet': 14,
    'trombone': 15,
    'tenor trombone': 15,
    'tuba': 16,
    'euphonium': 17,
    'violin': 18,
    'viola': 19,
    'cello': 20,
    'bass': 21,
    'double bass': 21,
    'strings': 22,
    'harp': 23,
    'piano': 24,
    'pianoforte': 24,
    'organ': 25,
    'harpsichord': 26,
    'clavichord': 27,
    'timpani': 28,
    'glockenspiel': 29,
    'xylophone': 30,
    'vibraphone': 31,
    'marimba': 32,
    'tambourine': 33,
    'chimes': 34,
    'triangle': 35,
    'cymbals': 36,
    'bass drum': 37,
    'snare drum': 38,
    'shaker': 39
}

import pandas as pd


infile = 'works-instrumentation-expanded.csv'

df = pd.read_csv(infile,index_col='work_id')


df['instr_id'] = df['instr_name'].apply(lambda x: trans_dict[x] if x in trans_dict.keys() else 'MISSING').astype(object)
print(df[df['instr_id'] == 'MISSING'])

df.to_csv('works-instrumentation_translated.csv',columns=['instr_id','part_num'])