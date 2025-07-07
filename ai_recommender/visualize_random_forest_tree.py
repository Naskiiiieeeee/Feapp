import os
os.environ["PATH"] += os.pathsep + r"C:\Program Files\Graphviz\bin"

import joblib
from sklearn.tree import export_graphviz
import graphviz

model = joblib.load("training_model.pkl")

estimator = model.estimators_[0]

feature_names = ["subject_knowledge", "engagement", "management", "preparedness", "professionalism"]
class_names = model.classes_

dot_data = export_graphviz(
    estimator,
    out_file=None,
    feature_names=feature_names,
    class_names=class_names,
    filled=True,
    rounded=True,
    special_characters=True
)

graph = graphviz.Source(dot_data)
graph.render("random_forest_tree_1", format="png", cleanup=False)

print("One of the Random Forest trees visualized as 'random_forest_tree_1.png'")
