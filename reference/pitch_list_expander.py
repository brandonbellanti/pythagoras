import csv

infilepath = "pitches_dict.csv"

with open(infilepath,'r') as infile:
    reader = csv.reader(infile)
    for line in reader:
        pitch_list = line[0].split(',')
        octave = line[1]
        step = line[2]
        for i in pitch_list:
            print("'%s%s':'%s'," % (i,octave,step))
