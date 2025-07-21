from flask import Flask, request, jsonify
from flask_cors import CORS
import joblib

app = Flask(__name__)
CORS(app) 

model = joblib.load("training_model.pkl")

@app.route('/recommend-training', methods=['POST'])
def recommend_training():
    try:
        data = request.json

        features = [[
            float(data.get('subject_knowledge', 0)),
            float(data.get('engagement', 0)),
            float(data.get('management', 0)),
            float(data.get('preparedness', 0)),
            float(data.get('professionalism', 0))
        ]]

        prediction = model.predict(features)[0]

        return jsonify({"recommended_training": prediction})
    except Exception as e:
        return jsonify({"error": str(e)}), 500

if __name__ == "__main__":
    app.run(debug=True, port=5000)
    application = app