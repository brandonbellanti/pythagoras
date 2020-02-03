import pandas as pd
import numpy as np
import matplotlib.pyplot as plt
from lxml import etree
import re
import os
import csv
from collections import Counter

# if not os.path.exists('../images'):
#     os.mkdir('../images')
# if not os.path.exists('../images/figures'):
#     os.mkdir('../images/figures')


mv_1 = "JSB_BWV1047_1"
mv_2 = "JSB_BWV1047_2"
mv_3 = "JSB_BWV1047_3"
movements = [mv_1,mv_2,mv_3]


composer = 'Johann Sebastian Bach (1685-1750)'
work_title = "Brandenburg Concerto No. 2 in F major"
mv_titles = {
    mv_1:'I. Allegro',
    mv_2:'II. Andante',
    mv_3:'III. Allegro assai'
}


key_dict = {
    '-7':'Cb major (Ab minor)',
    '-6':'Gb major (Eb minor)',
    '-5':'Db major (Bb minor)',
    '-4':'Ab major (F minor)',
    '-3':'Eb major (C minor)',
    '-2':'Bb major (G minor)',
    '-1':'F major (D minor)',
    '0':'C major (A minor)',
    '1':'G major (E minor)',
    '2':'D major (B minor)',
    '3':'A major (F# minor)',
    '4':'E major (C# minor)',
    '5':'B major (G# minor)',
    '6':'F# major (D# minor)',
    '7':'C# major (A# minor)'
}


pitch_dict = {'A0':'1','G##0':'1','Bbb0':'1','A#0':'2','Bb0':'2','Cbb1':'2','B0':'3','Cb1':'3','A##0':'3','C1':'4','B#0':'4','Dbb1':'4','C#1':'5','Db1':'5','B##1':'5','D1':'6','C##1':'6','Dbb1':'6','D#1':'7','Eb1':'7','Fbb1':'7','E1':'8','Fb1':'8','D##1':'8','1':'8','F1':'9','E#1':'9','Gbb1':'9','F#1':'10','Gb1':'10','E##1':'10','G1':'11','F##1':'11','Abb1':'11','G#1':'12','Ab1':'12','A1':'13','G##1':'13','Bbb1':'13','A#1':'14','Bb1':'14','Cbb1':'14','B1':'15','Cb1':'15','A##1':'15','C2':'16','B#2':'16','Dbb2':'16','C#2':'17','Db2':'17','B##2':'17','D2':'18','C##2':'18','Dbb2':'18','D#2':'19','Eb2':'19','Fbb2':'19','E2':'20','Fb2':'20','D##2':'20','2':'20','F2':'21','E#2':'21','Gbb2':'21','F#2':'22','Gb2':'22','E##2':'22','G2':'23','F##2':'23','Abb2':'23','G#2':'24','Ab2':'24','A2':'25','G##2':'25','Bbb2':'25','A#2':'26','Bb2':'26','Cbb2':'26','B2':'27','Cb2':'27','A##2':'27','C3':'28','B#3':'28','Dbb3':'28','C#3':'29','Db3':'29','B##3':'29','D3':'30','C##3':'30','Dbb3':'30','D#3':'31','Eb3':'31','Fbb3':'31','E3':'32','Fb3':'32','D##3':'32','3':'32','F3':'33','E#3':'33','Gbb3':'33','F#3':'34','Gb3':'34','E##3':'34','G3':'35','F##3':'35','Abb3':'35','G#3':'36','Ab3':'36','A3':'37','G##3':'37','Bbb3':'37','A#3':'38','Bb3':'38','Cbb3':'38','B3':'39','Cb3':'39','A##3':'39','C4':'40','B#4':'40','Dbb4':'40','C#4':'41','Db4':'41','B##4':'41','D4':'42','C##4':'42','Dbb4':'42','D#4':'43','Eb4':'43','Fbb4':'43','E4':'44','Fb4':'44','D##4':'44','4':'44','F4':'45','E#4':'45','Gbb4':'45','F#4':'46','Gb4':'46','E##4':'46','G4':'47','F##4':'47','Abb4':'47','G#4':'48','Ab4':'48','A4':'49','G##4':'49','Bbb4':'49','A#4':'50','Bb4':'50','Cbb4':'50','B4':'51','Cb4':'51','A##4':'51','C5':'52','B#5':'52','Dbb5':'52','C#5':'53','Db5':'53','B##5':'53','D5':'54','C##5':'54','Dbb5':'54','D#5':'55','Eb5':'55','Fbb5':'55','E5':'56','Fb5':'56','D##5':'56','5':'56','F5':'57','E#5':'57','Gbb5':'57','F#5':'58','Gb5':'58','E##5':'58','G5':'59','F##5':'59','Abb5':'59','G#5':'60','Ab5':'60','A5':'61','G##5':'61','Bbb5':'61','A#5':'62','Bb5':'62','Cbb5':'62','B5':'63','Cb5':'63','A##5':'63','C6':'64','B#6':'64','Dbb6':'64','C#6':'65','Db6':'65','B##6':'65','D6':'66','C##6':'66','Dbb6':'66','D#6':'67','Eb6':'67','Fbb6':'67','E6':'68','Fb6':'68','D##6':'68','6':'68','F6':'69','E#6':'69','Gbb6':'69','F#6':'70','Gb6':'70','E##6':'70','G6':'71','F##6':'71','Abb6':'71','G#6':'72','Ab6':'72','A6':'73','G##6':'73','Bbb6':'73','A#6':'74','Bb6':'74','Cbb6':'74','B6':'75','Cb6':'75','A##6':'75','C7':'76','B#7':'76','Dbb7':'76','C#7':'77','Db7':'77','B##7':'77','D7':'78','C##7':'78','Dbb7':'78','D#7':'79','Eb7':'79','Fbb7':'79','E7':'80','Fb7':'80','D##7':'80','7':'80','F7':'81','E#7':'81','Gbb7':'81','F#7':'82','Gb7':'82','E##7':'82','G7':'83','F##7':'83','Abb7':'83','G#7':'84','Ab7':'84','A7':'85','G##7':'85','Bbb7':'85','A#7':'86','Bb7':'86','Cbb8':'86','B7':'87','Cb8':'87','A##7':'87','C8':'88','B#7':'88','Dbb8':'88'}



