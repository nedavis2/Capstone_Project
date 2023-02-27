import pandas as ps
import numpy as np
from sklearn.neural_network import MLPClassifier
from data import get_dataset
import sklearn as sk
import sklearn
import numpy as np
from sklearn import datasets
import sklearn.model_selection as skms
import sklearn.tree as skt
import matplotlib.pyplot as plt
import sklearn.linear_model as skl
import sklearn.metrics as m
import sklearn.naive_bayes as sknb
from sklearn.ensemble import AdaBoostClassifier
import sklearn.neural_network as nn
from sklearn.neural_network import MLPClassifier

df = ps.read_csv("nfl_pass_rush_receive_raw_data.csv")


#Split data into train-test split
'''Note: Current is copy-pasted from Dr. Fu's homework. Rewrite this at some point.'''

feature_names = [str(s) for s in mat['feature_names']]
is_nominal = [bool(b) for b in mat['is_nominal']]
nominal_values = [[str(s) for s in values]
                  for values in mat['nominal_values']]

ids = [str(s) for s in mat['ids']]
X = mat['examples']
y = mat['labels']

#Construct CNN


#Train CNN


#Test CNN Accuracy


#Predict.