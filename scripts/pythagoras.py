import pandas as pd
import numpy as np
import matplotlib.pyplot as plt
from lxml import etree
import re
import csv
from collections import Counter


xml_filepath = "../scores/JSB_BWV1047_1.xml"
csv_filepath = "../scores/JSB_BWV1047_1.csv"

def xml_to_csv(xml_filepath,csv_filepath):
    with open(csv_filepath, 'w') as outfile:
        writer = csv.writer(outfile,quoting=csv.QUOTE_MINIMAL)
        header = ['part','measure','step','alter','octave','duration','type','dotted','rest']
        writer.writerow(header)
        tree = etree.parse(xml_filepath)
        root = tree.getroot()
        # notes = []
        # count = 0
        for e in root.xpath('//note'):
            
            part = e.xpath('../..//@id')[0]
            
            measure = e.xpath('..//@number')[0]
            
            dotted = True if 'dot' in [child.tag for child in e] else False

            rest = True if 'rest' in [child.tag for child in e] else False
            
            duration_list = e.xpath('.//duration/text()')
            duration = duration_list[0] if len(duration_list)>0 else ''
            
            typ_list = e.xpath('.//type/text()')
            typ = typ_list[0] if len(typ_list)>0 else ''

            
            step_list = e.xpath('.//step/text()')
            step = step_list[0] if len(step_list)>0 else ''
            
            alter_list = e.xpath('.//alter/text()')
            alter = alter_list[0] if len(alter_list)>0 else ''
            
            octave_list = e.xpath('.//octave/text()')
            octave = octave_list[0] if len(step_list)>0 else ''
            
            # print("\t".join([str(count),part,str(measure),step,octave,duration,typ,dotted,rest]))
            # notes.append((part,measure,step,alter,octave,duration,typ,dotted,rest))
            writer.writerow([part,measure,step,alter,octave,duration,typ,dotted,rest])
            # count += 1

# xml_to_csv(xml_filepath,csv_filepath)
# quit()


# df = pd.DataFrame(notes,columns=['part','measure','step','alter','octave','duration','type','dotted','rest'])

df = pd.read_csv(csv_filepath)
# print(df)
# test = len(df[df['alter'] == 1])
# test = len(df[df['alter'] == -1])

def signed(x):
    if df['alter'] == 1:
        x += '#'
    elif df['alter'] == -1:
        x += 'b'
    return x

# df['signed_step'] = df['step'].apply(lambda x: signed(x))
df['signed_step'] = df['step'][df['alter'] == 1].apply(lambda x: x + '#')
df['signed_step'] = df['step'][df['alter'] == -1].apply(lambda x: x + 'b')

print(df.head(1000))

quit()






col = 'alter'
df.groupby(col).type.count().plot.barh()
plt.xlabel('Count')
plt.ylabel('Group')




steps = df['step'].to_string(index=False)
steps = re.sub(r'\n|\t| ','',s)
print(steps)



length = 8
pat = r'(?=(.{%d,})(?=.*\1))' % length

step_patterns = re.findall(pat,steps)

print(Counter(step_patterns))