for mv in mv_titles:

    print("\nSTART\n")

    mv_title = work_title + ', ' + mv_titles[mv]


    xml_filepath = "../scores/xml/" + mv +'.xml'
    csv_filepath = "../scores/csv/" + mv +'.csv'
    html_filepath ="../scores/html/" + mv +'.html'


    print('Parsing XML file:',xml_filepath)
    tree = etree.parse(xml_filepath)
    root = tree.getroot()


    parts = {}
    for e in root.xpath('//score-part'):
        part = e.xpath('./@id')[0]
        instrument = e.xpath('.//part-name')[0].text
        parts[part] = instrument



    # get key signature and time signature from attributes for part 1

    attrib_list = root.xpath("//part[@id='P1']/measure[@number='1']/attributes/*")

    for e in attrib_list:

        if e.tag == 'key':
            accidentals = e.xpath('./fifths')[0].text
            mode = e.xpath('./mode')[0].text
            key_sig = key_dict[accidentals]
            key_img = '../images/key_sigs/%s.png' % accidentals

        if e.tag == 'time':
            beats = e.xpath('./beats')[0].text
            val = e.xpath('./beat-type')[0].text
            time_sig = "%s/%s" % (beats,val)









    print("Writing CSV file:", csv_filepath)
    with open(csv_filepath,'w') as csv_file:
        csv_writer = csv.writer(csv_file)
        header = ('part','instrument','measure','pitch','step','alter','octave','duration','type','dotted','rest')
        csv_writer.writerow(header)


        # notes = []

        for e in root.xpath('//note'):
            
            part = e.xpath('../..//@id')[0]

            instrument = parts[part]
            
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
            if alter == '0':
                accidental = ''
            elif alter == '-1':
                accidental = 'b'
            elif alter == '1':
                accidental = '#'
            elif alter == '-2':
                accidental = 'bb'
            elif alter == '2':
                accidental = '##'
            else:
                accidental = ''

            
            pitch = step + accidental
            
            octave_list = e.xpath('.//octave/text()')
            octave = octave_list[0] if len(step_list)>0 else ''
            
            # notes.append((part,measure,pitch,step,alter,octave,duration,typ,dotted,rest))
            csv_writer.writerow((part,instrument,measure,pitch,step,alter,octave,duration,typ,dotted,rest))



    # df = pd.DataFrame(notes,columns=['part','measure','pitch','step','alter','octave','duration','type','dotted','rest'])
    df = pd.read_csv(csv_filepath)

    num_measures = str(df['measure'].max())
  


    print("Creating figures:")

    col='part'
    df.groupby(col)[col].count().plot.bar()
    plt.tight_layout()
    plt.title("Distribution of Notes by Part")
    plt.xlabel("Part Number")
    plt.ylabel("Number of Notes")
    plt.tight_layout()
    notefig_filepath = '../images/figures/%s-partfig.png' % mv
    plt.savefig(notefig_filepath, dpi=300)
    plt.clf()
    print("\t",notefig_filepath)


    col = 'type'
    df[df[col]!=''].groupby(col)[col].count().sort_values().plot.barh()
    plt.title('Distribution of Notes by Note Types')
    plt.xlabel('Note Type')
    plt.ylabel('Number of Notes')
    typefig_filepath = '../images/figures/%s-typefig.png' % mv
    plt.savefig(typefig_filepath, dpi=300)
    plt.clf()
    print("\t",typefig_filepath)


    col = 'pitch'
    df[df[col]!=''].groupby(col)[col].count().sort_values().plot.barh()
    plt.title('Distribution of Notes by Pitch')
    plt.xlabel('Pitch')
    plt.ylabel('Number of Notes')
    pitchfig_filepath = '../images/figures/%s-pitchfig.png' % mv
    plt.savefig(pitchfig_filepath, dpi=300)
    plt.clf()
    print("\t",pitchfig_filepath)






