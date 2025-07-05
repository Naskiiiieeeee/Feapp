from flask import Flask, request, jsonify
import joblib

app = Flask(__name__)
model = joblib.load("training_model.pkl")

@app.route("/recommend-training", methods=["POST"])
def recommend_training():
    data = request.get_json()
    features = [[
        data["subject_knowledge"],
        data["engagement"],
        data["management"],
        data["preparedness"],
        data["professionalism"]
    ]]
    prediction = model.predict(features)
    return jsonify({"recommended_training": prediction[0]})

if __name__ == "__main__":
    app.run(debug=True, port=5000)