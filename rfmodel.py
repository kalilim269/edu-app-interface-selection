from sklearn import tree
from sklearn.model_selection import train_test_split
import numpy as np
from sklearn.model_selection import GridSearchCV, cross_val_score
from sklearn.metrics import accuracy_score
from sklearn.ensemble import RandomForestClassifier
import pandas as pd
import pickle
import MySQLdb
import sys
import warnings
warnings.filterwarnings("ignore")

content = open('temp.dat')
user = content.read()


# Open database connection
#db = MySQLdb.connect("localhost","root","","a176496")
db = MySQLdb.connect("sql6.freemysqlhosting.net", "sql6496163", "KpxBp7Ln2Y", "sql6496163");

# prepare a cursor object using cursor() method
cursor = db.cursor()


sql = "SELECT * FROM tbl_eduapp_alternative_data WHERE user_id=%s"
#sql = "SELECT * FROM tbl_eduapp_alternative_data WHERE user_id=17"

try:
   # Execute the SQL command
   cursor.execute(sql, (user,))
   #cursor.execute(sql)
   # Fetch all the rows in a list of lists.
   results = cursor.fetchall()
   df = pd.DataFrame(results, columns=['User_ID', 'Alternative_ID', 'Alternative Name', 'EM_result', 'GM_result', 'AN_result'])
   #print(df)
except:
   print("Error: unable to fetch data")

# disconnect from server
db.close()
content.close()

features = df['EM_result']

labels = df['Alternative Name']

#function to convert data in dataframe into list
def extractDigits(lst):
    return [[el] for el in lst]

features = extractDigits(features)*10
labels = extractDigits(labels)*10



# Import label encoder
from sklearn import preprocessing
 
# label_encoder object knows how to understand word labels.
label_encoder = preprocessing.LabelEncoder()
 
# Encode labels in column 'species'.
labels= label_encoder.fit_transform(labels)



X_train, X_test, y_train, y_test = train_test_split(
    features,
    labels,
    test_size=0.2,
    random_state=42,
)

clf = RandomForestClassifier(bootstrap=True, class_weight=None, criterion='gini',
            max_depth=None, max_features='auto', max_leaf_nodes=None,
            min_impurity_decrease=0.0,
            min_samples_leaf=1, min_samples_split=2,
            min_weight_fraction_leaf=0.0, n_estimators=100, n_jobs=1,
            oob_score=False, random_state=None, verbose=0,
            warm_start=False)



clf.fit(X_train, y_train)

X_test.sort(reverse=True)
user_input = sys.argv[1]
y_pred = clf.predict([[user_input]])

print(label_encoder.inverse_transform(y_pred))
