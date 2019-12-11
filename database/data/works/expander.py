import csv

infilepath = "works-instrumentation.csv"
outfilepath = "works-instrumentation-expanded.csv"
with open(outfilepath,'w') as outfile:
    writer = csv.writer(outfile)
    writer.writerow(['work_id','instr_name','part_num'])

    with open(infilepath,'r') as infile:
        reader = csv.reader(infile)
        next(reader)
        for line in reader:
            work_id = line[0]
            instrument_list = line[1].strip().split(',')
            instrument_name = None
            part_num = 1
            for i in instrument_list:
                if i == '':
                    continue
                if i == instrument_name:
                    part_num += 1
                else:
                    part_num = 1
                instrument_name = i
                writer.writerow([work_id,i.strip().lower(),part_num])