import os
os.environ["PATH"] += os.pathsep + r"C:\Program Files\Graphviz\bin"
import joblib
from sklearn.tree import export_graphviz
import graphviz

model = joblib.load("training_model.pkl")

feature_names = ["subject_knowledge", "engagement", "management", "preparedness", "professionalism"]

class_names = model.classes_

dot_data = export_graphviz(
    model,
    out_file=None,
    feature_names=feature_names,
    class_names=class_names,
    filled=True,
    rounded=True,
    special_characters=True
)
graph = graphviz.Source(dot_data)
graph.render("training_decision_tree", format="png", cleanup=False)

print("Decision tree visualization generated as 'training_decision_tree.png'")
