import pandas as pd
import numpy as np
import os
from sklearn.linear_model import LogisticRegression
from sklearn.model_selection import train_test_split
from sklearn.metrics import confusion_matrix
from sklearn import preprocessing
from sklearn import metrics
from sklearn.ensemble import RandomForestRegressor
from sklearn import tree
from sklearn.metrics import classification_report

from sklearn.model_selection import train_test_split
import pickle
import math
import seaborn
import matplotlib.pyplot as plt

def cleanUp(df):
    df.drop(columns=["Team_abbrev", "Opponent_abbrev", "vis_team", "home_team", "Roof", "Surface"], inplace = True)

    df.drop(columns=["Vegas_Favorite"], inplace=True)

    df.drop(columns=["game_date"], inplace=True)

    df.drop(columns=["Vegas_Line", "Over_Under"], inplace=True)

def normalize_data(df):
    df = (df - df.mean())/df.std()
    df.dropna(axis=1, how='all', inplace=True)
    return df

def split_data(df, string):
    Y = np.asarray(df[string])
    df.drop(columns = [string], inplace = True)
    X = np.asarray(df).astype(np.float32)
    X = X.reshape(X.shape[0], -1)
    Xtrain, Xtest, ytrain, ytest = train_test_split(X, Y, test_size=.2)
    return X,Y, Xtrain, Xtest, ytrain, ytest

def train(Xtrain, ytrain):
    model_forest = RandomForestRegressor()
    forest=model_forest.fit(Xtrain, ytrain)
    return forest

def analyze(df, string,model, Xtest, ytest):
    ypred = model.predict(Xtest)
    mn = df[string].mean()
    st = df[string].std()
    ypred  = (ypred * st) + mn
    ytest = (ytest * st) + mn
    ypred = np.around(ypred)
    ytest = np.around(ytest)
    return ypred, ytest

def save_model(model, name):
    filename = 'model' + name + '.sav'
    pickle.dump(model, open(filename, 'wb'))

def create_model(current_st):
    df_nfl_players_stats = pd.read_csv("C:/Users/carlo/Downloads/nfl_pass_rush_receive_raw_data.csv")
    cleanUp(df_nfl_players_stats)
    norm = normalize_data(df_nfl_players_stats)
    X,Y, Xtrain, Xtest, ytrain, ytest = split_data(norm, current_st)
    model = train(Xtrain, ytrain)
    ypred, ytest = analyze(df_nfl_players_stats, current_st, model, Xtest, ytest)
    save_model(model, current_st)

create_model("fumbles_lost")
