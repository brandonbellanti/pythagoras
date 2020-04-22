import pandas as pd
import numpy as np
import regex as re
import sqlite3
import csv
import os

df = pd.read_csv('/Users/BrandonBel/Desktop/MusicXML_scores/csv/Beethoven-67c.csv')

def df_cleaner(df):
    pitch_dict = {'A0':'1','G##0':'1','Bbb0':'1','A#0':'2','Bb0':'2','Cbb1':'2','B0':'3','Cb1':'3','A##0':'3','C1':'4','B#0':'4','Dbb1':'4','C#1':'5','Db1':'5','B##1':'5','D1':'6','C##1':'6','Ebb1':'6','D#1':'7','Eb1':'7','Fbb1':'7','E1':'8','Fb1':'8','D##1':'8','1':'8','F1':'9','E#1':'9','Gbb1':'9','F#1':'10','Gb1':'10','E##1':'10','G1':'11','F##1':'11','Abb1':'11','G#1':'12','Ab1':'12','A1':'13','G##1':'13','Bbb1':'13','A#1':'14','Bb1':'14','Cbb1':'14','B1':'15','Cb1':'15','A##1':'15','C2':'16','B#2':'16','Dbb2':'16','C#2':'17','Db2':'17','B##2':'17','D2':'18','C##2':'18','Ebb2':'18','D#2':'19','Eb2':'19','Fbb2':'19','E2':'20','Fb2':'20','D##2':'20','2':'20','F2':'21','E#2':'21','Gbb2':'21','F#2':'22','Gb2':'22','E##2':'22','G2':'23','F##2':'23','Abb2':'23','G#2':'24','Ab2':'24','A2':'25','G##2':'25','Bbb2':'25','A#2':'26','Bb2':'26','Cbb2':'26','B2':'27','Cb2':'27','A##2':'27','C3':'28','B#3':'28','Dbb3':'28','C#3':'29','Db3':'29','B##3':'29','D3':'30','C##3':'30','Ebb3':'30','D#3':'31','Eb3':'31','Fbb3':'31','E3':'32','Fb3':'32','D##3':'32','3':'32','F3':'33','E#3':'33','Gbb3':'33','F#3':'34','Gb3':'34','E##3':'34','G3':'35','F##3':'35','Abb3':'35','G#3':'36','Ab3':'36','A3':'37','G##3':'37','Bbb3':'37','A#3':'38','Bb3':'38','Cbb3':'38','B3':'39','Cb3':'39','A##3':'39','C4':'40','B#4':'40','Dbb4':'40','C#4':'41','Db4':'41','B##4':'41','D4':'42','C##4':'42','Ebb4':'42','D#4':'43','Eb4':'43','Fbb4':'43','E4':'44','Fb4':'44','D##4':'44','4':'44','F4':'45','E#4':'45','Gbb4':'45','F#4':'46','Gb4':'46','E##4':'46','G4':'47','F##4':'47','Abb4':'47','G#4':'48','Ab4':'48','A4':'49','G##4':'49','Bbb4':'49','A#4':'50','Bb4':'50','Cbb4':'50','B4':'51','Cb4':'51','A##4':'51','C5':'52','B#5':'52','Dbb5':'52','C#5':'53','Db5':'53','B##5':'53','D5':'54','C##5':'54','Ebb5':'54','D#5':'55','Eb5':'55','Fbb5':'55','E5':'56','Fb5':'56','D##5':'56','5':'56','F5':'57','E#5':'57','Gbb5':'57','F#5':'58','Gb5':'58','E##5':'58','G5':'59','F##5':'59','Abb5':'59','G#5':'60','Ab5':'60','A5':'61','G##5':'61','Bbb5':'61','A#5':'62','Bb5':'62','Cbb5':'62','B5':'63','Cb5':'63','A##5':'63','C6':'64','B#6':'64','Dbb6':'64','C#6':'65','Db6':'65','B##6':'65','D6':'66','C##6':'66','Ebb6':'66','D#6':'67','Eb6':'67','Fbb6':'67','E6':'68','Fb6':'68','D##6':'68','6':'68','F6':'69','E#6':'69','Gbb6':'69','F#6':'70','Gb6':'70','E##6':'70','G6':'71','F##6':'71','Abb6':'71','G#6':'72','Ab6':'72','A6':'73','G##6':'73','Bbb6':'73','A#6':'74','Bb6':'74','Cbb6':'74','B6':'75','Cb6':'75','A##6':'75','C7':'76','B#7':'76','Dbb7':'76','C#7':'77','Db7':'77','B##7':'77','D7':'78','C##7':'78','Ebb7':'78','D#7':'79','Eb7':'79','Fbb7':'79','E7':'80','Fb7':'80','D##7':'80','7':'80','F7':'81','E#7':'81','Gbb7':'81','F#7':'82','Gb7':'82','E##7':'82','G7':'83','F##7':'83','Abb7':'83','G#7':'84','Ab7':'84','A7':'85','G##7':'85','Bbb7':'85','A#7':'86','Bb7':'86','Cbb8':'86','B7':'87','Cb8':'87','A##7':'87','C8':'88','B#7':'88','Dbb8':'88'}
    df['octave'] = df['octave'].loc[df['octave'].notna()].astype(int).astype(str)
    df['keyboard_step'] = df['pitch'] + df['octave']
    df['keyboard_step'].fillna('', inplace=True)
    df['keyboard_step'] = df['keyboard_step'].apply(lambda x: int(pitch_dict[x]) if len(x)>0 else None)
    df['interval'] = df['keyboard_step'].diff()
    return df

def series_to_string_dict(df):
    string_dict = {}
    parts = df['part'].unique()
    for part in parts:
        part_df = df[df['part'] == part].fillna('')
        steps = part_df['interval'].to_string(index=False, header=False)
        steps = re.sub(r'\n','.',steps)
        steps = re.sub(r' ','',steps)
        string_dict[part] = steps
    return string_dict

def find_patterns(string_dict, min_length, min_occur):
    pattern_list = []
    for part in string_dict:
        string = string_dict[part]
        pat = r'((?<=\.)[^.]+\.(?:[^.]*\.){%d,}[^.]+(?=\.))(?:.*\1){%d,}' % (min_length-2, min_occur-1)
        patterns = re.findall(pat,string,overlapped=True)
        for pattern in patterns:
            if pattern not in pattern_list:
                pattern_list.append(pattern)
        print("Completed:",part)
        for pattern in pattern_list:
            print(pattern)
            max_length = len(pattern.split('.'))
            print(max_length)
            for length in range(max_length,min_length-1,-1):
                print(length)
                pat = r'(^[^.]+\.(?:[^.]*\.){%d}[^.]+)' % (length-2)
                alt_patterns = re.findall(pat,pattern,overlapped=True)
                for alt_pattern in alt_patterns:
                    print(alt_pattern)
                    if alt_pattern not in pattern_list:
                        pattern_list.append(alt_pattern)
        quit()
    return pattern_list

df = df_cleaner(df)
pattern_list = find_patterns(series_to_string_dict(df), min_length=3, min_occur=6)
print()
print(len(pattern_list))
print()
print(pattern_list)