# df = df.set_index('part',append=True)




    # col = 'pitch'
    # result = df[df[col]!=''].groupby(['part',col])[col].count()
    # result_df = result.to_frame().rename (columns={col:'count'}).reset_index()
    # p = len(parts)
    # if p%4 == 0:
    #     num_rows = int(p/4)
    #     fig, ax = plt.subplots(num_rows,4)
    # elif p%3 == 0:
    #     num_rows = int(p/3)
    #     fig, ax = plt.subplots(num_rows,3)
    # elif p%2 == 0:
    #     num_rows = int(p/2)
    #     fig, ax = plt.subplots(num_rows,2,figsize=(12,num_rows*4))
    # else:
    #     num_rows = p
    #     fig, ax = plt.subplots(num_rows,1,figsize=(10,num_rows))
    # result_df.pivot(index=col,columns='part',values='count').sort_values(by="P1",ascending=False).plot.bar(subplots=True, ax=ax,legend=False, sharex=False)
    # plt.tight_layout()
    # plt.show()



    """
    Because this song is written in the key of F major (D minor), the expected most common pitches are as follows:
    F Major:
    I chord: F-A-C
    IV chord: Bb-D-F
    V(7) chord: C-E-G(-Bb)
    vi chord: D-F-A
    ii chord: G-Bb-D

    D Minor:
    i chord: D-F-A
    iv chord: G-Bb-D
    V(7) chord: A-C#-E(-G)
    VII  chordL Bb-D-F
    ii°(7) chord: E-G-Bb(-C#)
    """



    # steps = df['step'].to_string(index=False)
    # steps = re.sub(r'\n|\t| ','',steps)
    # print(steps)


    # min_length = 2
    # min_occur = 2
    # pat = r'(?=(.{%d,}).*\1{%d,})' % (min_length, min_occur-1)
    # step_patterns = re.findall(pat,steps)
    # print(Counter(step_patterns))

    print("Creating HTML file:", html_filepath)
    with open(html_filepath, 'w') as html_file:
        html_file.write("""
    <html>
    <body>
    <h1>%s</h1>
    <p>%s</p>
    """ % (mv_title,composer))

        html_file.write("""
    <h2>Work Information</h2>
    <h3>Composition</h3>
        <p>Key signature: %s</p>
        <img src="../%s" alt="key signature" width="60px">
        <p>Time signature: %s</p>
        <p>Number of measures: %s</p>

    <h3>Instrumentation</h3>
        <ul>
    """ % (key_sig,key_img,time_sig,num_measures))

        for part, instrument in parts.items():
            html_file.write("""
                    <li>%s (%s)</li>
            """ %(instrument,part))

        html_file.write("""
        </ul>
    """)

    quit()

    """
    <h2>Analysis</h2>
    <h3>Most common pitches</h3>
    <img src="../..images/figures/JSB_BWV1047_1-pitchfig.png" alt="pitch chart" width="600px">
    <h3>Most common durations</h3>
    <img src="images/figures/JSB_BWV1047_1-typefig.png" alt="durations chart" width="600px">

    <h3>Notes per part</h3>
    <img src="../..images/figures/JSB_BWV1047_1-partfig.png" alt="part chart" width="600px">

    <h3></h3>Reoccurring patterns</h3>

    </body>
    </html>
    """
    print("\nEND\n")