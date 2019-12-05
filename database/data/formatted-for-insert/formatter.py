import pandas as pd 
import numpy as np 

df = pd.read_csv("classical-composers.csv")

df['fname'] = df['name'].apply(lambda x: x.split()[0])
df['mname'] = df['name'].apply(lambda x: ' '.join(x.split()[1:-1]))
df['lname'] = df['name'].apply(lambda x: x.split()[-1])

df.to_csv("final-classical-composers.csv", columns=['fname','mname','lname','birth','death','nationality'], index=False)