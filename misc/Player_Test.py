import pandas as ps
import numpy as np
from sklearn.neural_network import MLPClassifier
from data import get_dataset
df = ps.read_csv("nfl_pass_rush_receive_raw_data.csv")

print(df.columns)