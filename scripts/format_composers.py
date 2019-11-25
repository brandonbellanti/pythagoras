import pandas as pd 
import re


main_composers_filepath = "../reference/sorted_composer_list.txt"
all_composers_filepath = "../reference/romantic_era_composers.csv"
formatted_composers_filepath = "../reference/formatted_composers.csv"

df = pd.read_csv(all_composers_filepath)
names = df['name'].tolist()


with open(main_composers_filepath, 'r') as main_composers_file:
    composer_list = main_composers_file.read()
    composer_list = re.findall(r'[A-Z][^A-Z]*',composer_list)
    for i, composer in enumerate(composer_list):
        if composer[-1] == '-':
            composer_list[i] = composer_list[i]+composer_list[i+1]
            composer_list[i+1] = ' '


filtered_composers = []
for name in names:
    for part in name.split():
        if part in composer_list:
            filtered_composers.append(name)


df = df[df['name'].isin(filtered_composers)]

print(df)


# https://stackoverflow.com/questions/44173155/pandas-use-apply-to-split-column-into-2
def split_name(name):
    parts = name.split()
    first_name = parts[0]
    last_name = parts[-1]
    try:
        middle_name = ' '.join(parts[1:-1])
    except:
        middle_name = None
    return pd.Series([first_name,middle_name,last_name], index=['first_name','middle_name','last_name'])


df[['first_name','middle_name','last_name']] = df['name'].apply(split_name)


df.to_csv(formatted_composers_filepath, index=False, columns=['first_name','middle_name','last_name','birth_year','death_year','nationality'])