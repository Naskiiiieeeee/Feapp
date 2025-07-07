import csv
import random
import os

target_file = "training_data.csv"

training_titles = [
    "Advanced Curriculum Design",
    "Classroom Management Workshop",
    "Engaging Students in Online Learning",
    "Research Writing and Publication",
    "Effective Assessment Strategies",
    "Integrating Technology in Teaching",
    "Stress Management and Faculty Wellness",
    "Improving Communication Skills",
    "Outcome-Based Education Seminar",
    "Time Management for Educators",
    "Innovative Teaching Strategies",
    "Building Empathy in the Classroom",
    "Using Rubrics Effectively",
    "Instructional Leadership Training",
    "Creating Inclusive Learning Environments",
    "Digital Pedagogy Workshop",
    "Emotional Intelligence for Educators",
    "Blended Learning Design",
    "Flipped Classroom Implementation"
]

variations_per_title = 3

existing_rows = set()
if os.path.exists(target_file):
    with open(target_file, "r", newline="") as file:
        reader = csv.reader(file)
        header = next(reader)
        for row in reader:
            existing_rows.add(tuple(row))
else:
    header = ["subject_knowledge", "engagement", "management", "preparedness", "professionalism", "recommended_training"]

def generate_scores(range_low=2.5, range_high=5.0):
    return [round(random.uniform(range_low, range_high), 1) for _ in range(5)]

new_rows = []
for title in training_titles:
    for _ in range(variations_per_title):
        row = generate_scores() + [title]
        if tuple(row) not in existing_rows:
            new_rows.append(row)
            existing_rows.add(tuple(row))  

with open(target_file, "a", newline="") as file:
    writer = csv.writer(file)

    if os.stat(target_file).st_size == 0:
        writer.writerow(header)

    writer.writerows(new_rows)

print(f"Added {len(new_rows)} new unique rows to '{target_file}'")
