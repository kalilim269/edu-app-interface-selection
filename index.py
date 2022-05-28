#! C:/Users/User/AppData/Local/Programs/Python/Python39/python.exe

from sklearn import tree
from sklearn.model_selection import train_test_split
import numpy as np
from sklearn.model_selection import GridSearchCV, cross_val_score
from sklearn.metrics import accuracy_score
from sklearn.ensemble import RandomForestClassifier
import pandas as pd

features = np.array([
    [0.060, 0.007, 0.007, 0.060, 0.089, 0.025],
    [0.024, 0.027, 0.017, 0.020, 0.019, 0.020],
    [0.018, 0.016, 0.004, 0.105, 0.304, 0.103],
    [0.016, 0.263, 0.234, 0.304, 0.129, 0.329],
    
    
]*10)

labels = np.array([
    ['Multimedia'], 
    ['Symbol'], 
    ['Navigation'], 
    ['Feedback'],
    
    
    
]*10)

df = pd.DataFrame(features, labels)
#print(df.head())

# Import label encoder
from sklearn import preprocessing
 
# label_encoder object knows how to understand word labels.
label_encoder = preprocessing.LabelEncoder()
 
# Encode labels in column 'species'.
labels= label_encoder.fit_transform(labels)




from numpy.lib import recfunctions as rfn

#ata = rfn.merge_arrays(features, labels)

df = pd.DataFrame(features, labels)
#print(df.head())

X_train, X_test, y_train, y_test = train_test_split(
    features,
    labels,
    test_size=0.2,
    random_state=42,
)


clf = RandomForestClassifier(bootstrap=True, class_weight=None, criterion='gini',
            max_depth=None, max_features='auto', max_leaf_nodes=None,
            min_impurity_decrease=0.0, min_impurity_split=None,
            min_samples_leaf=1, min_samples_split=2,
            min_weight_fraction_leaf=0.0, n_estimators=100, n_jobs=1,
            oob_score=False, random_state=None, verbose=0,
            warm_start=False)

clf.fit(X_train, y_train)
clf.feature_importances_ # [ 1.,  0.,  0.]
clf.score(X_test, y_test) # 1.0
#print(X_test)
#predictions_test = le.inverse_transform(prediction_test)

y_pred=clf.predict(X_test)

 # array([0, 0, 0, 3, 1, 0, 3, 0, 0, 3, 2, 2, 1, 3, 2, 0, 2, 0]) 
#CV_Result = cross_val_score(clf, y_test, y_pred, cv=2, n_jobs=-1, scoring="accuracy")
#print(y_pred)
print(label_encoder.inverse_transform(y_pred))

#print(CV_Result.mean())
#print('Accuracy: %.3f' % accuracy_score(y_test, y_pred))
from sklearn.metrics import classification_report, confusion_matrix 

#print(confusion_matrix(y_test, y_pred))  
#print(classification_report(y_test, y_pred))