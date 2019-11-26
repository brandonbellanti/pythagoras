import matplotlib.pyplot as plt
import pandas as pd
import numpy as np
from lxml import etree
# import click

xml_file = '../scores/JSB_BWV1047_1.xml'

tree = etree.parse(xml_file)
root = tree.getroot()


pitches = []
count = 0
for e in root.xpath('//note'):
    dot = None
    rest = None
    if 'dot' in [child.tag for child in e]:
        dot = True
    if 'rest' in [child.tag for child in e]:
        rest = True

    step_list = e.xpath('.//step/text()')
    step = step_list[0] if len(step_list)>0 else ''
    octave_list = e.xpath('.//octave/text()')
    octave = octave_list[0] if len(step_list)>0 else ''
    print(count,step,octave,dot,rest)
    pitches.append(step)
    count+=1
quit()
types = []
for e in root.xpath('//type'):
    types.append(e.text)



types_df = pd.DataFrame(data=np.array(types), columns=['type'])
pitch_df = pd.DataFrame(data=np.array(pitches), columns=['pitch'])

# fig, ax = plt.subplots()
# types_df['type'].value_counts().plot(kind='pie')
# ax.set_aspect('equal')

fig = plt.figure()

ax1 = fig.add_subplot(211)
ax2 = fig.add_subplot(212)
types_df['type'].value_counts().plot(kind='bar', ax=ax1)

pitch_df['pitch'].value_counts().plot(kind='bar', ax=ax2)

plt.show()
