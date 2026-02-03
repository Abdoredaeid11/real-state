
import os

file_path = 'resources/views/index.blade.php'

with open(file_path, 'r', encoding='utf-8') as f:
    lines = f.readlines()

# We want lines 0-286 (first 287 lines)
# And lines 4796-end (from line 4797 onwards)
# Note: indices are 0-based.
# Line 287 is index 286.
# Line 4797 is index 4796.

# Verify the cut points
print(f"Keeping up to: {lines[286].strip()}")
print(f"Skipping from: {lines[287].strip()}")
print(f"Resuming at: {lines[4796].strip()}")

new_lines = lines[:287] + lines[4796:]

with open(file_path, 'w', encoding='utf-8') as f:
    f.writelines(new_lines)

print("File updated successfully.")
