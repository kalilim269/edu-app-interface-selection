#import libraries
import numpy as np
from flask import Flask, render_template,request
import pickle
import subprocess as sp


#Initialize the flask App
app = Flask(__name__)
model = pickle.load(open('rfmodel.pkl', 'rb'))

#default page of our web-app
@app.route('/')
def home():
    return render_template('index3.php')

#To use the predict button in our web-app
@app.route('/predict',methods=['POST'])
def predict():

    #For rendering results on HTML GUI
    int_features = [float(x) for x in request.form.values()]
    
    #just list
    def extractDigits(lst):
        return [[el] for el in lst]             
    lst = extractDigits(int_features)

    #list of lists
    #new_list = [int_features[i:i+3] for i in range(0, len(int_features), 3)]

    #return render_template('index.html', prediction_text=new_list)
    lst.sort(reverse=True)
    prediction = model.predict(lst)
    
    #for i in range(len(prediction)):
        #res = dict()
        #res[i] = prediction[i]
    #output = round(prediction[0], 2) 



    return render_template('index3.php', prediction_text='The ranking that was predicted through the Random Forest model are as followed :<br><br>{}'.format(prediction))
    
        
#if __name__ == "__main__":
    #app.run(debug=True, host = "localhost")
    
if __name__ == "__main__":
    from waitress import serve
    serve(app, host="0.0.0.0", port=8080)