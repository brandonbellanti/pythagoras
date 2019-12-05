import csv

infilepath = "composer_era.csv"

with open(infilepath,'r') as infile:
    reader = csv.reader(infile)
    for line in reader:
        comp_id = int(line[0])
        era_list = line[1].split(',')
        for i in era_list:
            print("(%d,%s)" % (comp_id,i))
