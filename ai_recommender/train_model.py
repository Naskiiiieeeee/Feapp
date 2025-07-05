import pandas as pd
from sklearn.tree import DecisionTreeClassifier
import joblib

data = pd.read_csv("training_data.csv")
X = data[["subject_knowledge", "engagement", "management", "preparedness", "professionalism"]]
y = data["recommended_training"]  # <- fixed column name

model = DecisionTreeClassifier()
model.fit(X, y)

joblib.dump(model, "training_model.pkl")
print("Model trained and saved as training_model.pkl")
